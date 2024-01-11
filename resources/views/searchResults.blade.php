
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

    <title>search page</title>
</head>
<body>
    @include('_navbar')
    <div>
        <h2>Hasil pencarian</h2>
        @if ($results->isEmpty())
            <h2>tidak ada hasil</h2>
        @else
        
            @foreach($results as $result)
            <div class="row g-0 position-relative postCont ">
                <div class="col-md-6 mb-md-0 p-md-4">
                  <img src="./data_file/{{$result->images}}" class="w-100 images" alt="{{$result->images}}">
                </div>
                <div class="col-md-6 p-4 ps-md-0">
                  <h5 class="mt-0">{{$result->title}}</h5>
                  <div class="over">
                    <p class="card-text">{{$result->body}}</p>
                  </div>
                  <p class="card-text"><small class="text-body-secondary">Last updated {{$result->updated_at}}</small></p>
                  <?php
                  $userstbl = DB::table('users')->where('id',$result->user_id)->first();
                  ?>
                  <p class="card-text">by: {{$userstbl->name}}</p>
                  <a href="/{{$result->id}}-{{$result->title}}" >Read More...</a>
          
              </div>
              </div>
            @endforeach
        
            @endif
        </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>


