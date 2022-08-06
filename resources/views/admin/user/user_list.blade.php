@extends('template.admin')
@section('title', "Manage Users")

@section("content")
<main class="col-md-9 m-auto col-lg-10 w-100">
    <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Users</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <a href="{{route("users.create")}}" class="btn btn-sm btn-outline-secondary ">
          <i class="bi bi-plus-circle"></i>
            New User
        </a>
      </div>
    </div>
    @if (session('status'))
      <div class="alert alert-success">
        {{session('status')}}
      </div>
    @endif
    <div class="card ">
     
      <div class="card-header">
        <div class="row">
          <div class="col-8">
        <h2>List of Users </h2> 

        </div>
        <div class="col-4">
          <form method="post" action="{{ route('users.search') }}">
            @csrf
          <div class="input-group mb-3">
            <input type="search" class="form-control" placeholder="" name="q" >
            <button class="btn btn-info" type="submit" id="button-addon1">Search</button>
          </div>
        </form>
        </div>
        </div>
       
      </div>
      <div class="card-body">
       
        <div class="table-responsive table-bordered">
          <table class="table  table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Role</th>
                <th scope="col">Photo</th>
                <th scope="col">activate</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->birth_date}}</td>
              <td>{{$user->role}}</td>
                <td>
                @if ($user->photo)
                  @if (Str::contains($user->photo, 'https://'))
                      <img src="{{$user->photo}}" alt="{{$user->title}}" width="100px">
                      @else
                      <img src="{{asset('storage/'.$user->photo)}}" alt="{{$user->title}}" width="100px">
                  @endif
                  @else
                  <img src="{{asset('storage/images/article-default.jpg')}}" alt="{{$user->title}}" width="100px">
                @endif
              </td>
              <td>
                <div class="form-check form-switch">
                  <input class="form-check-input" onchange="if(confirm('Are you sure change the role of this user???')){
                    document.getElementById('activate-{{$user->id}}').submit();
                    }" type="checkbox" @if ($user->activate)
                      checked
                    @endif name="activate"  role="switch" id="activateed">
                </div>
                <form id="activate-{{$user->id}}" action="{{route("users.activate",['id'=>$user->id])}}" method="post">
                  @csrf
                  @method('put')
                </form>  
              </td>
            
              <td>
                <a href="{{ route('users.show', ['user'=>$user->id]) }}" title="Read more" class="btn btn-info btn-sm"><i class="bi bi-eyeglasses"></i></a>
                <a href="{{route('users.edit',['user'=>$user->id])}}" class="btn btn-success btn-sm" title="Edit"> <i class="bi bi-pencil"></i></a>
               
                <button onclick="if(confirm('Are you sure to delete???')){
                  document.getElementById('form-{{$user->id}}').submit();
                  }" class="btn btn-danger btn-sm" title="Delete"> <i class="bi bi-trash"></i></button>
               
               <form id="form-{{$user->id}}" action="{{route("users.destroy",['user'=>$user->id])}}" method="post">
                @csrf
                @method('delete')
              </form>  
            </td>
            </tr>
            @endforeach
             
            </tbody>
          </table>
         
        </div>
      </div>
      <div class="card-footer">
        {{$users->links()}}
      </div>
    </div>
</main>
@endsection