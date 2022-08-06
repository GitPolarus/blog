<nav class="navbar navbar-dark navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Blog FS-08</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
         
        

          @auth
            @if (Auth::user()->role=="admin")
            <li class="nav-item">
            <a class="nav-link" href="#">Articles</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="/admin">Dashbord</a>
             </li>
            @endif
            <li class="nav-item">
            <a class="nav-link btn btn-danger" href="/logout">Logout</a>
            </li>
          @endauth
          
          @guest
              <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
          </li>
          @endguest
        
        </ul>
      </div>
    </div>
  </nav>