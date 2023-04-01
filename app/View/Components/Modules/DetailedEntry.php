<?php

namespace App\View\Components\Modules;

use Illuminate\View\Component;

class DetailedEntry extends Component
{
	public $video;
	
	public $trim;
	
	public $fulldates;
	
	public $edit;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($video, $trim = false, $fulldates = false, $edit = false)
    {
		$this->video = $video;
		
		$this->trim = ($trim == "true") ? true : false;
		
		$this->fulldates = ($fulldates == "true") ? true : false;
		
		$this->edit = ($edit == "true") ? true : false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modules.detailed-entry');
    }
}
