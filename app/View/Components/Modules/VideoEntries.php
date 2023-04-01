<?php

namespace App\View\Components\Modules;

use Illuminate\View\Component;

class VideoEntries extends Component
{
	public $videos;
	
	public $type;
	
	public $trim;
	
	public $fulldates;
	
	public $edit;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($videos, $type, $trim = false, $fulldates = false, $edit = false)
    {
        $this->videos = $videos;
		
		$this->type = $type;
		
		$this->trim = $trim;
		
		$this->fulldates = $fulldates;
		
		$this->edit = $edit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modules.video-entries');
    }
}
