<?php 
$name = session('name');	
$email = session('email');
$images = session('images');
$likes = DB::table('likes')->get();  
?>

<navbar>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/allpost">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/myprofile">Profile</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{$name}}
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Messages</a></li>
                <li><a class="dropdown-item" href="/post">Post items</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/logout">log out</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" action="/search" method="GET" >
            <input class="form-control me-2" placeholder="Search" aria-label="Search" name="query">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </navbar>
