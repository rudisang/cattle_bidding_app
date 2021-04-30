<div>
    <div class="row">
        @foreach ($listings as $listing)
            @if ($listing->status)
           
                @else
                @php $images = json_decode($listing->gallery); @endphp
            <div class="col-sm-12 col-md-4">
                <div class="card" style="border:none;border-radius:20px !important;width: 18rem;">
                    <img style="border-radius:30px;width:100% !important;max-height:100px !important;object-fit:cover" class="card-img-top shadow" src="{{asset('gallery/'.$images[0])}}" alt="Card image cap">
                    <div class="card-body">
                        <div id="card" class="card shadow-sm mb-5 bg-white" style="border:none;border-radius:25px;width:100% !important">
                            <div class="card-body">
                                <h5 class="card-title">{{$listing->title}}</h5>
                                <p class="card-text">Posted: {{$listing->created_at->diffForHumans()}}</p>
                                <a id="btn" href="/listing/edit/{{$listing->id}}" class="btn btn-outline-secondary">Edit</a>
                                <hr>
                                <p id="demo"><strong>Starts: </strong>{{date("F jS, Y", strtotime($listing->start_date))}}</p>
                                <p id="demo"><strong>Ends: </strong>{{date("F jS, Y", strtotime($listing->end_date))}} <br> <strong>At: </strong> {{$listing->end_time}}</p>
                            </div>
                        </div>
                      
                    </div>
                  </div>
            </div>
            @endif
           
        @endforeach
    </div>
   
</div>