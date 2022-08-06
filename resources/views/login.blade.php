@extends("template.user")

@section('title',"login")
@section("content")
<div class="container">
    
    @if(session('error'))
    <div class="alert alert-danger">
                {{ session('error') }}
    </div>
    @endif
    <div class="card mx-auto" style="width: 25rem;">
        <div class="card-body">
            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label  class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label">Password</label>
                    <input type="password" class="form-control @error('email') is-invalid @enderror" name="password" >
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection