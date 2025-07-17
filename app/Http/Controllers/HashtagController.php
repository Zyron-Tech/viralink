<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HashtagController extends Controller
{
    public function showForm()
    {
        return view('hashtags.form');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:255',
        ]);

        $prompt = "Generate exactly 4 trending and relevant hashtags for this topic without any numbering or bullet points. Separate them by space only:\n\n" . $request->prompt;

        $response = Http::post('https://promptus-u64u.onrender.com/v1/chat/completions', [
            'role' => 'user',
            'prompt' => $prompt,
            'model' => 'gpt-3.5-turbo',
            'temperature' => 0.7
        ]);

        $hashtags = trim(strip_tags($response->json()['response'] ?? '#AI #Tech #Startup #Innovation'));

        return view('hashtags.result', compact('hashtags', 'request'));
    }
}
