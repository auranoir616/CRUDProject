<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

    <title>fishbook|register</title>
</head>
<body>
  <div>
    
    <div class="content" >

      <div class="fluid-form">
      <form action="/register" method="POST" enctype="multipart/form-data">
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
        <div class="mb-3 ">
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
  
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <a href="/loginpage">login</a>
    <a href="/">Back</a>  

  
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
</script>

</html>