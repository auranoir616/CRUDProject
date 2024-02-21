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
  @include('_navbar')
  <hr>
  <main>
<hr>
      <aside>
      </aside>
    <article>
      <h5>suggestions</h5><br>
      <ul class="list-group list-group-flush">
        @foreach($allusers as $user)
        <li class="list-group-item">
          <div id="suggestions">

            <div>
              <img src="./data_file/{{$user->Images_profile}}" class="card-img-top" id="image-suggestions" alt="...">
              <a href="/profile/{{$user->id}}-{{$user->username}}" class="link-light link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                {{$user->username}}
              </a>
            </div>
            <div>
              <div class="btn-group" role="group" aria-label="Basic outlined example">
                <button type="submit" @if(auth()->user()->followedUser->contains($user->id)) class="btn btn-secondary btnFollow btn-sm" @endif class="btn btn-light btnFollow btn-sm" following_user_id="{{$user->id}}">
                  {{ auth()->user()->followedUser->contains($user->id) ? 'Unfollow' : 'Follow' }}
                </button>
                <a href="/messages/{{$user->id}}" class="btn btn-outline-secondary">message</a>
              </div>
            </div>
            
          </div>
          </li>
        @endforeach
        {{-- <a href="/listusers" class="link-light" align="center">view more</a> --}}
      </ul>
      @include('_footer')
    </article>
<section>
</section>
</main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>

  let btnfollow = document.querySelectorAll('.btnFollow')
  btnfollow.forEach(function(btn){
    btn.addEventListener('click', function(){
        let user_id = this.getAttribute('following_user_id')
        console.log('user',user_id)
        fetch(`/follow/${user_id}`,{
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded',},
            body: 'following_user_id=' + user_id
        })
        .then(response => response.text())
        .then(data =>{
            console.log(data)
            if(btn.innerText === 'Unfollow'){
                btn.innerText = 'Follow'
                btn.classList = 'btn btn-light btnFollow btn-sm'
            }else{
                btn.innerText = 'Unfollow'
                btn.classList = 'btn btn-secondary btnFollow btn-sm'

            }
        })
        .catch(err =>{
            console.log(err)
        })
    })
  })
</script>

</body>
</html>