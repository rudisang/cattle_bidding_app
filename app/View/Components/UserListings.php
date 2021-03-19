<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Listing;
use App\Models\User;
class UserListings extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('components.user-listings')->with('listings', $user->listings);
    }
}
