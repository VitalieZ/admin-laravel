<?php

namespace Viropanel\Admin\Http\Livewire\Category\Traits;

use Viropanel\Admin\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

trait UpdateCategory
{
    public function update()
    {
        if ($this->category_id === null) {
            return;
        }
        abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, trans('admin::category.edit.permissions.not_access_edit_cateogy'));
        $validateData = $this->validate();

        $parent_id = $validateData['parent_id'] ?? 0;
        $cat = Category::where('id', $this->category_id)->first();
        if ($cat) {
            $cate = $cat->update([
                'parent_id' => $parent_id,
                'name' => $validateData['name'],
                'icon' => $validateData['icon'],
                'title' => $validateData['title'],
                'keywords' => $validateData['keywords'],
                'description' => $validateData['description'],
                'visible' => $validateData['visible']
            ]);
            if ($cate) {
                $this->reset(['parent_id']);
                $this->reset(['name']);
                $this->reset(['icon']);
                $this->reset(['title']);
                $this->reset(['keywords']);
                $this->reset(['description']);
                $this->reset(['visible']);
                $this->method = 0;
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'success',
                    'message' => trans('admin::category.edit.success_edit')
                ]);
            } else {
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'error',
                    'message' => trans('admin::category.edit.error_edit')
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => trans('admin::category.edit.not_found_category')
            ]);
        }
    }
}
