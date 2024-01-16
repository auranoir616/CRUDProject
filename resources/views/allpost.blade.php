<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    

    <title>fishbook|home</title>
</head>
<body>
<div id="loadingOverlay">
  <div class="text-center" >
    <div class="spinner-border" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
  
</div>
  <div id="content">
    @include('_navbar')
@include('_header')

    <div class="containerHome">
    <article class="w-100 p-3 items-home">
    <div class="container">
      <div>
    @foreach ($postdata as $data)
<div class="row g-0 position-relative postCont">
  <div class="col-md-6 mb-md-0 p-md-4">
    <img src="./data_file/{{$data->images}}" class="w-100 images" alt="{{$data->images}}">
  </div>
  <div class="col-md-6 p-4 ps-md-0">
    <h5 class="mt-0">{{$data->title}}</h5>
    <div class="over">
      <p class="card-text">{{$data->body}}</p>
    </div>
    <p class="card-text"><small class="text-body-secondary">Last updated {{$data->created_at}}</small></p>
    <p class="card-text">by: {{$data->name}}</p>
    <a href="/{{$data->id}}-{{$data->title}}" >Read More...</a>
   <div class="commentContainer">
    <ul class="nav nav-tabs" >

      <li class="nav-item" style="margin-right: 10px">
        <p class="nav-link active" aria-current="page" >Comments</p>
      </li>

      <div class="rowContainer">
        <?php
        $post = $data->id
        // $like = likes::find($post);
        ?>
        <form action="/likes/{{$post}}" method="POST">
          @csrf
          <input type="text" value="{{$data->id}}" name="postId" hidden>
          <button type="submit" class="btn btn-outline-dark position-relative">
            {{ auth()->user()->Liked->contains($post) ? 'Unlike' : 'Like' }}
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              {{ $likesCount[$data->id] ?? 0 }}
              <span class="visually-hidden">Likes</span>
            </span>
          </button>
        </form> 
      </div>
     
    </ul>
    <div class="comment">
    @foreach ($comments as $comment)

    @if ($comment->id_post == $data->id)
    <p class="commentText"><strong>{{ $comment->name }}:</strong> {{ $comment->body }}</p>
@endif
  
   @endforeach
  </div>
  {{--! form comments --}}
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
    {{--! form comments --}}

  </div>
</div>
</div>
<hr>

@endforeach
    </div>
  </div>
</article>
</div>
@include('_footer')
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
    document.getElementById('loadingOverlay').style.display= 'block'
    document.getElementById('content').style.display= 'none'

    // setTimeout(() => {
    // document.getElementById('loadingOverlay').style.display= 'none'
    // document.getElementById('content').style.display= 'block'

    // }, 1000);

    document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('loadingOverlay').style.display= 'none'
    document.getElementById('content').style.display= 'block'
  })
</script>
</html>