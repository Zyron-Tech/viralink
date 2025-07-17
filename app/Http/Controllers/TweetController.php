<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Illuminate\Support\Facades\Http;

class TweetController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function history()
{
    $tweets = Tweet::where('user_id', auth()->id())
        ->latest()
        ->paginate(10); // paginate 10 per page

    return view('history', compact('tweets'));
}

public function clearHistory()
{
    Tweet::where('user_id', auth()->id())->delete();

    return redirect()->route('history')->with('status', 'History cleared successfully.');
}


public function generate(Request $request)
{
    $request->validate([
        'prompt' => 'required|string|max:255',
        'type' => 'required|in:single,thread',
        'count' => 'nullable|integer|min:1|max:10'
    ]);

    $count = $request->type === 'thread' ? ($request->count ?? 3) : 1;
    $enrichedPrompt = $this->buildPrompt($request->prompt, $request->type, $count);

    try {
        $response = Http::timeout(20)->post('https://promptus-u64u.onrender.com/v1/chat/completions', [
            'role' => 'user',
            'prompt' => $enrichedPrompt,
            'model' => 'gpt-3.5-turbo',
            'temperature' => 0.75
        ]);

        if (!$response->successful()) {
            return back()->with('error', 'API responded with an error: ' . $response->status());
        }

        $rawText = $response->json()['response'] ?? 'No response';

    } catch (\Exception $e) {
        return back()->with('error', 'Error connecting to AI server: ' . $e->getMessage());
    }

    $responses = [];

    if ($request->type === 'thread') {
        $lines = preg_split('/\r\n|\r|\n/', $rawText);
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if (!empty($trimmed)) {
                $responses[] = strip_tags(preg_replace('/^\d+\.\s*/', '', $trimmed));
            }
        }

        $responses = array_slice($responses, 0, $count);
    } else {
        $responses[] = strip_tags($rawText);
    }

    $tweet = Tweet::create([
        'user_id' => auth()->id(),
        'prompt' => $request->prompt,
        'responses' => $responses,
    ]);

    return view('dashboard', compact('tweet'))->with('status', 'Tweet generated successfully.');
}

 private function buildPrompt(string $userPrompt, string $type, int $count = 3): string
{
    if ($type === 'single') {
        return <<<PROMPT
You are a highly skilled, anonymous ghostwriter who writes extremely viral tweets for influencers on X (formerly Twitter). You write tweets that sound 100% human, feel raw, and connect emotionally with readers.

Write ONE tweet about: "{$userPrompt}"

Guidelines:
- Hook the reader in the first few words
- Make it relatable, emotional, insightful, or funny
- Keep it under 250 characters
- No robotic tone or cliches
- No hashtags, no emojis, no AI phrases like "as an AI"
- Make it sound like it was written by a real person who knows Twitter

Now write that tweet.
PROMPT;
    }

    // Thread version
    return <<<PROMPT
You're a professional ghostwriter for X (formerly Twitter), hired by top influencers in personal growth, tech, startups, or money. Your job is to write viral threads that get bookmarked and shared.

Write a Twitter thread about: "{$userPrompt}"

Instructions:
- Start with a 🔥 hook tweet that makes people stop scrolling (no emoji needed)
- Then write {$count} numbered tweets that are valuable, punchy, and feel personal
- Use real-life lessons, stats, stories, or tips
- Sound like a human, not a brand
- No hashtags or emojis
- Limit each tweet to 250 characters max

Begin with the hook and continue with the full thread.
PROMPT;
}
}
