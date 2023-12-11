<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    public $type;

    public $label;

    public $value;

    public $id;

    public $name;

    public $class;

    public $mandate;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $label, $value = null, $id = null, $name = null, $class = null, $mandate = "")
    {
        $this->type = $type;
        $this->label = $label;
        $this->value = $value;
        $this->id = $id;
        $this->name = $name;
        $this->class = $class;
        $this->mandate = $mandate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
