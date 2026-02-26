<?php

namespace App\Controllers;

use App\Models\BlogPost;

class Blog extends BaseController
{
    private BlogPost $blogPost;

    public function __construct()
    {
        $this->blogPost = model(BlogPost::class);
    }

    public function index(): string
    {
        $perPage = 25;

        $data = [
            'posts' => $this->blogPost
                ->published()
                ->orderBy('published_at', 'DESC')
                ->paginate($perPage),
            'pager' => $this->blogPost->pager
        ];

        return view('blog/index', $data);
    }

    public function show(string $slug): string
    {
        $post = $this->blogPost
            ->where('slug', $slug)
            ->published()
            ->first();

        return view('blog/show', compact('post'));
    }

    public function new()
    {

    }

    public function create()
    {
    }

    public function edit(int $id)
    {

    }

    public function update(int $id)
    {

    }

    public function delete(int $id)
    {
    }
}