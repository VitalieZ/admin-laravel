<?php

namespace Viropanel\Admin\Http\Livewire\Category\Traits;

use Viropanel\Admin\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

trait AddCategory
{
    public function submit()
    {
        abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, trans('admin::category.create.permissions.not_access_create_cateogy'));

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
        if ($category) {
            $this->reset(['parent_id']);
            $this->reset(['name']);
            $this->reset(['icon']);
            $this->reset(['title']);
            $this->reset(['keywords']);
            $this->reset(['description']);
            $this->reset(['visible']);

            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => trans('admin::category.create.success_created')
            ]);
        } else {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => trans('admin::category.create.error_created')
            ]);
        }
    }
}
