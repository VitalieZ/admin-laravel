<?php

namespace Viropanel\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
