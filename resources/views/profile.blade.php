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
  {{-- <div id="loadingOverlay">
    <div class="text-center" >
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    
  </div>
   --}}
  <?php 
  $name = session('name');	
  $email = session('email');
  $images = session('images');
  
  ?>
    @include('_navbar')
  <main>


{{-- <div onclick=disappear() id="notif">
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
</div> --}}
  <aside >
    <div class="profile-info">
    </div>
    
  </aside>
  <article>
    <hr>
    @include('_cardprofile')
    @if($postdata->isEmpty())
    <h1 align="center">NO post</h1>
    @else
    @include('_userpost')
  </article>
  <section>

  </section>
  @endif
  
</main>
</body>
</html>
