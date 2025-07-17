<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    // Show the admin dashboard
    public function dashboard()
    {
        $userCount = User::count();
        $recentUsers = User::latest()->take(5)->get();

        // All users with total tweet count
        $users = User::withCount('tweets')->get();

        // Tweets per user today
        $tweetsToday = Tweet::whereDate('created_at', today())
                            ->selectRaw('user_id, count(*) as count')
                            ->groupBy('user_id')
                            ->pluck('count', 'user_id');

        // Chart data: tweets per day for the last 7 days
        $chartLabels = [];
        $chartData = [];

        $days = collect(range(6, 0))->map(function ($i) {
            return Carbon::today()->subDays($i);
        });

        foreach ($days as $day) {
            $chartLabels[] = $day->format('D'); // e.g., Mon, Tue
            $chartData[] = Tweet::whereDate('created_at', $day)->count();
        }

        return view('admin.dashboard', compact(
            'userCount', 'recentUsers', 'users', 'chartLabels', 'chartData', 'tweetsToday'
        ));
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting an admin or self
        if ($user->is_admin || auth()->id() === $user->id) {
            return back()->with('error', 'Cannot delete this user.');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
