<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

    <title>fishbook|profile</title>
</head>
<body>
    @include('_navbar')

<header id="row1">
    @foreach($dataUser->take(1) as $user)

<div>
  <h1>{{$user->name}} </h1>
</div>
@endforeach
</header>
<hr>
@if ($dataUser[0]->id == null)
    <h1>data profile kosong</h1>
@else
@foreach($dataUser as $data)
    <div class="card mb-3" >
        <div class="row g-0">
          <div class="col-md-4">
            <img src="../data_file/{{$data->images}}" style="width: 100%; height:100%" alt="{{$data->images}}">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">{{$data->title}}</h5>
              <div class="profile-overflow">
                <p class="card-text">{{$data->body}}</p>
              </div>
              <p class="card-text"><small class="text-body-secondary">Last updated {{$data->updated_at}}</small></p>
            </div>
          </div>
        </div>
      </div>

    @endforeach
    
@endif
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>