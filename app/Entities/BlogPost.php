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
        'cover_image_id' => null,
        'meta_description' => null,
        'created_at' => null,
        'published_at' => null,
        'updated_at' => null,
        'deleted_at' => null,
    ];
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'cover_image_id' => 'integer',
        'created_at' => 'datetime',
        'published_at' => '?datetime',
        'updated_at' => '?datetime',
        'deleted_at' => '?datetime',
    ];
    protected $dates = ['published_at', 'created_at', 'updated_at', 'deleted_at'];

    public function setTitle(string $title): self
    {
        $title = trim($title);

        $this->attributes['title'] = $title;
        $this->attributes['slug'] = url_title(
            convert_accented_characters($title),
            '-',
            true
        );

        return $this;
    }

    public function setSlug(string $slug): self
    {
        $slug = trim($slug);
        $this->attributes['slug'] = url_title(
            convert_accented_characters($slug),
            '-',
            true
        );

        return $this;
    }

    public function setContent(string $content): self
    {
        $this->attributes['content'] = trim($content);

        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->attributes['status'] = trim($status);

        return $this;
    }

    public function setMetaDescription(?string $metaDescription): self
    {
        $this->attributes['meta_description'] = $metaDescription !== null ? trim($metaDescription) : null;

        return $this;
    }
}
