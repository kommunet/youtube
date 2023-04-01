<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChannelEntries extends Component
{
	public $channels;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($channels)
    {
        $this->channels = $channels;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.channel-entries');
    }
}
