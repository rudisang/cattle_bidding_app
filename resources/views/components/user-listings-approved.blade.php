<div>
    <div class="row"> @php
        $date = date("Y/m/d");
    @endphp
        @foreach ($listings as $listing)
        @if ($listing->end_date < $date)
        @if (!$listing->status)
           
        @else
        @php $today = date('Y-m-d'); @endphp
            @if ($today < $listing->end_date)
            @php $images = json_decode($listing->gallery); @endphp
            <div class="col-sm-12 col-md-4">
                <div class="card" style="border:none;border-radius:20px !important;width: 18rem;">
                    <img style="border-radius:30px;width:100% !important;max-height:100px !important;object-fit:cover" class="card-img-top shadow" src="{{asset('gallery/'.$images[0])}}" alt="Card image cap">
                    <div class="card-body">
                        <div id="card" class="card shadow-sm mb-5 bg-white" style="border:none;border-radius:25px;width:100% !important">
                            <div class="card-body">
                                <h5 class="card-title">{{$listing->title}}</h5>
                                <hr>
                                <p id="demo"><strong>Curent Value: </strong>P {{$listing->base_price}}</p>
                                <p class="card-text">Posted: {{$listing->created_at->diffForHumans()}}</p>
                                
                                <hr>
                                
                                <p id="demo"><strong>Bid Ends: </strong>{{date("F jS, Y", strtotime($listing->end_date))}} <br> <strong>At: </strong> {{$listing->end_time}}</p>
                                <hr>
                               
                                <p id="demo"><strong>Total Bids: </strong>({{$listing->bids->count()}})</p>
                                <hr>
                                <a id="btn" href="bids/{{$listing->id}}" class="btn btn-outline-secondary">view listing</a>
                                <a id="btn" href="bidding/session/{{$listing->id}}" class="btn btn-outline-secondary">view bids</a>
                            </div>
                        </div>
                      
                    </div>
                  </div>
            </div>
            @endif
    @endif
            @endif
           
        @endforeach
    </div>
   
</div>