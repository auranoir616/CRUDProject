<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

    <title>view post</title>
</head>
<body>
    <?php 
    $name = session('name');	
    ?>
  
  @include('_navbar')
<div class="container-viewpost">
  <div class="w-75 p-3">
    <div class="card mb-3">
        <img src="./data_file/{{$post->images}}" class="card-img-top" width="100%" height="580px">
        <div class="card-body">
          <h5 class="card-title">{{$post->title}}</h5>
          <p class="card-text">{{$post->body}}</p>
          <p class="card-text"><small class="text-body-secondary">Last updated {{$post->updated_at}}</small></p>
          <p class="card-text">{{$post->name}}</p>

        </div>
      </div>
  </div>
  <div class="rowContainer">
    <div>
      <button type="button" class="btn btn-warning"> <a href="/allpost">back</a></button>
    </div>
      <div class="dropdown-center">
        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Share This Post
        </button>
        <ul class="dropdown-menu">
          @foreach($sharepage as $key => $value)
          <li><a class="dropdown-item" href="{{$value}}" target="blank">{{$key}}</a></li>
          @endforeach
        </ul>
      </div>
  </div>
</div>

    
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>