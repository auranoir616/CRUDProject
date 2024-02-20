<?php 
$name = session('name');	
$email = session('email');
$images = session('images');
$likes = DB::table('likes')->get();  
$user = auth()->user()
?>
<header>

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
            <li class="nav-item position-relative" >
              <a class="nav-link " href="/messages/{{$user->id}}">Messages
                {{-- @if(isset($inboxCount) && $inboxCount > 0) --}}
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="inboxBadge">
                  {{-- {{$inboxCount}} --}}
                </span>
                {{-- @endif --}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/game">Play a Game</a>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{$name}}
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/editUserForm/{{$user->id}}">Edit profile</a></li>
                <li><a class="dropdown-item" href="/listusers">List Users</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/logout">log out</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" action="/search" method="GET" >
            <input class="form-control me-2" placeholder="Search" aria-label="Search" name="query" id="inputsearch">
            <button class="btn btn-outline-light" type="submit" id="buttonSearch" disabled>Search</button>
          </form>
        </div>
      </div>
    </nav>
  </navbar>
  </header>
  <script>
    let input = document.getElementById('inputsearch')
    let button = document.getElementById('buttonSearch')
    input.addEventListener('change', () =>{
      if(input.value){
        button.disabled = false
      }
    })
    let badge = document.getElementById('inboxBadge')
    fetch('/getInbox')
    .then(res => res.json())
    .then(data => {
     badge.textContent = data.inboxCount
    })

    </script>
