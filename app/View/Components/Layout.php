<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Layout extends Component
{
	public $tab;
	public $actions;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tab = null)
    {
        $this->tab = $tab;
		$this->actions = "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout');
    }
}
