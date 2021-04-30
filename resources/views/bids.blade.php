@extends('layouts.main')

@section('content')
<section class="container my-4">
    <form action="/bids" get>
        <div class="form-group">
            <input class="form-control" type="search" name="search" placeholder="search" id="">
        </div>
    </form>
</section>
<section class="container">
   <div class="row my-4">
    @foreach ($listings as $list)
 
   
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
                    <p id="demo"><strong>Starts: </strong>{{date("F jS, Y", strtotime($list->start_date))}}</p>
                    <p id="demo"><strong>Ends: </strong>{{date("F jS, Y", strtotime($list->end_date))}} <br> <strong>At: </strong> {{$list->end_time}}</p>
                    <hr>
                    <a id="btn" href="/bids/{{$list->id}}" class="btn btn-outline-secondary">view</a>
                </div>
            </div>
          
        </div>
      </div>
</div>
@endif

       
       
    @endforeach
   </div>
</section>
@endsection