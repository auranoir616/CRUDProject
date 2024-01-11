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
       
        <img src="./data_file/{{$data['images']}}" width="auto" height="500px" alt="{{$data['images']}}">
        <div class="card-body">
          <h5 class="card-title">{{$data['title']}}</h5>
          <div class="mypostover">
            <p class="card-text">{{$data['body']}}</p>

          </div>
          <div style="display:flex; flex-direction:row; justify-content:start" > 
          <div > 
            <a class="btn btn-info" href="/editform/{{$data->id}}">Edit</a>

          </div>
          <div >
            <form action="/deletepost/{{$data->id}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button> 
              </form>
          </div>
         
        </div>
           
        </div>
      </div>
        @endforeach
    
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
</script>
</html>
