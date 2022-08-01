@extends('template.admin')
@section('title', "Manage Articles")

@section("content")
<main class="col-md-9 m-auto col-lg-10 w-100">
    <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Articles</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <a href="{{route("articles.create")}}" class="btn btn-sm btn-outline-secondary ">
          <i class="bi bi-plus-circle"></i>
            New Article
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
        <h2>List of Articles </h2> 

        </div>
        <div class="col-4">
          <form method="get" >
            <div class="input-group mb-3">
            <input type="search" class="form-control" placeholder="" name="query" aria-label="Example text with button addon" aria-describedby="button-addon1">
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
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Author</th>
                <th scope="col">Publish Date</th>
                <th scope="col">Published</th>
                <th scope="col">Photo</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($arts as $article)
            <tr>
              <td>{{$article->id}}</td>
              <td>{{$article->title}}</td>
              <td>{{ Str::limit($article->description,'30') }}</td>
              <td>{{$article->author_id}}</td>
              <td>{{$article->publication_date}}</td>
              <td>
                
                <div class="form-check form-switch">
                  <input class="form-check-input" onchange="if(confirm('Are you sure change the state of this article???')){
                    document.getElementById('publish-{{$article->id}}').submit();
                    }" type="checkbox" @if ($article->published)
                      checked
                    @endif name="published"  role="switch" id="published">
                </div>
                <form id="publish-{{$article->id}}" action="{{route("articles.publish",['id'=>$article->id])}}" method="post">
                  @csrf
                  @method('put')
                </form>  
              </td>
              <td>
                @if ($article->photo)
                  @if (Str::contains($article->photo, 'https://'))
                      <img src="{{$article->photo}}" alt="{{$article->title}}" width="100px">
                      @else
                      <img src="{{asset('storage/'.$article->photo)}}" alt="{{$article->title}}" width="100px">
                  @endif
                  @else
                  <img src="{{asset('storage/images/article-default.jpg')}}" alt="{{$article->title}}" width="100px">

                @endif
              </td>
              <td>
                <a href="{{ route('articles.show', ['article'=>$article->id]) }}" title="Read more" class="btn btn-info btn-sm"><i class="bi bi-eyeglasses"></i></a>
                <a href="{{route('articles.edit',['article'=>$article->id])}}" class="btn btn-success btn-sm" title="Edit"> <i class="bi bi-pencil"></i></a>
               
                <button onclick="if(confirm('Are you sure to delete???')){
                  document.getElementById('form-{{$article->id}}').submit();
                  }" class="btn btn-danger btn-sm" title="Delete"> <i class="bi bi-trash"></i></button>
               
               <form id="form-{{$article->id}}" action="{{route("articles.destroy",['article'=>$article->id])}}" method="post">
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
        {{$arts->links()}}
      </div>
    </div>
</main>
@endsection