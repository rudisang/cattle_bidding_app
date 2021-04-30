<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\Listing;
use App\Models\Bid;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
     
            $roles = Role::all();
            $users = User::all();
            return view('dashboard.index')->with('roles', $roles)->with('users', $users);
    }

    public function editUser($id){
        $user = User::find($id);

        // Check for correct user
        if(auth()->user()->role_id !== 3){
            return redirect('/dashboard')->with('error', 'You are not authorized to view that page');
        }

        return view('/dashboard.edit-users')->with('user', $user);
    }

    public function editAccount(){
        return view('dashboard.edit-account');
    }

    public function updatePassword(Request $request, $id){
        $user = User::find($id);

        $oldpass = $request->old_pass;
        $newpass = $request->new_pass;
        $confpass = $request->conf_pass;

        if (Hash::check($oldpass, $user->password)) {
            if($newpass == $confpass){
                $request->validate([
                    'new_pass' => 'required|string|min:6',
                    'conf_pass' => 'required|string|min:6',
                    'old_pass' => 'required|string|min:6',
                ]);

                $user->password = Hash::make($request->new_pass);
                $user->save();
                return back()->with("success", "Awesome! Password Updated");

            }else{
                return back()->with("error", "New Password & Confirm Password Don't Match");
            }
        }else{
            return back()->with("error", "The password you entered does not match your current password");

        }


    }

    public function updateDetails(Request $request, $id){
       
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'age' => 'required|date',
            'mobile' => 'required',
            'role_id' => 'required',
        ]);

		$user = User::find($id);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->mobile = $request->mobile;
        $user->role_id = intval($request->role_id);

    
            
        $user->save();
        return back()->with("success", "Details Updated Successfully");

    }

    public function deleteUser($id){
       
		$user = User::find($id);
       
        $user->delete();
        return redirect('/dashboard')->with("success", "User id:".$user->id." Successfully Deleted");

    }
    public function createUser(){
        $roles = Role::all();
     return view('dashboard.create-user')->with('roles', $roles);
    }

    public function createListing(){
        return view('/dashboard.create-listing');
    }

    public function approveListing(Request $request, $id){
        $request->validate([
            'approve' => 'required',
        ]);

        $listing = Listing::find($id);
        $listing->status = true;
        $listing->save();

        return redirect('/dashboard')->with("success", "Listing Approved");
    }

    public function editListing($id){
        $listing = Listing::find($id);
        if(Auth::user()->id != $listing->user_id){
            return redirect('/dashboard')->with('warning','404 Page does not exist');
        }else{
            if($listing->status){
                return redirect('/dashboard')->with('error','once a listing has been approved you cannot edit it');
            }else{
                return view('dashboard.edit-listing')->with('listing',$listing);
            }
        }  
    }

    public function updateListing(Request $request, $id){
        $request->validate([
            'title' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'gallery' => '',
            'options' => 'required',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:tomorrow',
            'end_time' => 'required',
            'location' => 'required',
            'base_price' => 'required',
            'description' => 'required',
        ]);

        $gallery = array();

        if($request->hasFile('gallery')){
            foreach($request->gallery as $image){
                
                array_push($gallery, $image->getClientOriginalName().time().'.'.$image->extension());
                $image->move(public_path('gallery'), $image->getClientOriginalName().time().'.'.$image->extension());
            }
        }

        $images = json_encode($gallery);

        $listing = Listing::find($id);

      
        $listing->title = $request->title;
        $listing->breed = $request->breed;
        if($request->hasFile('gallery')){
        $listing->gallery = $images;
        }
        $listing->end_date = $request->end_date;
        $listing->start_date = $request->start_date;
        $listing->options = $request->options;
        $listing->end_time = $request->end_time;
        $listing->location = $request->location;
        $listing->base_price = $request->base_price;
        $listing->old = $request->base_price;
        $listing->description = $request->description;
        $listing->status = 0;
        

        $listing->save();

        return redirect('/dashboard')->with('success', 'Listing Updated');

    }

    public function storeListing(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'gallery' => 'required',
            'options' => 'required',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:tomorrow',
            'end_time' => 'required',
            'location' => 'required',
            'base_price' => 'required',
            'description' => 'required',
        ]);

        $gallery = array();

        if($request->hasFile('gallery')){
            foreach($request->gallery as $image){
                
                array_push($gallery, $image->getClientOriginalName().time().'.'.$image->extension());
                $image->move(public_path('gallery'), $image->getClientOriginalName().time().'.'.$image->extension());
            }
        }

        $images = json_encode($gallery);

        $listing = new Listing;

        $listing->user_id = auth()->user()->id;
        $listing->title = $request->title;
        $listing->breed = $request->breed;
        $listing->gallery = $images;
        $listing->end_date = $request->end_date;
        $listing->start_date = $request->start_date;
        $listing->options = $request->options;
        $listing->end_time = $request->end_time;
        $listing->location = $request->location;
        $listing->base_price = $request->base_price;
        $listing->old = $request->base_price;
        $listing->description = $request->description;
        $listing->status = 0;
        

        $listing->save();

        return redirect('/dashboard')->with('success', 'New Listing Added');

    }

    public function storeNewUser(Request $request){
        $agelimit = date("2003-12-29");
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'age' => 'required|date|before:'.$agelimit,
            'mobile' => 'required',
            'role_id' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'age' => $request->age,
            'mobile' => $request->mobile,
            'role_id' => intval($request->role_id),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

       

        return redirect('/dashboard')->with('success', 'New User Added');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function biddingSession($id)
    {
        $listing = Listing::find($id);

        $today = date('Y-m-d');

        if($today > $listing->end_date){
            return redirect('/dashboard')->with('info','Sorry! Looks like the bidding session you tried to enter has ended');
        }else{
            return view('dashboard.bid-session')->with('listing',$listing);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeBid(Request $request,$id)
    {
        $request->validate([
            'amount' => 'required',
        ]);

        $listing = Listing::find($id);
        $listing->base_price = $request->amount;
        $listing->save();

        Bid::create([
            'user_id' => Auth::user()->id,
            'listing_id' => $id,
            'current_bid' => $request->amount,
        ]);

        return back()->with('success', 'Congratualations you\'re in the race! Good Luck');
    }

    public function updateBid(Request $request,$id)
    {
        $request->validate([
            'amount' => 'required',
        ]);

        $listing = Listing::find($id);
        $bid = Bid::find(intval($request->bid));

        $bid->current_bid = $request->amount;
   
        $bid->save();
        $listing->base_price = $request->amount;
        $listing->save();

        

        return back()->with('success', 'Update Success');
    }

    public function withdrawBid(Request $request,$id)
    {

        $bid = Bid::find($id);
        $listing = Listing::find(intval($request->listing));


      if($listing->base_price == $bid->current_bid){

        if($listing->bids->count() > 1){
            
            $bid->delete();
            $bids = $listing->bids->sortByDesc('current_bid');
            $bid = $bids->values();
            
            $bd = $bid->get(1);
            $listing->base_price = $bd->current_bid;
            $listing->save();
            return back()->with('success', 'Your Bid Has Been Withdrawn');
        }else{
            $bid->delete();
            $listing->base_price = $listing->old;
            $listing->save();
            return back()->with('success', 'Your Bid Has Been Withdrawn');
        }

      }else{
        $bid->delete();
        return back()->with('success', 'Your Bid Has Been Withdrawn');
      }
   
     

        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
