<?php

namespace App\View\Components\Actions;

use Illuminate\View\Component;

class Home extends Component
{
	public $tab;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tab = null)
    {
        $this->tab = $tab;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.actions.home');
    }
}
