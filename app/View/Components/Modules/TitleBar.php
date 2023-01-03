<?php

namespace App\View\Components\Modules;

use Illuminate\View\Component;

class TitleBar extends Component
{
	public $title;
	
	public $center;
	
	public $right;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        $this->title = $title;
		
		$this->center = "";
		
		$this->right = "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modules.title-bar');
    }
}
