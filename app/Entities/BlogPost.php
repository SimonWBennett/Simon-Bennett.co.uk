<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class BlogPost extends Entity
{
    protected $attributes = [
        'id' => null,
        'user_id' => null,
        'title' => null,
        'slug' => null,
        'content' => null,
        'status' => 'draft',
        'cover_image' => null,
        'meta_title' => null,
        'meta_description' => null,
        'meta_keywords' => null,
        'published_at' => null,
        'created_at' => null,
        'updated_at' => null,
        'deleted_at' => null,
    ];
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    protected $dates = ['published_at', 'created_at', 'updated_at', 'deleted_at'];

    public function setTitle(string $title): self
    {
        $title = trim($title);
        if ($title === '') {
            throw new \InvalidArgumentException("Title can't be empty");
        }

        $slug = $this->generateSlug($title);
        if ($slug === '') {
            throw new \InvalidArgumentException("Title generates an invalid slug");
        }

        $this->attributes['title'] = $title;
        $this->attributes['slug'] = $slug;
        return $this;
    }

    private function generateSlug(string $title): string
    {
        return url_title(convert_accented_characters($title), '-', true);
    }
}
