<?php

namespace Viropanel\Admin\Http\Livewire\Category\Traits;

trait ResetFormCategory
{
    public function resetform()
    {
        $this->reset(['parent_id']);
        $this->reset(['name']);
        $this->reset(['icon']);
        $this->reset(['title']);
        $this->reset(['keywords']);
        $this->reset(['description']);
        $this->reset(['visible']);
        $this->method = 0;
    }
}
