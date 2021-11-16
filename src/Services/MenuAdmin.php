<?php

namespace Viropanel\Admin\Services;

use Viropanel\Admin\Models\Menuadmin as ModelsMenuadmin;

class MenuAdmin
{

    protected $menuadmin;
    public function __construct()
    {
        $this->menuadmin = ModelsMenuadmin::where('parent_id', 0)->with(['cheaild'])->orderBy('ordering', 'asc')->get();
    }

    public function getMenuadmin()
    {
        return $this->menuadmin;
    }
}
