<?php

namespace Viropanel\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'title',
        'keywords',
        'description',
        'parent_id',
        'ordering',
        'visible',
        'created_at',
        'updated_at',
    ];
}
