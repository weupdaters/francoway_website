<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatGPTController extends Controller
{
    public function askChatGPT(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openai.key', env('OPENAI_API_KEY')),
                'Content-Type'  => 'application/json',
            ])->timeout(30)->post('https://api.openai.com/v1/chat/completions', [
                'model'    => 'gpt-4o',
                'messages' => [
                    ['role' => 'user', 'content' => $request->message],
                ],
                'max_tokens' => 500,
            ]);

            if ($response->failed()) {
                Log::error('OpenAI API error', ['status' => $response->status(), 'body' => $response->body()]);
                return response()->json(['error' => 'AI service is temporarily unavailable.'], 503);
            }

            return response()->json($response->json());

        } catch (\Throwable $e) {
            Log::error('ChatGPT request failed: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while contacting the AI service.'], 500);
        }
    }
}
