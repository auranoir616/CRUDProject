<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>fishbook|profile</title>
</head>
<body>
  <div id="loadingOverlay">
    <div class="text-center" >
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    
  </div>
  
  <?php 
  $name = session('name');	
  $email = session('email');
  $images = session('images');
  
  ?>
<div id="content">


    <div>
      @include('_navbar')

    </div>
    @include('_header')
<div onclick=disappear() id="notif">
  @if(session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger">
      {{ session('error') }}
  </div>
@endif

</div>
    <div class="container card-profile">
      @foreach ($postdata as $data)

      <div class="card w-100 p-3" >
       <div class="container-image-post-profile">
        <img src="./data_file/{{$data['images']}}" width="100%" height="100%" alt="{{$data['images']}}">
       </div>
                
                 <div class="rowContainer">
                   {{--! form likes --}}
                  <form action="/likes/{{$data->id}}" method="POST">
                    @csrf
                    <input type="text" value="{{$data->id}}" name="postId" hidden>
                    <button type="submit" class="btn btn-outline-dark position-relative">
                      {{ auth()->user()->Liked->contains($data) ? 'Unlike' : 'Like' }}
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $likesCount[$data->id] ?? 0 }}
                        <span class="visually-hidden">Likes</span>
                      </span>
                    </button>
                  </form> 
                                  {{--! /form likes --}}

                  <div class="dropdown" style="margin-left: 10px">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Options
                    </button>
                    <ul class="dropdown-menu">
                  {{--! form edit & delete --}}
                    <form action="/deletepost/{{$data->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                        <li><a class="dropdown-item" href="/editform/{{$data->id}}">Edit</a></li>
                        <li><a class="dropdown-item" href="/deletepost/{{$data->id}}" onclick="event.preventDefault(); this.closest('form').submit();">Delete</a></li>
                        <li><a class="dropdown-item" href="#">Something else </a></li>
                      </form>
                  {{--! /form edit & delete --}}
        
                    </ul>
                  </div>
        
                </div>
      
        <div class="card-body">
          <h5 class="card-title">{{$data['title']}}</h5>
          <div class="mypostover">
            <p class="card-text">{{$data['body']}}</p>
          </div>
          <div class="readMore">
            <a  href="/{{$data->id}}-{{$data->title}}" >Read More...</a>
          </div>

        </div>
        <div>
          <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            View Comments
          </button>
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            @foreach($comments as $comment)
              @if($comment->id_post == $data->id)
              <p class="commentText"><strong>{{ $comment->name }}:</strong> {{ $comment->body }}</p>
              @endif
              @endforeach
                              {{--! form comments --}}
                <div style="margin-top: 10px; margin-bottom:-25px">
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
      </div>
        @endforeach

    
    </div>
  </div>
  @include('_footer')
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
   const notif = document.getElementById('notif')
  notif.style.display = 'block'
  const time = 1000
  setTimeout(() => {
    notif.style.display = 'none'
  }, time);
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
