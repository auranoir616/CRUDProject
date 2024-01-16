<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

    <title>List User</title>
</head>
<body>
    @include("_navbar");
    @include("_header");
    <div class="container">
        <div class="list-group w-50 p-3">
            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                List All Users
            </a>
            @foreach($allusers as $user)
            <div>
            <a href="/profile/{{$user->username}}" class="list-group-item list-group-item-action"> <img src="./data_file/{{$user->Images_profile}}" alt="" class="thumbnailImgProfile">{{$user->name}}</a>
        </div>
            @endforeach
          </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
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

</body>
</html>