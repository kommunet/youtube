<?php

namespace App\View\Components;

use App\Models\User;

use Illuminate\View\Component;

class OnlineUsers extends Component
{
	public $users;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($limit = 4)
    {
        $this->users = User::limit($limit)->orderByDesc("last_login")->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.online-users');
    }
}
