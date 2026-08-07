<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\TranslatorService;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if ?lang=en or ?lang=fr is in query parameters
        if ($request->isMethod('get') && !$request->ajax() && $request->has('lang')) {
            $lang = $request->query('lang');
            if (in_array($lang, ['en', 'fr'])) {
                session(['locale' => $lang]);
                // Set a long-lived cookie for 1 year
                cookie()->queue('locale', $lang, 60 * 24 * 365);
            }
            
            // Redirect to the same URL without the lang query parameter to keep URL clean
            $query = $request->except('lang');
            $queryString = empty($query) ? '' : '?' . http_build_query($query);
            return redirect()->to($request->url() . $queryString);
        }

        // 2. Determine active locale
        $locale = null;
        $localeNotChosen = false;

        if (session()->has('locale')) {
            $locale = session('locale');
        } elseif ($request->hasCookie('locale')) {
            $locale = $request->cookie('locale');
            // Sync cookie back to session for ease
            session(['locale' => $locale]);
        } else {
            // No locale explicitly selected yet
            $locale = 'en'; // default
            $localeNotChosen = true;
        }

        // 3. Set the application locale
        app()->setLocale($locale);

        // Share the flag and locale variable with all views
        view()->share('current_locale', $locale);
        view()->share('locale_not_chosen', $localeNotChosen);

        // 4. Proceed with the request
        $response = $next($request);

        // 5. Translate the HTML content if locale is French
        if ($locale === 'fr' && $response instanceof \Illuminate\Http\Response) {
            // Skip admin panels, teacher panels, API routes, or binary/JSON responses
            $contentType = $response->headers->get('Content-Type');
            $isAdminOrBack = $request->is('admin*') || $request->is('teacher*') || $request->is('api*');

            if (!$isAdminOrBack && str_contains($contentType, 'text/html')) {
                $originalHtml = $response->getContent();
                $translatedHtml = TranslatorService::translateHtml($originalHtml, 'fr');
                $response->setContent($translatedHtml);
            }
        }

        return $response;
    }
}
