<?php

namespace Viropanel\Admin\Http\Livewire\Category;

use Livewire\Component;
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
    public $seoblock;
    public $data;

    protected $rules = [
        'parent_id' => '',
        'name' => 'required|min:4|max:20',
        'icon' => 'max:20',
        'title' => 'max:255',
        'keywords' => 'max:255',
        'description' => 'max:255',
        'visible' => '',
    ];

    public function mount()
    {
        $this->data = Category::orderBy('id', 'asc')->get()->keyBy('id')->toArray();
        $this->category = $this->getTree();
        $this->seoblock = 0;
    }

    public function render()
    {
        return view('admin::admin.category.livewire.categorycreate', [
            'category' => $this->category,
        ]);
    }

    public function submit()
    {
        abort_if(\Gate::denies('category_create'), Response::HTTP_FORBIDDEN, 'You do not have permission to create a category.');

        $validateData = $this->validate();
        $parent_id = $validateData['parent_id'] ?? 0;
        $ordering = Category::where('parent_id', $parent_id)->orderBy('id', 'desc')->first();
        $category = Category::create([
            'parent_id' => $parent_id,
            'name' => $validateData['name'],
            'icon' => $validateData['icon'],
            'title' => $validateData['title'],
            'keywords' => $validateData['keywords'],
            'description' => $validateData['description'],
            'ordering' => $ordering->ordering + 1,
            'visible' => $validateData['visible']
        ]);
        if ($parent_id == 0) {
            $category->tree_id =  $category->id;
        } else {
            $category->tree_id = $parent_id;
        }
        $category->save();

        $this->reset(['parent_id']);
        $this->reset(['name']);
        $this->reset(['icon']);
        $this->reset(['title']);
        $this->reset(['keywords']);
        $this->reset(['description']);
        $this->reset(['visible']);

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Category Created Successfully!!"
        ]);
    }

    public function seoblock()
    {
        if ($this->seoblock == 0) {
            $this->seoblock = 1;
        } else {
            $this->seoblock = 0;
        }
    }

    protected function getTree()
    {
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }
}
