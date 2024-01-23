<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <!-- Tambahkan di bagian head HTML -->
<link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.min.css">
<script src="https://unpkg.com/cropperjs/dist/cropper.min.js"></script>
<style>
  #Image{
    height: 150px;
    width: 150px;
    border-radius: 50%;
    object-fit: cover;
    background: #dfdfdf;
  }
</style>

    <title>fishbook|register</title>
</head>
<body>
  <div>
    
    <div class="content" >
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
            <b>{{ session('error') }}</b>
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
  <div class="cont-register">
      <div class="fluid-form w-50 p-3">
      <form action="/register" method="POST" enctype="multipart/form-data" id="dataform">
        @csrf
        <h2 class="title">register</h2>
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
        <div class=" mb-3 ">
          <label for="exampleInputEmail1" class="form-label">Name</label>
          <input type="text" class="form-control" name="registerName">
        </div>
        <div class="mb-3 ">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="registerEmail">
        </div>
     <div class="mb-3 ">
        <label for="exampleInputEmail1" class="form-label">Username</label>
        <input type="text" class="form-control" name="registerUsername">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="registerPassword">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">images</label>
        <input type="file" class="form-control" id="exampleFormControlInput1" name="registerImagesProfile">
      </div>
      <div class="d-grid gap-2 col-6 mx-auto">
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
    </form>
    <p>have an account? <a href="/loginpage">login</a></p><br>
    <a href="/">Back</a>  
  </div>
  <div style="height: 250px; width:300px">
    <img id="Image" src="img.png" alt="Image to crop">
  </div>
  </div>
  
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
  const notif = document.getElementById('notif')
 notif.style.display = 'block'
 const time = 2000
 setTimeout(() => {
   notif.style.display = 'none'
 }, time);

 let image = document.getElementById('Image')
 let input = document.getElementById('exampleFormControlInput1')
 input.addEventListener('change', () => {
  image.src = URL.createObjectURL(input.files[0])
  console.log(image.src);
 })
</script>


</html>