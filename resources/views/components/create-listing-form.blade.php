<div>
    <div class="card" style="border: none">
        <div class="card-body">
          <h5 class="card-title">Add New Listing</h5>
          <hr>
           <div style="max-width:70%;margin:auto">
            <form method="POST" action="/listing/create" enctype="multipart/form-data">
                @csrf
                 <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}" id="title" aria-describedby="emailHelp">
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
                            <input type="text" name="breed" class="form-control" value="{{old('breed')}}" id="breed">
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
                            <input type="number" step=0.05 name="base_price" class="form-control" value="{{old('base_price')}}" id="base_price">
                            @if ($errors->has('base_price'))
                            <span class="help-block">
                                <strong style="color:red">{{ $errors->first('base_price') }}</strong>
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
                    <input type="text" name="location" class="form-control" value="{{old('location')}}" id="breed">
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