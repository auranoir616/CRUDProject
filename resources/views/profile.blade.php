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
    <div class="post-container-profile">
      @foreach ($postdata as $data)

      <div class="card w-25 p-3" >
       <div class="container-image-post-profile">
        <img src="./data_file/{{$data['images']}}" width="100%" height="100%" alt="{{$data['images']}}">
       </div>
        <div class="card-body">
          <h5 class="card-title">{{$data['title']}}</h5>
          <div class="mypostover">
            <p class="card-text">{{$data['body']}}</p>

          </div>        
          <div >
            <form action="/deletepost/{{$data->id}}" method="POST">
              @csrf
              @method('DELETE')
              <div class="d-grid gap-2 col-6 mx-auto" style="margin: 20px">
              <button class="btn btn-secondary">
                <a href="/editform/{{$data->id}}" class="link-light">Edit</a>
              </button>
              <button type="submit" class="btn btn-dark">Delete</button>
              </div>
              </form>
          </div>
        </div>
      </div>
        @endforeach
    
    </div>
  </div>
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

    setTimeout(() => {
    document.getElementById('loadingOverlay').style.display= 'none'
    document.getElementById('content').style.display= 'block'

    }, 1000);

  //   document.addEventListener('DOMContentLoaded', function(){
  //   document.getElementById('loadingOverlay').style.display= 'none'
  //   document.getElementById('content').style.display= 'block'
  // })
</script>
</html>
