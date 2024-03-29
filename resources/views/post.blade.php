<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

    <title>post</title>
</head>
<body>
  <?php 
  $name = session('name');	
  ?>
  @include('_navbar')
<div class="content">
  <div  id="container-notif">
    <div onclick=disappsear() id="notif">
      {{-- menampilkan error dari session --}}
      @if(session('success'))
      <div class="alert alert-success">
        <b> {{ session('success') }}</b>
      </div>
    @endif
    
    @if(session('error'))
      <div class="alert alert-danger">
        <b > {{ session('error') }}</b>
      </div>
    @endif
      {{-- menampilkan error dari validasi  --}}
        @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
            @foreach ($errors->all() as $error)
            <li><b>{{ $error }}</b></li>
            @endforeach
      </ul>
    </div>
       @endif
</div>
</div>

  @auth

  <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded fluid-form" >
    {{--! tambahkan  enctype="multipart/form-data" jika ada upload file--}}
    <h1 style="text-align: center">Create a Post</h1>
    <hr>
      <form action="/createpost" method="POST" enctype="multipart/form-data"> 
          @csrf
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">images</label>
      <input type="file" class="form-control" id="exampleFormControlInput1" name="images">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">description</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body"></textarea>
    </div>
    <div class="d-grid gap-2 col-6 mx-auto">
    <button type="submit" class="btn btn-secondary ">Post</button>
    </div>
      </form>
  </div>
  @else
    <h1>tidak login</h1>
    @endauth
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