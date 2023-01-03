<?php

namespace App\View\Components\Actions;

use Illuminate\View\Component;

use App\Enums\Video\Sort;

class Videos extends Component
{
	public $selected;
	
	public $sorts = [
		Sort::MostRecent,
		Sort::MostViewed,
		Sort::MostDiscussed,
		Sort::MostFavorited,
		Sort::TopRated,
		Sort::RecentlyFeatured,
		Sort::Random,
	];
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $selected = null)
    {
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.actions.videos');
    }
}
