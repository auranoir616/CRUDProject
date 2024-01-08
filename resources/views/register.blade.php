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
  <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded w-25 p-3 position-absolute top-50 start-50 translate-middle" >
    <form action="/register" method="POST" enctype="multipart/form-data">
      @csrf
      <h2 class="title">register</h2>

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

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <a href="/">login</a>

</div>


</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</html>