<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Post::latest()->paginate(10);
        $recentBlogs = Post::latest()
            ->limit(5)
            ->get(['id', 'post_title', 'post_slug', 'post_content', 'image']);
        return view('frontend.blog', compact('blogs', 'recentBlogs'));
    }

    public function blogSinglePage($post_slug)
    {
        $recentBlogs = Post::latest()
            ->limit(5)
            ->get(['id', 'post_title', 'post_slug', 'post_content', 'image']);
        $blog = Post::where('post_slug', $post_slug)->firstOrFail();
        return view('frontend.layouts.pages.blog.blog-single-page', compact('blog', 'recentBlogs'));
    }
}
