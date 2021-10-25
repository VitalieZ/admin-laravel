<?php

namespace Viropanel\Admin\Http\Livewire\Permissions;

use Livewire\Component;
use Livewire\WithPagination;
use Viropanel\Admin\Models\Permission;

class SearchPermissions extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchpermison;


    public function render()
    {
        return view('admin::admin.permissions.livewire.search-permisions', [
            'permissions' => Permission::when($this->searchpermison, function ($query, $searchpermison) {
                return $query->where('name', 'LIKE', "%$searchpermison%");
            })->orderBy('name', 'asc')->orderBy('id', 'asc')->paginate(5),
        ]);
    }
}
