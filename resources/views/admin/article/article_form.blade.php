@extends('template.admin')
@section('title', "Add Article")

@section("content")
<main class="col-md-9 m-auto col-lg-10 w-100">
    <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Articles</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <a  href="{{route("articles.list")}}" class="btn btn-sm btn-outline-secondary ">
          
            <i class="bi bi-list-ul"></i>
            Article Liste
        </a>
      </div>
    </div>


</main>
@endsection