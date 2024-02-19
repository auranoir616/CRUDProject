<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

    <title>login</title>
</head>
{{-- <body id="loginPage">
  <div onclick=disappear() id="notif">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
  
  @if(session('error'))
    <div class="alert alert-secondary">
        {{ session('error') }}
    </div>
  @endif
  </div> --}}
  <?php 
  $name = session('name');
  ?>
        <div class="contentLogin">
          <div id="logo"> 

          </div>
          <div id="form">         
          <div id="container-form">

            <form action="/login" method="POST">
              @csrf
           <div class="mb-3 ">
            <h2 class="title" align="center">Login</h2>
              <label for="exampleInputEmail1" class="form-label">Username</label>
              <input type="text" class="form-control" id="InputUsername" aria-describedby="emailHelp" name="inputUsername">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="InputPassword" name="inputPassword" >
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
              <button type="submit" class="btn btn-secondary" id="buttonlogin">Login</button>
            </div>
          </form>
          <div>
            <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover link-light" href="/registerPage">
              Register
            </a>
            
          </div>
        </div>
        
        </div>
        </div>
   
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>

    // let btn = document.getElementById('buttonlogin')
    // let userinput = document.getElementById('InputUsername')
    // let inputpassword = document.getElementById('InputPassword')
    // let alert = document.getElementById('alertwarning')
    // alert.style.display = 'none'
    // btn.addEventListener('click',function(){
    //   if(!userinput.value || !inputpassword.value){
    //     alert.style.display = 'block'
    //   } else {
    //     alert.style.display = 'none'
    //   }

    // })
</script>

</html>