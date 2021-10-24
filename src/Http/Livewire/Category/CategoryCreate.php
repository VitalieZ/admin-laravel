<?php

namespace Viropanel\Admin\Http\Livewire\Category;

use Livewire\Component;
use Viropanel\Admin\Http\Requests\StoreCategoryRequest;
use Viropanel\Admin\Models\Category;
use Illuminate\Http\Response;

class CategoryCreate extends Component
{
    public $parent_id;
    public $name;
    public $icon;
    public $title;
    public $keywords;
    public $description;
    public $visible;

    protected $rules = [
        'parent_id' => '',
        'name' => 'required|min:4|max:20',
        'icon' => 'max:20',
        'title' => 'max:255',
        'keywords' => 'max:255',
        'description' => 'max:255',
        'visible' => '',
    ];

    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('admin::admin.category.livewire.categorycreate');
    }

    public function submit()
    {
        //abort_if(\Gate::denies('category_create'), Response::HTTP_FORBIDDEN, 'You do not have permission to create a category.');

        $validateData = $this->validate();
        $parent_id = $validateData['parent_id'] ?? 0;
        $category = Category::create([
            'parent_id' => $parent_id,
            'name' => $validateData['name'],
            'icon' => $validateData['icon'],
            'title' => $validateData['title'],
            'keywords' => $validateData['keywords'],
            'description' => $validateData['description'],
            'visible' => $validateData['visible']
        ]);
        if ($parent_id == 0) {
            $category->tree_id =  $category->id;
        } else {
            $category->tree_id = $parent_id;
        }
        $category->save();
    }
}
