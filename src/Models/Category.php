<?php

namespace Viropanel\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'content',
        'title',
        'keywords',
        'description',
        'parent_id',
        'ordering',
        'tree_id',
        'visible',
        'created_at',
        'updated_at',
    ];

    public function cheaild()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('ordering', 'asc');
    }
}
