@extends('template.admin')
@section('title', "Add User")

@section("content")
<main class="col-md-9 m-auto col-lg-10 w-100">
    <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Users</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <a  href="{{route("users.list")}}" class="btn btn-sm btn-outline-secondary ">
          
            <i class="bi bi-list-ul"></i>
            User Liste
        </a>
      </div>
    </div>

    @if (session('error'))
      <div class="alert alert-danger">
        {{session('error')}}
      </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Add new User</h4>
      </div>
      <div class="card-body">
        <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row m-2">
            <div class="col">
              <div class="form-group">
                <input type="text" class="form-control  @error('name')is-invalid @enderror" name="name" placeholder="User Name" value="{{old('name')}}" >
                @error('name')
                <div class="alert alert-danger">
                 {{$message}}
                </div>
             @enderror
              </div>
            </div>
            <div class="col">
                <div class="form-group ">
                 <input type="email" name="email" class="form-control  @error('email')is-invalid @enderror" placeholder="exemple@email.com" value="{{old('email')}}">
                </div>
                @error('email')
                <div class="alert alert-danger">
                 {{$message}}
                </div>
                @enderror
              </div>
          </div>

            <div class="row m-2">
            <div class="col">
              <div class="form-group ">
               <input type="date" class="form-control  @error('birth_date')is-invalid @enderror" name="birth_date"  value="{{old('birth_date')}}">
              </div>
              @error('birth_date')
              <div class="alert alert-danger">
               {{$message}}
              </div>
              @enderror
            </div>
          </div>

          <div class="row m-2">
            <div class="col">
              <div class="form-group">
                <input type="file" class="form-control" name="photo" id="title" placeholder="Post image" value="{{old('photo')}}" >
                @error('photo')
                <div class="alert alert-danger">
                 {{$message}}
                </div>
                @enderror
              </div>
            </div>
            <div class="col">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="admin"  role="switch" id="admin">
                <label class="form-check-label" for="admin">Is Admin</label>
              </div>
            </div>
          </div>
          <button class="btn btn-md btn-primary m-4"> <i class="bi bi-plus-circle"></i> Save</button>
        </form>
    
      </div>
    </div>
</main>
@endsection