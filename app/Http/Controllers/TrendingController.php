<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class TrendingController extends Controller
{
    public function index(Request $request)
    {
        $niche = $request->input('niche');
        $topics = [];

        if ($niche) {
            $validated = $request->validate([
                'niche' => 'required|string|max:100',
            ]);

            $prompt = "Give me the top 5 currently trending topics in the niche of {$niche}. Return them with titles and corresponding link titles (real or imagined), formatted as a list with a short title and a dummy link.";

            $response = OpenAI::chat()->create([
                'model' => 'gpt-4', // or 'gpt-3.5-turbo'
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant that finds trending topics.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            $text = $response['choices'][0]['message']['content'];

            // Example format expected from AI:
            // 1. AI in Healthcare - https://example.com/ai-healthcare
            // 2. Quantum Computing - https://example.com/quantum
            preg_match_all('/\d+\.\s*(.*?)\s*-\s*(https?:\/\/\S+)/', $text, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                $topics[] = [
                    'title' => trim($match[1]),
                    'link' => trim($match[2]),
                ];
            }
        }

        return view('trending', compact('topics', 'niche'));
    }
}
