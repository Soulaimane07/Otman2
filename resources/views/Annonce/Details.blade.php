@extends('General.General')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body Header">
                <h2 class="fw-semibold"> {{$annance['title']}} </h2>
            </div>
        </div>
        
        <div class="container-fluid col-12 col-sm-6 mx-auto">
            <img src="{{asset('storage/images/annaces/'. $annance->image)}}" style="width: 100%" class="card-img-top AnnanceImage" alt="...">
            <div class="card-body">
                <h2 class=""> {{$annance['title']}} </h2>
                <p class=""> {{$annance['desc']}} </p>
                @if($annance->video)
                <div style="margin-bottom: 60px;" class="mx-auto col-12 col-sm-8">
                  <video class="Video" src="{{asset('storage/videos/annaces/'. $annance->video)}}" poster="{{asset('storage/images/annaces/'. $annance->image)}}" controls width="100%" ></video>
                </div>
                @endif
            </div>
            <div class="Buttons">
                <button type="button" class="btn btn-success p-3" data-bs-toggle="modal" data-bs-target="#updateModal">Update</button>
                <button type="button" class="btn btn-danger p-3" data-bs-toggle="modal" data-bs-target="#deleteModal" >Delete</button>
            </div>

          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body p-4">
              <div class="mx-50 w-100 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-100 icon icon-tabler icon-tabler-alert-circle-filled" width="50" height="50" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 2c5.523 0 10 4.477 10 10a10 10 0 0 1 -19.995 .324l-.005 -.324l.004 -.28c.148 -5.393 4.566 -9.72 9.996 -9.72zm.01 13l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -8a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="#dc3545"></path>
                </svg>
              </div>
              <h4 class="mb-8" style="text-align: center"> Vous voulez vraiment supprimer l'annance ? </h4> 
              <br>
              <div class="Buttons">
                  <button data-bs-toggle="modal" data-bs-target="#deleteModal" type="button" class="button btn btn-success">Non, Cancel</button>
                  <form class="button" action="{{url('/admin/annance/'.$annance['id'])}}" method="post">
                      {{method_field('DELETE')}}
                      {{csrf_field()}}
                      <button id="delete" class="w-100 btn btn-danger"> Oui, I'm sure </button> 
                  </form>
              </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Update Annance </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form method="POST" action="/admin/annance/{{$annance['id']}}" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="image" class="form-label"> Image </label>
                    <input id="image" type="file" name="image" value="{{$annance['image']}}" accept="image/*" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="video" class="form-label"> Video </label>
                    <input id="video" type="file" name="video" value="{{$annance['video']}}" accept="video/*" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="full_name" class="form-label"> Title </label>
                    <input id="title" type="text" name="title" value="{{$annance['title']}}" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="desc" class="form-label"> Description </label>
                    <textarea class="form-control" name="desc" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">
                      {{$annance['desc']}}
                    </textarea>
                  </div>
                  <div class="modal-footer">
                    <a  class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    <button  class="btn btn-primary">Save changes</button>
                  </div>
                </form>
          </div>
        </div>
      </div>
    </div>
@endsection
