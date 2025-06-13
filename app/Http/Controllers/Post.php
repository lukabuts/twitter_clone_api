<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Post extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100',
        ]);
    }


    public function show($id)
    {
        // Logic to retrieve and return a single post by ID
    }

    public function store(Request $request)
    {
        // Logic to create a new post
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing post
    }

    public function destroy($id)
    {
        // Logic to delete a post
    }
    public function like(Request $request, $id)
    {
        // Logic to like a post
    }
    public function unlike(Request $request, $id)
    {
        // Logic to unlike a post
    }
}
