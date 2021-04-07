<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\User;
use Auth;


class ListingController extends Controller
{
    public function apiGetAllListings(){
        $listings = Listing::get()->toJson(JSON_PRETTY_PRINT);
        return response($listings, 200);
    }
}
