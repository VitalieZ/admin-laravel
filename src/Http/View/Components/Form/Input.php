<?php

namespace Viropanel\Admin\Http\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $labelText;
    public $class;
    public $iconGroupPrepend;
    public $required;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($labelText = null, $class = null, $iconGroupPrepend = null, $required = null)
    {
        $this->labelText = $labelText;
        $this->class = $class;
        $this->iconGroupPrepend = $iconGroupPrepend;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin::admin.components.form.input');
    }
}
