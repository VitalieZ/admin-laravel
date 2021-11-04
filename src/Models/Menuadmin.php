<?php

namespace Viropanel\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menuadmin extends Model
{
    use HasFactory;

    protected $table = 'menu_admin';

    protected $fillable = [
        'parent_id',
        'order',
        'name',
        'icon',
        'uri',
        'title',
        'permision',
        'created_at',
        'updated_at',
    ];

    public function cheaild()
    {
        return $this->hasMany(Menuadmin::class, 'parent_id')->orderBy('order', 'asc');
    }
}
