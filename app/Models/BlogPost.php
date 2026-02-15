<?php

namespace App\Models;

use App\Entities\BlogPost as BlogPostEntity;
use CodeIgniter\Model;

class BlogPost extends Model
{
    protected $table = 'blog_posts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = BlogPostEntity::class;
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $allowedFields = [
        'user_id',
        'title',
        'content',
        'status',
        'cover_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'published_at',
    ];
    protected array $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    protected $validationRules = [
        'user_id' => 'required|integer|is_natural_no_zero',
        'title' => 'required|string|max_length[255]|is_unique[blog_posts.title,id,{id}]',
        'slug' => 'required|alpha_dash|max_length[255]|is_unique[blog_posts.slug,id,{id}]',
        'content' => 'required|string',
        'status' => 'required|in_list[draft,scheduled,published,archived]',
        'cover_image' => 'permit_empty|string|max_length[255]',
        'meta_title' => 'permit_empty|string|max_length[255]',
        'meta_description' => 'permit_empty|string|max_length[255]',
        'meta_keywords' => 'permit_empty|string|max_length[255]',
        'published_at' => 'permit_empty|valid_date',
    ];
    protected $validationMessages = [
        'slug' => [
            'is_unique' => 'The {field} field must be unique.',
        ],
        'status' => [
            'in_list' => 'The {field} field must be one of the following: {param}.',
        ],
    ];
    protected $skipValidation = false;

    public function published(): BlogPost
    {
        return $this->where('status', 'published')
            ->groupStart()
                ->where('published_at <=', date('Y-m-d H:i:s'))
                ->orWhere('published_at IS NULL')
            ->groupEnd();
    }
}