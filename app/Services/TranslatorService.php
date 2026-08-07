<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TranslatorService
{
    protected static $excludeTags = ['script', 'style', 'code', 'pre', 'textarea', 'svg'];

    /**
     * Translates an HTML string's text nodes to the target locale.
     *
     * @param string $html
     * @param string $targetLocale
     * @return string
     */
    public static function translateHtml($html, $targetLocale)
    {
        if ($targetLocale === 'en') {
            return $html;
        }

        if (empty($html)) {
            return $html;
        }

        // Use DOMDocument to load the HTML
        $dom = new \DOMDocument();
        
        // Suppress parsing warnings for HTML5 elements
        libxml_use_internal_errors(true);
        
        // Load with UTF-8 encoding support
        // We prepend xml encoding so DOMDocument doesn't lose UTF-8 characters
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);
        // Find all text nodes in the document
        $textNodes = $xpath->query('//text()');

        $stringsToTranslate = [];
        $nodeMappings = [];

        foreach ($textNodes as $node) {
            // Skip text nodes inside excluded tags
            if ($node->parentNode) {
                $parentName = strtolower($node->parentNode->nodeName);
                if (in_array($parentName, self::$excludeTags)) {
                    continue;
                }
            }

            $originalText = $node->nodeValue;
            $trimmed = trim($originalText);

            // Skip if empty, numeric, or just punctuation/whitespace/special characters
            if ($trimmed === '' || is_numeric($trimmed) || preg_match('/^[0-9\s\p{P}\p{S}]+$/u', $trimmed)) {
                continue;
            }

            // Store in our translation mapping
            $stringsToTranslate[] = $trimmed;
            $nodeMappings[] = [
                'node' => $node,
                'trimmed' => $trimmed,
                'original' => $originalText
            ];
        }

        if (empty($stringsToTranslate)) {
            $output = $dom->saveHTML();
            return str_replace('<?xml encoding="utf-8" ?>', '', $output);
        }

        // De-duplicate strings to translate
        $uniqueStrings = array_values(array_unique($stringsToTranslate));
        $translations = self::translateBatch($uniqueStrings, $targetLocale);

        // Replace text in nodes
        foreach ($nodeMappings as $mapping) {
            $trimmed = $mapping['trimmed'];
            if (isset($translations[$trimmed])) {
                $translatedTrimmed = $translations[$trimmed];
                
                // Maintain the original leading/trailing whitespaces
                $original = $mapping['original'];
                preg_match('/^(\s*)/u', $original, $leading);
                preg_match('/(\s*)$/u', $original, $trailing);
                
                $nodeValue = $leading[1] . $translatedTrimmed . $trailing[1];
                $mapping['node']->nodeValue = $nodeValue;
            }
        }

        $output = $dom->saveHTML();
        // Remove the xml encoding tag we prepended
        $output = str_replace('<?xml encoding="utf-8" ?>', '', $output);
        return $output;
    }

    /**
     * Translates a batch of strings, checking cache first and requesting the rest from Google.
     *
     * @param array $strings
     * @param string $targetLocale
     * @return array
     */
    protected static function translateBatch($strings, $targetLocale)
    {
        $results = [];
        $missingStrings = [];

        // Check Cache first
        foreach ($strings as $string) {
            $cacheKey = 'tr_' . md5($string) . '_' . $targetLocale;
            try {
                if (Cache::has($cacheKey)) {
                    $results[$string] = Cache::get($cacheKey);
                } else {
                    $missingStrings[] = $string;
                }
            } catch (\Throwable $e) {
                $missingStrings[] = $string;
            }
        }

        if (empty($missingStrings)) {
            return $results;
        }

        // Batch missing strings into chunks of ~1200 chars (joined with delimiter)
        $delimiter = ' ||| ';
        $currentBatch = [];
        $currentLength = 0;
        $batches = [];

        foreach ($missingStrings as $string) {
            $len = strlen($string);
            if ($currentLength + $len > 1200 && !empty($currentBatch)) {
                $batches[] = $currentBatch;
                $currentBatch = [];
                $currentLength = 0;
            }
            $currentBatch[] = $string;
            $currentLength += $len + strlen($delimiter);
        }
        if (!empty($currentBatch)) {
            $batches[] = $currentBatch;
        }

        foreach ($batches as $batch) {
            $textToTranslate = implode($delimiter, $batch);
            try {
                $url = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=' . $targetLocale . '&dt=t&q=' . urlencode($textToTranslate);
                
                // Using withoutVerifying() to prevent SSL issues in local environments
                $response = Http::withoutVerifying()->timeout(5)->get($url);

                if ($response->successful()) {
                    $data = $response->json();
                    $translatedText = '';
                    if (is_array($data) && isset($data[0])) {
                        foreach ($data[0] as $part) {
                            if (isset($part[0])) {
                                $translatedText .= $part[0];
                            }
                        }
                    }

                    // Split by delimiter (allowing variations in spacing around |||)
                    $translatedParts = preg_split('/\s*\|\|\|\s*/u', $translatedText);

                    foreach ($batch as $idx => $originalString) {
                        $translatedPart = isset($translatedParts[$idx]) ? trim($translatedParts[$idx]) : null;
                        
                        // Fallback to original if translation failed or was lost
                        if (empty($translatedPart)) {
                            $translatedPart = $originalString;
                        }

                        // Store translation in results and cache it
                        $results[$originalString] = $translatedPart;
                        $cacheKey = 'tr_' . md5($originalString) . '_' . $targetLocale;
                        try {
                            Cache::forever($cacheKey, $translatedPart);
                        } catch (\Throwable $e) {
                            // Ignore cache write error
                        }
                    }
                } else {
                    // Fail gracefully
                    foreach ($batch as $originalString) {
                        $results[$originalString] = $originalString;
                    }
                }
            } catch (\Throwable $e) {
                // Fail gracefully
                foreach ($batch as $originalString) {
                    $results[$originalString] = $originalString;
                }
            }
        }

        return $results;
    }
}
