@extends('layouts.main')

@section('content')
@php
  $images = json_decode($listing->gallery);
   $today = date('Y-m-d'); 
@endphp

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
   
    @foreach ($images as $image)
    
    @if ($images[0] == $image)
    <div class="carousel-item active">
      <img style="max-height:50vh;object-fit:cover" src="{{asset('gallery/'.$image)}}" class="d-block w-100 dim" alt="...">
      </div>
        @else
        <div class="carousel-item">
          <img style="max-height:50vh;object-fit:cover" src="{{asset('gallery/'.$image)}}" class="d-block w-100 dim" alt="...">
          </div>
    @endif
    
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

@if ($today > $listing->start_date)

<nav aria-label="breadcrumb" >
     <div class="container">
     <ol class="breadcrumb mt-4 shadow-sm" style="background:#fff;max-width:500px;">
      @if ($today > $listing->end_date)
      <li class="breadcrumb-item active" aria-current="page"><strong>Bid Session: <span  id="demo"></span></strong></li>
      @else
      <li class="breadcrumb-item active" aria-current="page"><strong>Bid Session ends in: <span  id="demo"></span></strong></li>
      @endif
       
     </ol>
 </div>
   </nav>
   @else
   <nav aria-label="breadcrumb" style="">
     <div class="container">
     <ol class="breadcrumb mt-4 shadow-sm" style="background:#fff;max-width:500px;">
       <li class="breadcrumb-item active" aria-current="page"> <strong style="color: black !important"> Bid Session Will Begin: {{date("F jS, Y", strtotime($listing->start_date))}}</strong></li>
     </ol>
 </div>
   </nav>
   @endif

<section class="container my-4">
   <div class="card shadow" style="border: none">
    <h5 class="card-header" style="background: #fff"><span style="font-weight: 900;font-size:30px !important;color:grey !important">{{$listing->title}} </span>@guest<a href="" class="btn btn-info" style="float:right" disabled aria-disabled="disabled">Login To Place Bid</a> @else @if($today > $listing->start_date) @if(Auth::user()->id == $listing->user_id) @else @if($today > $listing->end_date) <a href="" class="btn btn-info disabled" style="float:right" disabled aria-disabled="">Bid Ended</a>@else<a href="/bidding/session/{{$listing->id}}" class="btn btn-success" style="float:right">Place Bid</a>@endif @endif @endif @endguest</h5>
    
    <div class="card-body">
      
      <h3><strong>Current Bid Price: BWP</strong>{{$listing->base_price}}.00</h3>
      <p><strong>Location: </strong>{{$listing->location}}</p>
      <p><strong>Breed: </strong>{{$listing->breed}}</p>
      <p><strong>Option: </strong>{{$listing->options}}</p>
      <strong>Description</strong>
      {!!$listing->description!!}
      <h4>Current Bids ({{$listing->bids->count()}})</h4>
      <strong>More By Seller: {{$listing->user->name}} {{$listing->user->surname}}</strong>
      
      <div class="row my-4"> 
        
        @foreach ($listing->user->listings as $list)
        @if ($list->id == $listing->id)
        @else
       
     @if ($list->status)
     @php $imgs = json_decode($list->gallery); @endphp
     <div class="col-sm-12 col-md-4">
         <div class="card" style="border:none;border-radius:20px !important;width: 18rem;">
             <img style="border-radius:30px;width:100% !important;max-height:100px !important;object-fit:cover" class="card-img-top shadow" src="{{asset('gallery/'.$imgs[0])}}" alt="Card image cap">
             <div class="card-body">
                 <div id="card" class="card shadow-sm mb-5 bg-white" style="border:none;border-radius:25px;width:100% !important">
                     <div class="card-body">
                         <h5 class="card-title">{{$list->title}}</h5>
                         <p class="card-text">Posted: {{$list->created_at->diffForHumans()}}</p>
                         
                         <hr>
                         @if ($today > $list->end_date)
                         <p id="demo"><strong>Bid Ended</strong></p>
                         @else
                         <p id="demo"><strong>Bid Ends: </strong>{{date("F jS, Y", strtotime($list->end_date))}} <br> <strong>At: </strong> {{$list->end_time}}</p>
                         @endif
                         <hr>
                         <a id="btn" href="/bids/{{$list->id}}" class="btn btn-outline-secondary">view</a>
                     </div>
                 </div>
               
             </div>
           </div>
     </div>
     @endif
    @endif
           
           
        @endforeach
    </div>
      
    </div>

    
   </div>
</section>
<script defer>

  // Set the date we're counting down to
 
  var countDownDate = new Date(<?php echo json_encode($listing->end_date); ?>).getTime();
 
  
  // Update the count down every 1 second
  var x = setInterval(function() {
  
    // Get today's date and time
    var now = new Date().getTime();
      
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
      
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
      
    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "EXPIRED";
    }
  }, 1000);
  </script>
@endsection
