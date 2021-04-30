<div>
    <div class="card" style="border: none">
        <div class="card-body">
          <h5 class="card-title">Add New Listing</h5>
          <hr>
           <div style="max-width:70%;margin:auto">
            <form method="POST" action="/listing/create" enctype="multipart/form-data">
                @csrf
                 <div class="mb-3">
                    <label for="title" class="form-label" >Category <img id="qmark" onclick="showToast()" width=15 src="{{asset('images/question-circle-regular.svg')}}" alt=""></label>
                    <div id="toastinfo" style="display:none" class="alert alert-info alert-dismissible fade show" role="alert">
                        <ul>
                        <li>Cows: Must be 2yrs+</li>
                        <li>Bull: Left Intact</li>
                        <li>Steer: Castrated</li>
                        <li>Ox: 2yrs+</li>
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @php $cats = ["Heifer","Cow","Bull","Steer","Ox"]; @endphp
                    <select name="title" id="" class="form-control">
                        <option value=""selected disabled>Choose Category</option>
                        @foreach ($cats as $cat)
                            <option value="{{$cat}}" @if($cat == old('title')) selected @endif>{{$cat}}</option>
                        @endforeach
                    </select>
               
                    @if ($errors->has('title'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('title') }}</strong>
                    </span>
                @endif
                  </div>

                 <div class="row">
                     <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                            <label for="breed" class="form-label">Breed</label>
                            @php $breeds = ["Angus","Simmental","Tswana","Hereford","Brahman","Brown Swiss","Jersey","Senepol","Nguni", "Black Hereford","Holstein Friesian","Other"]; @endphp
                    <select name="breed" id="" class="form-control">
                        <option value=""selected disabled>Choose Breed</option>
                        @foreach ($breeds as $breed)
                            <option value="{{$breed}}" @if($breed == old('breed')) selected @endif>{{$breed}}</option>
                        @endforeach
                    </select>
                            @if ($errors->has('breed'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('breed') }}</strong>
                            </span>
                        @endif
                          </div>
                     </div>
                     <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                            <label for="base_price" class="form-label">Base Price</label>
                            <input type="number" min=2000 step=5.5 name="base_price" class="form-control" value="{{old('base_price')}}" id="base_price">
                            @if ($errors->has('base_price'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('base_price') }}</strong>
                            </span>
                        @endif
                          </div>
                     </div>

                     <div class="col-sm-12 col-md-12">
                        <div class="mb-3">
                            <label for="options" class="form-label">Options</label>
                            @php $options = ["250-450Kg","450-800Kg","800-1200Kg","1200-1600Kg","1600-1800Kg"]; @endphp
                    <select name="options" id="" class="form-control">
                        <option value=""selected disabled>Select Options</option>
                        @foreach ($options as $option)
                            <option value="{{$option}}" @if($option == old('options')) selected @endif>{{$option}}</option>
                        @endforeach
                    </select>
                            @if ($errors->has('options'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('options') }}</strong>
                            </span>
                        @endif
                          </div>
                     </div>
                 </div>

                 

                  <div class="mb-3">
                    <label for="mobile" class="form-label">Description</label>
                    <textarea name="description" id="editor" cols="30" rows="10">{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('description') }}</strong>
                    </span>
                @endif
                  </div>

                  <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{old('start_date')}}" id="start_date">
                            @if ($errors->has('start_date'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('start_date') }}</strong>
                            </span>
                        @endif
                          </div>
                      </div>

                      <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{old('end_date')}}" id="end_date">
                            @if ($errors->has('end_date'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('end_date') }}</strong>
                            </span>
                        @endif
                          </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                            <label for="end_time" class="form-label">End Time</label>
                            <input type="time" name="end_time" class="form-control" value="{{old('end_time')}}" id="end_time">
                            @if ($errors->has('end_time'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('end_time') }}</strong>
                            </span>
                        @endif
                          </div>
                      </div>
                  </div>

                  <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    @php $places = ["Makgalo","MakgwelaKgwele","Thoboga","Matsebeng","Nxaraga","Sedibana","Phatswa","Kguthi","Thololamoro","Lekgothwane"]; @endphp
                    <select name="location" id="" class="form-control">
                        <option value=""selected disabled>Select Location</option>
                        @foreach ($places as $place)
                            <option value="{{$place}}" @if($place == old('location')) selected @endif>{{$place}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('location'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('location') }}</strong>
                    </span>
                @endif
                  </div>
      
                  <div class="mb-3">
                      <div id="preview">

                      </div>

                    <div class="form-group">
                        <div class="custom-file">
                            <input id="gallery" type="file" name="gallery[]" accept="image/*" class="custom-file-input" id="customFile" multiple required>
                            <label class="custom-file-label" for="customFile">Choose files</label>
                          </div>
                        @if ($errors->has('gallery'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('gallery') }}</strong>
                        </span>
                    @endif
                      </div>
                  </div>
   
                <button type="submit" class="btn btn-primary" style="background-color: #374151;border:none">Save</button>
              </form>
           </div>
        </div>
      </div>
</div>

<script>
    let toast = document.getElementById('toastinfo')

function showToast(){
    toast.style.display = "block";
}
</script>