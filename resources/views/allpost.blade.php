<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

    <title>tes</title>
</head>
<body>
  <?php 
  $name = session('name');	
  $email = session('email');
  $images = session('images');

  
  ?>

    <div>
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
                <a class="nav-link" href="/mypost">my post</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{$name}}
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="/post">Post items</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="/logout">log out</a></li>
                </ul>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      <div id="row1">
        <div>
          <img src="./data_file/{{$images}}" alt="" class="profilePic">
        </div>
     
    <div>
      <h1>{{$name}} </h1>
      <h5> {{$email}}</h5>
    </div>
      </div>
      <hr>
      
    </div>
    <h1>All Post</h1>    
    </div>
    <div class="container">
      <div class="w-75 p-3 ">
    @foreach ($alldata as $data)
   

<div class="row g-0 position-relative postCont">
  <div class="col-md-6 mb-md-0 p-md-4">
    <img src="./data_file/{{$data->images}}" class="w-100 images" alt="{{$data->images}}">
  </div>
  <div class="col-md-6 p-4 ps-md-0">
    <h5 class="mt-0">{{$data->title}}</h5>
    <div class="over">
      <p class="card-text">{{$data->body}}</p>
    </div>
    <p class="card-text"><small class="text-body-secondary">Last updated {{$data->updated_at}}</small></p>
    <p class="card-text">by: {{$data->name}}</p>
    <a href="/{{$data->id}}" >Read More...</a>
   <div class="commentContainer">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Comments</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Like</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Share</a>
      </li>
    </ul>
    <div class="comment">
    @foreach ($comments as $comment)

    @if ($comment->id_post == $data->id)
    <p class="commentText"><strong>{{ $comment->name }}:</strong> {{ $comment->body }}</p>
@endif
  
   @endforeach
  </div>
   <div>
    <form action="/comment" method="POST">
      @csrf
      <input type="hidden" name="id_post" value="{{ $data->id }}">
      <div class="input-group mb-3">
          <input type="text" name="body" class="form-control" placeholder="Your comment" aria-label="Your comment" aria-describedby="button-addon2">
          <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Comment</button>
      </div>
    </form>
    
   </div>
  
  </div>
</div>

</div>
<hr>

@endforeach
    </div>
  </div>
  <hr>
    <div>
      {{ $alldata->appends(['page' => $alldata->currentPage()])->links('pagination::bootstrap-4') }}    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</html>