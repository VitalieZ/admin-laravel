<?php

namespace Viropanel\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Viropanel\Admin\Models\Traits\Translatable;

class Category extends Model
{
    use HasFactory, Sluggable;
    use Translatable;

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
        'name_ru',
        'name_ro',
        'slug',
        'content',
        'title',
        'keywords',
        'description',
        'parent_id',
        'ordering',
        'visible',
        'created_at',
        'updated_at',
    ];

    public function cheaild()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('ordering', 'asc')->with('cheaild');
    }
}
