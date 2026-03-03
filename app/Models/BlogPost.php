<?php

namespace App\Models;

use App\Entities\BlogPost as BlogPostEntity;
use CodeIgniter\Model;

use function convert_accented_characters;
use function url_title;

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
        'slug',
        'content',
        'status',
        'cover_image_id',
        'meta_description',
        'published_at',
    ];
    protected array $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'cover_image_id' => '?integer',
        'created_at' => 'datetime',
        'published_at' => '?datetime',
        'updated_at' => '?datetime',
        'deleted_at' => '?datetime',
    ];
    protected $validationRules = [
        'user_id' => 'required|integer|is_natural_no_zero',
        'title' => 'required|string|max_length[255]',
        'slug' => 'required|string|max_length[255]|is_unique[blog_posts.slug,id,{id}]',
        'content' => 'required|string',
        'status' => 'required|in_list[draft,published,archived]',
        'cover_image_id' => 'permit_empty|integer|is_Natural_no_zero',
        'meta_description' => 'permit_empty|string|max_length[255]',
        'published_at' => 'required_if[status,published]|permit_empty|valid_date',
    ];
    protected $validationMessages = [
        'status' => [
            'in_list' => 'The {field} field must be one of the following: {param}.',
        ],
    ];
    protected $skipValidation = false;

    public function published(): BlogPost
    {
        return $this->where('status', 'published')
            ->where('published_at <=', date('Y-m-d H:i:s'));
    }
}