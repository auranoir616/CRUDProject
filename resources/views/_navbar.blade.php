<?php 
$name = session('name');	
$email = session('email');
$images = session('images');
$likes = DB::table('likes')->get();  
$user = auth()->user()
?>

<navbar>
    <nav class="navbar navbar-expand-lg bg-body-tertiary  bg-dark border-bottom border-body" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="../logo.png" alt="Bootstrap" width="60" height="60" style="border-radius: 50px">
        </a>
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
                <li><a class="dropdown-item" href="/messages/{{$user->id}}">Messages</a></li>
                <li><a class="dropdown-item" href="/editUserForm/{{$user->id}}">Edit profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/logout">log out</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" action="/search" method="GET" >
            <input class="form-control me-2" placeholder="Search" aria-label="Search" name="query">
            <button class="btn btn-outline-light" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </navbar>
