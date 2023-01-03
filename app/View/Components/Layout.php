<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Layout extends Component
{
	public $tab;
	public $actions;
	public $title;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tab = null, $title = "Broadcast Yourself.")
    {
        $this->tab = $tab;
		
		$this->actions = "";
		
		$this->title = $title;
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
