<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Listing;
class AdminListingsTable extends Component
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
        if(request()->has('search-listing')){
            $search = request()->get('search-listing');
            $listings = Listing::where('title', 'like', '%'.$search.'%')->
            orWhere('status', 'like', '%'.$search.'%')->
            orWhere('breed', 'like', '%'.$search.'%')->paginate(20);
          }else{
            $listings = Listing::all();
          }
      
        return view('components.admin-listings-table')->with('listings', $listings);
    }
}
