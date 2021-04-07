<div>
    <div class="row">
        @php
            $date = date("Y/m/d");
        @endphp
        @foreach ($listings as $listing)
      
           @if ($listing->end_date > $date)
           @php $images = json_decode($listing->gallery); @endphp
           <div class="col-sm-12 col-md-4">
               <div class="card" style="border:none;border-radius:20px !important;width: 18rem;">
                   <img style="border-radius:30px;width:100% !important;max-height:100px !important;object-fit:cover" class="card-img-top shadow" src="{{asset('gallery/'.$images[0])}}" alt="Card image cap">
                   <div class="card-body">
                       <div id="card" class="card shadow-sm mb-5 bg-white" style="border:none;border-radius:25px;width:100% !important">
                           <div class="card-body">
                               <h5 class="card-title">{{$listing->title}}</h5>
                               <p class="card-text">Posted: {{$listing->created_at->diffForHumans()}}</p>
                               
                               <hr>
                               <p id="demo"><strong>Bid Ends: </strong>{{date("F jS, Y", strtotime($listing->end_date))}} <br> <strong>At: </strong> {{$listing->end_time}}</p>
                               <hr>
                               <a id="btn" href="bids/{{$listing->id}}" class="btn btn-outline-secondary">view</a>
                           </div>
                       </div>
                     
                   </div>
                 </div>
           </div> 
           @endif
            
           
        @endforeach
    </div>
   
</div>