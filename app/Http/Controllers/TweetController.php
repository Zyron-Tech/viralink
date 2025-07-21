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
You are a top-tier ghostwriter for elite Twitter influencers. You specialize in crafting tweets that go viral — emotionally intelligent, punchy, raw, and deeply human.

Write a single tweet based on this idea: "{$userPrompt}"

Requirements:
- Start with a powerful hook
- Make it feel personal, relatable, or insightful
- Avoid clichés, fluff, or robotic language
- Strictly no hashtags, emojis, or AI mentions
- Must be under 250 characters
- Must feel like it was written by someone who *lives* on Twitter

Respond with only the tweet text.
PROMPT;
    }

    return <<<PROMPT
You're an anonymous ghostwriter for top Twitter influencers in business, tech, and self-improvement. Your job: write threads that get massive engagement — likes, bookmarks, shares.

Write a complete Twitter thread on: "{$userPrompt}"

Instructions:
- Start with a gripping hook tweet that makes people stop scrolling
- Then write {$count} tweets that provide real value (insights, tips, short stories, frameworks, etc.)
- Each tweet should feel personal, sharp, and written by a real human
- Avoid corporate tone, hashtags, emojis, or AI-related terms
- Each tweet must be 250 characters or less
- Use a numbered format: 1., 2., 3., etc.

Start with the hook. Then continue with the full thread.
PROMPT;
}

}
