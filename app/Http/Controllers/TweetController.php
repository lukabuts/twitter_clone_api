<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TweetController extends Controller
{
    use AuthorizesRequests;

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
        $tweet = Tweet::with(['user', 'likes', 'comments'])
                    ->where('slug', $slug)
                    ->firstOrFail();
    
        $this->authorize('view', $tweet);
    
        return response()->json($tweet);
    }

    public function store(TweetRequest $request)
    {
        $validated = $request->validated();
        
        // Ensure either content or images are provided
        if (empty($validated['content']) && !$request->hasFile('images')) {
            return response()->json([
                'message' => 'Either content or images must be provided.',
                'errors' => [
                    'content' => ['Either content or images must be provided.'],
                    'images' => ['Either content or images must be provided.']
                ]
            ], 422);
        }
    
        // Generate unique slug
        do {
            $slug = Str::random(32);
        } while (Tweet::where('slug', $slug)->exists());
    
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if (!$image->isValid()) {
                    continue;
                }
                
                $path = $image->store('tweet-images', 'public');
                $imagePaths[] = asset("storage/$path");
            }
        }
    
        try {
            $tweet = Tweet::create([
                'content' => $validated['content'] ?? null,
                'images' => !empty($imagePaths) ? $imagePaths : null,
                'status' => $validated['status'] ?? 'draft',
                'slug' => $slug,
                'user_id' => $request->user()->id,
            ]);
    
            $tweet->load(['user:id,name,username,email_verified_at']);
            return response()->json($tweet, 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create tweet',
                'error' => $e->getMessage()
            ], 500);
        }
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
