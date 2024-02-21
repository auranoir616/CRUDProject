<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

    <title>Register</title>
</head>
<body id="loginPage">
  <?php 
  $name = session('name');
  ?>
        <div class="contentLogin">
          <div id="logo"> 
            
          </div>
          <div id="form"> 
          <div id="container-alert" class="z-3">
            <div id="alertwarning">
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
              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          
        </div>
        
      </div>        
      <div id="container-form">
        
            <form action="/register" method="POST" enctype="multipart/form-data" id="dataform">
              @csrf
              <h2 class="title" align="center">Register</h2>
              <hr>
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
              <button type="submit" class="btn btn-secondary">Register</button>
            </div>
          </form>
                <div>
            <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover link-light" href="/loginpage">
              Login
            </a>
            
          </div>
        </div>
        
        </div>
        </div>
   
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>

setTimeout(() => {
    document.getElementById('alertwarning').style.display= 'none'
    document.getElementById('content').style.display= 'block'

    }, 3000);
</script>

</html>