<div>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Status</th>
          <th scope="col">Added</th>
          <th scope="col">Action</th>
          <th scope="col"><form method="GET" action="/dashboard"><input class="form-control" placeholder="search" type="search" name="search-listing" id=""></form></th>
        </tr>
      </thead>
      <tbody>
          @foreach($listings as $listing)
         
          <tr>
            <th scope="row">{{$listing->id}}</th>
            <td>{{$listing->title}}</td>
            <td>@if ($listing->status)
                <a class="btn btn-success">Approved</a>
                @else
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ex{{$listing->id}}">
                    Awaiting Approval
                  </button>
            @endif</td>
            <td>{{$listing->created_at->diffForHumans()}}</td>
            <td><a href="/admin/listing/edit/{{$listing->id}}" class="btn btn-warning">Edit</a></td>
            <td></td>
          </tr>
         
  <!-- Modal -->
  <div class="modal fade" id="ex{{$listing->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Approve Listing</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/approve/listing/{{$listing->id}}" method="POST">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group">
                <select name="approve" id="" class="form-control">
                    <option value="" selected disabled>Select Action</option>
                    <option value="1">Approve</option>
                </select>
            </div>
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>

          @endforeach

  

      </tbody>
    </table>
</div>