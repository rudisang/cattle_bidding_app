@extends('layouts.dashboard')
@section('breadcrumb')
<nav aria-label="breadcrumb" >
  <div class="container">
  <ol class="breadcrumb mt-4" style="background:#fff;max-width:400px;">
    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item" aria-current="page"> <a href="/bids/{{$listing->id}}">{{$listing->title}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Bid Session</li>
  </ol>
</div>
</nav>

@endsection

@section('content')
@if(Auth::user()->id != $listing->user_id)

@php $theBid; $isBid = false; @endphp

@foreach (Auth::user()->bids as $mybid)
    @if ($mybid->listing_id == $listing->id)
       @php $isBid = true; 
       $theBid = $mybid; @endphp
    @endif
@endforeach

@endif
  <section class="container my-4">
    <x-flash-messages />
  </section>
  <nav aria-label="breadcrumb" >
    <div class="container">
    <ol class="breadcrumb mt-4" style="background:#fff;max-width:400px;">
      <li class="breadcrumb-item" aria-current="page">Current Bid Value: <strong style="font-size: 20px">P {{$listing->base_price}}</li>
      
    </ol>
  </div>
  </nav>

  <section class="container my-4" style="display: none">
      
    <div class="card" style="border:none">
        <div class="card-body">
            <p ></strong></p>
        </div>
    </div>
  </section>

  <section class="container my-4">
    <div class="card" style="border:none">
        <div class="card-body">
            <h5 class="card-title">@if($listing->bids->count() > 0) Bidders Table @else Welcome @endif @if(Auth::user()->id == $listing->user_id) @else @if($isBid)<a href="" class="btn btn-info" style="float:right" data-toggle="modal" data-target="#updatebid">update bid</a> @else <a href="" class="btn btn-info" style="float:right" data-toggle="modal" data-target="#newbid">New Bid</a> @endif @endif</h5>
        <hr>

        @if ($listing->bids->count() > 0)
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>
            <tbody>
                @php $bbids = $listing->bids->sortbydesc('current_bid'); @endphp
                @foreach($bbids as $bid)
               
                <tr>
                  <th scope="row">{{$bid->id}}</th>
                  <td>{{$bid->user->name}}</td>
                  <td>{{$bid->user->surname}}</td>
                  <td>P {{$bid->current_bid}}</td>
                </tr>
                
    
                @endforeach
    
        
     
            </tbody>
          </table>
            @else
            <p class="text-center">Looks like you're first here</p>
        @endif
        </div>
    </div>
  </section>

  <div class="modal fade" id="newbid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Place Your Bid</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/bidding/session/{{$listing->id}}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Your Amount</label>
            <input type="number" min="{{$listing->base_price}}" name="amount" id="" placeholder="Must be greater than P{{$listing->base_price}}" class="form-control" required>
        </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Place Bid</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="updatebid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Bid</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/bidding/session/{{$listing->id}}" method="post">
            {{ method_field('PATCH') }}
        @csrf
        <div class="form-group">
            <label for="">Your Amount</label>
@if (Auth::user()->id != $listing->user_id && $isBid)
<input type="hidden" name="bid" value="{{$theBid->id}}">
<input type="number" min="{{$listing->base_price}}" value="{{$theBid->current_bid}}" name="amount" id="" placeholder="Must be greater than P{{$listing->base_price}}" class="form-control" required>
@endif
        </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Update</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  
@endsection