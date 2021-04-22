@extends('layouts.dashboard')
@section('breadcrumb')
   
        <nav aria-label="breadcrumb" >
            <div class="container">
            <ol class="breadcrumb mt-4 shadow-sm" style="background:#fff;max-width:500px;">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{Auth::user()->role->role}} Account</li>
            </ol>
        </div>
          </nav>
  
@endsection
@section('content')
<section class="container my-4">
  <x-flash-messages />
</section>
<!-- Seller Dashboard Views -->
@if(Auth::user()->role_id == 2)
    <section class="container my-4">

    </section>

    <section class="container my-4">
      <div class="card shadow-sm" style="border: none">
          <h5 class="card-header" style="background: #fff">Pending Approval</h5>
          <div class="card-body">
              @if (Auth::user()->listings->isNotEmpty())
                <x-user-listings />
                @else
                <p style="color:grey">No Pending Listings</p>
              @endif
          </div>
        </div>
     </section>

    <section class="container my-4">
      <div class="card shadow-sm" style="border: none">
          <h5 class="card-header" style="background: #fff">Running Listings</h5>
          <div class="card-body">
            @if (Auth::user()->listings->isNotEmpty())
                <x-user-listings-approved />
                @else
                <p style="color:grey">No Listings. <a href="/listing/create">add now</a></p>
              @endif
             
           <!-- <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a> -->
          </div>
        </div>
     </section>

     <section class="container my-4">
      <div class="card shadow-sm" style="border: none">
          <h5 class="card-header" style="background: #fff">Bid History</h5>
          <div class="card-body">
            @if (Auth::user()->listings->isNotEmpty())
                <x-user-bid-history />
                @else
                <p style="color:grey">No History.</p>
              @endif
          </div>
        </div>
     </section>

     <div style ="position: fixed; bottom: 30px;right:30px;background:rgb(180, 117, 0);padding:10px;border-radius:100%;">
      <a style="background:none;border:none;font-weight: 900;" class="btn btn-info" href="/listing/create">+</a>

  </div>
@endif

@if(Auth::user()->role_id == 1)
<!-- Bidder Dashboard Views -->
@php $today = date('Y-m-d'); @endphp
<section class="container my-4">
  <div class="card" style="border: none">
      <h5 class="card-header" style="background: #fff">My Bids</h5>
      <div class="card-body">
        @if (Auth::user()->bids->count() > 0)
        <div class="row">
          @foreach (Auth::user()->bids as $bid)
         
              @php $images = json_decode($bid->listing->gallery); @endphp
              <div class="col-sm-12 col-md-4">
                  <div class="card" style="border:none;border-radius:20px !important;width: 18rem;">
                      <img style="border-radius:30px;width:100% !important;max-height:100px !important;object-fit:cover" class="card-img-top shadow" src="{{asset('gallery/'.$images[0])}}" alt="Card image cap">
                      <div class="card-body">
                          <div id="card" class="card shadow-sm mb-5 bg-white" style="border:none;border-radius:25px;width:100% !important">
                              <div class="card-body">
                                  <h5 class="card-title">{{$bid->listing->title}}</h5>
                                  <hr>
                                  <p id="demo"><strong>Curent Value: </strong>P {{$bid->listing->base_price}}</p>
                                  <p class="card-text">Posted: {{$bid->listing->created_at->diffForHumans()}}</p>
                                  
                                  <hr>
                                  
                                  @if ($today > $bid->listing->end_date)
                                  <p id="demo"><strong class="btn btn-warning">Bid Ended</strong></p>
                                    @else
                                    <p id="demo"><strong>Bid Ends: </strong>{{date("F jS, Y", strtotime($bid->listing->end_date))}} <br> <strong>At: </strong> {{$bid->listing->end_time}}</p>
                                  @endif
                                  <hr>
                                 
                                  <p id="demo"><strong>Total Bids: </strong>({{$bid->listing->bids->count()}})</p>
                                  <hr>
                                  <a id="btn" href="bids/{{$bid->listing->id}}" class="btn btn-outline-secondary">view listing</a>
                                  <a id="btn" href="bidding/session/{{$bid->listing->id}}" class="btn btn-outline-secondary">view bids</a>
                                  <br><hr>
                                  <a id="btn" href="" class="btn btn-danger" data-toggle="modal" data-target="#deletebid{{$bid->id}}">Withdraw Bid</a>
                              </div>
                          </div>
                        
                      </div>
                    </div>
              </div>
  
              <div class="modal fade" id="deletebid{{$bid->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">⚠️Warning</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="/bidding/session/{{$bid->id}}" method="post">
                        {{ method_field('DELETE') }}
                    @csrf
                    <h5>Are you sure you want to withdraw your bid?</h5>
                    <input type="hidden" name="listing" value="{{$bid->listing->id}}">
                    
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Nope</button>
                      <button type="submit" class="btn btn-danger">Yes i'm sure</button>
                    </div>
                </form>
                  </div>
                </div>
             
          @endforeach
      </div>
     
        @else
        <h2 class="text-center">Nothing Yet</h2>
        @endif
          
       
      </div>
    </div>
 </section>
@endif

@if(Auth::user()->role_id == 3)
<section class="container my-4">
  <a href="/dashboard/create-user" class="btn btn-info">Create New User</a>
 </section>

<section class="container my-4">
  <h3>Users</h3>
  <x-admin-user-table />
 </section>

 <section class="container my-4">
   <h3>Listings</h3>
  <x-admin-listings-table />
 </section>
@endif


@endsection