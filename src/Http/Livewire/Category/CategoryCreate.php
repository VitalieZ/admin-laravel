<?php

namespace Viropanel\Admin\Http\Livewire\Category;

use Livewire\Component;
use Viropanel\Admin\Models\Category;
use Illuminate\Http\Response;
use Viropanel\Admin\Http\Livewire\Category\Traits\AddCategory;
use Viropanel\Admin\Http\Livewire\Category\Traits\UpdateCategory;
use Viropanel\Admin\Http\Livewire\Category\Traits\ResetFormCategory;


class CategoryCreate extends Component
{
    use AddCategory, UpdateCategory, ResetFormCategory;

    public $parent_id;
    public $name;
    public $icon;
    public $title;
    public $keywords;
    public $description;
    public $visible;
    public $seoblock;
    public $menu;
    public $method;
    public $edit;
    public $category_id;

    protected $listeners = ['edit' => 'edit'];

    protected $rules = [
        'parent_id' => '',
        'name' => 'required|min:4|max:20',
        'icon' => 'max:20',
        'title' => 'max:255',
        'keywords' => 'max:255',
        'description' => 'max:255',
        'visible' => '',
    ];

    public function mount($menu)
    {
        $this->seoblock = 0;
        $this->method = 0;
        $this->menu = $menu->toArray();
    }

    public function render()
    {
        return view('admin::admin.category.livewire.categorycreate');
    }

    public function edit($id)
    {
        abort_if(\Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, 'You do not have permission to edit a category.');

        $cat = Category::where('id', $id)->first();
        if ($cat) {
            $this->parent_id = $cat->parent_id;
            $this->name = $cat->name;
            $this->icon = $cat->icon;
            $this->title = $cat->title;
            $this->keywords = $cat->keywords;
            $this->description = $cat->description;
            $this->visible = $cat->visible;
            $this->method = 1;
            $this->category_id = $id;
        }
    }

    public function seoblock()
    {
        if ($this->seoblock == 0) {
            $this->seoblock = 1;
        } else {
            $this->seoblock = 0;
        }
    }
}
