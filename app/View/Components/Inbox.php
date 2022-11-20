<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Inbox extends Component
{
	public $tab;
	public $subtitle;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tab = null, $subtitle = null)
    {
        $this->tab = $tab;
		
		$this->subtitle = match($tab)
		{
			"sent"  => "Sent Messages",
			"inbox" => "Inbox Messages",
			default => $subtitle,
		};
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inbox');
    }
}
