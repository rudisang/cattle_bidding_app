@extends('layouts.dashboard')
@section('breadcrumb')
<nav aria-label="breadcrumb" >
  <div class="container">
  <ol class="breadcrumb mt-4" style="background:#fff;max-width:400px;">
    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item" aria-current="page">{{Auth::user()->role->role}} Account</li>
    <li class="breadcrumb-item active" aria-current="page">Create Listing</li>
  </ol>
</div>
</nav>

@endsection

@section('content')
  <section class="container my-4">
    <x-flash-messages />
  </section>

  <section class="container my-4">
    <x-create-listing-form />
  </section>

  <section class="container my-4">

  </section>
@endsection

@section('scripts')
<script>
    var gallery = document.getElementById('gallery');
    var content = ""
    gallery.addEventListener('change', (event) => {
        for(let i=0;i<event.target.files.length;i++){
            
            content = content + '<img class="mx-2 my-3" width=200 style="border-radius:30px" src="'+URL.createObjectURL(event.target.files[i])+'" alt=""/>';
            
            $( '#preview' ).html( content );
         }
    });
    

    $( '#preview' ).html( content );
</script>
@endsection