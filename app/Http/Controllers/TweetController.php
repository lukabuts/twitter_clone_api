<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TweetController extends Controller
{
    public function index(Request $request)
    {
        $query = Tweet::with('user:id,name,username,email_verified_at', 'likes')
            ->where(function ($query) use ($request) {
                // Show published posts to everyone
                $query->where('status', 'published');
                
                // If user is authenticated, also show their own drafts
                if ($request->user()) {
                    $query->orWhere(function ($query) use ($request) {
                        $query->where('status', 'draft')
                              ->where('user_id', $request->user()->id);
                    });
                }
            })
            ->orderBy('created_at', 'desc'); // Add this line
        
        return response()->json($query->simplePaginate(10));
    }


    public function show($slug)
    {
        $tweet = Tweet::with('user', 'likes', 'comments')
        ->where('slug', $slug)
        ->firstOrFail(); // Use firstOrFail() instead of findOrFail()

        // Check visibility
        if ($tweet->status !== 'published' && $tweet->user_id !== Auth::id()) {
            abort(404, 'Tweet not found');
        }

        return response()->json($tweet);

    }

    public function store(TweetRequest $request)
    {
        $validated = $request->validated();

        $slug = Str::slug($validated['title']) . '-' . time();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            
        }
        $tweet = Tweet::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath ? asset("storage/$imagePath") : null,
            'status' => $validated['status'] ?? 'draft',
            'slug' => $slug,
            'user_id' => $request->user()->id,
        ]);

        return response()->json([
            'message' => 'Tweet created successfully',
            'tweet' => $tweet,
        ]);

    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing tweet
    }

    public function destroy($id)
    {
        // Logic to delete a tweet
    }
}
