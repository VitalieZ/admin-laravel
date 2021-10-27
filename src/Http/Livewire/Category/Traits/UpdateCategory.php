<?php

namespace Viropanel\Admin\Http\Livewire\Category\Traits;

use Viropanel\Admin\Models\Category;
use Illuminate\Http\Response;

trait UpdateCategory
{
    public function update()
    {
        if ($this->category_id === null) {
            return;
        }
        abort_if(\Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, 'You do not have permission to edit a category.');
        $validateData = $this->validate();

        $parent_id = $validateData['parent_id'] ?? 0;
        $cat = Category::where('id', $this->category_id)->first();
        $cat->update([
            'parent_id' => $parent_id,
            'name' => $validateData['name'],
            'icon' => $validateData['icon'],
            'title' => $validateData['title'],
            'keywords' => $validateData['keywords'],
            'description' => $validateData['description'],
            'visible' => $validateData['visible']
        ]);
        if ($cat) {
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
                'message' => "Category Edit Successfully!!"
            ]);
        }
    }
}
