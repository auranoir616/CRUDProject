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
    @include("_cardprofile");
              <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach($allusers as $user)
                <div class="col">
                  <div class="card">
                    <img src="./data_file/{{$user->Images_profile}}" class="card-img-top images" alt="...">
                    <div class="card-body">
                      <h5 class="card-title"> <a href="/profile/{{$user->username}}">{{$user->name}}</a></h5>
                      <p class="card-text">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                      </p>
                      <button type="submit" class="btn btn-outline-info btnFollow" following_user_id="{{$user->id}}">
                        {{ auth()->user()->followedUser->contains($user->id) ? 'Unfollow' : 'Follow' }}
                    </button>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">join at: {{$user->created_at}}</small>
                      </div>
                  </div>
                </div>
                @endforeach
              </div>
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
            }else{
                btn.innerText = 'Unfollow'
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