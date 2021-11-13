<?php

namespace Viropanel\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Viropanel\Admin\Models\Traits\Translatable;

class Menuadmin extends Model
{
    use HasFactory;
    use Translatable;

    protected $table = 'menu_admin';

    protected $fillable = [
        'parent_id',
        'ordering',
        'name',
        'name_ru',
        'name_ro',
        'icon',
        'uri',
        'title',
        'permission',
        'visible',
        'created_at',
        'updated_at',
    ];

    public function cheaild()
    {
        return $this->hasMany(Menuadmin::class, 'parent_id')->orderBy('ordering', 'asc');
    }
}
