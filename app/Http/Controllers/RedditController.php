<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RedditController extends Controller
{
    // Map user-friendly niche to subreddit
    private $nicheMap = [
        'technology' => 'technology',
        'tech' => 'technology',
        'crypto' => 'CryptoCurrency',
        'politics' => 'politics',
        'sports' => 'sports',
        'science' => 'science',
        'movies' => 'movies',
        'news' => 'news',
        'funny' => 'funny',
        'games' => 'gaming',
        'education' => 'education',
        'business' => 'business',
        'entrepreneur' => 'Entrepreneur',
    ];

    public function index(Request $request)
    {
        $query = $request->input('q');

        // Resolve subreddit
        $subreddit = $this->resolveSubreddit($query);

        $response = Http::withHeaders([
            'User-Agent' => 'TrendFetcherBot/1.0 by PeaceMathew'
        ])->get("https://www.reddit.com/r/{$subreddit}/top.json", [
            'limit' => 10,
            't' => 'day'
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch trends. Try again later.'], 500);
        }

        $posts = collect($response['data']['children'])->map(function ($item) {
            return [
                'title' => $item['data']['title'],
                'url' => 'https://reddit.com' . $item['data']['permalink'],
                'subreddit' => $item['data']['subreddit'],
                'score' => $item['data']['score']
            ];
        });

        if ($request->wantsJson()) {
            return response()->json($posts);
        }

        return view('trending', [
            'posts' => $posts,
            'searched' => $query,
            'subreddit' => $subreddit
        ]);
    }

    private function resolveSubreddit($query)
    {
        if (!$query) {
            return 'popular'; // default trending
        }

        $key = strtolower(trim($query));
        return $this->nicheMap[$key] ?? $key; // fallback to same query if not mapped
    }
}
