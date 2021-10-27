<?php

namespace Viropanel\Admin\Http\Livewire\Category\Traits;

use Viropanel\Admin\Models\Category;
use Illuminate\Http\Response;

trait AddCategory
{
    public function submit()
    {
        abort_if(\Gate::denies('category_create'), Response::HTTP_FORBIDDEN, 'You do not have permission to create a category.');

        $validateData = $this->validate();
        $parent_id = $validateData['parent_id'] ?? 0;
        $ordering = Category::where('parent_id', $parent_id)->orderBy('id', 'desc')->first();
        $oder = isset($ordering) ? $ordering->ordering + 1 : 0;
        $category = Category::create([
            'parent_id' => $parent_id,
            'name' => $validateData['name'],
            'icon' => $validateData['icon'],
            'title' => $validateData['title'],
            'keywords' => $validateData['keywords'],
            'description' => $validateData['description'],
            'ordering' => $oder,
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
}
