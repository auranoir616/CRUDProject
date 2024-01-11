<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

    <title>edit post</title>
</head>
<body>
    @auth
    <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded w-25 p-3 position-absolute top-50 start-50 translate-middle" >
      {{--! tambahkan  enctype="multipart/form-data" jika ada upload file--}}
      <h2 class="title">edit</h2>
          <form action="/editpost/{{$post->id}}" method="POST" enctype="multipart/form-data"> 
              @csrf
              @method('PUT')
              
      <div class="mb-3">
       
          <label for="exampleFormControlInput1" class="form-label">title</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="title" value="{{$post->title}}">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">images</label>
          <input type="file" class="form-control" id="exampleFormControlInput1" name="images"  value="{{$post->images}}">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">description</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body">{{$post->body}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">save Changes</button>
        <a href="/myprofile" class="btn btn-info">cancel</a>

          </form>
      </div>
      @else
    <h1>tidak login</h1>
    @endauth




</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</html>