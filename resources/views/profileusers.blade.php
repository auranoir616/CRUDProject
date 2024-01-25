<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../style.css" rel="stylesheet">

    <title>fishbook|profile</title>
</head>
 <style>
  .cards{
      height: 200px;
      width: 100%;
      border-radius: 10px;
      border: 1px solid rgb(143, 142, 142);
      padding: 5px;
  }
  .card-inner{
      border-radius: 10px;
      height: 100%;
      width: 100%;
      display: flex;
      flex-direction: row;
      justify-content: flex-start;

  }
  .card-image{
      height: 100%;
      width: 20%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      border-radius: 5%;
      object-fit: fill;
      background: #ffffff;

  }
  .card-body{
      height: 100%;
      width: 100%;
      display: flex;
      flex-direction: column;
  }
  .card-content{
      width: 100%;
      height: 100%;

  }
  .card-footer{
      width: 100%;
      height: 25%;
  }
  .img-card{
      height: 100%;
      width: 100%;
      border-radius: 10%;
      object-fit:inherit;
  }
  .card-text-body{
     height: 100%;
  }
.footer-data{
width: 100%;
display: flex;
flex-direction: row;
flex-wrap: wrap;
justify-content: space-around;
}
.card-footer{
  margin-top: 5px;
  border-top: 2px solid grey
}
.bio{
height: 60px;
overflow: auto;
margin-bottom:5px; 
}
@media(max-width:750px){
  .card-image{
      height: 100%;
      width: 40%;
  }
}
</style>
<?php 
$name = session('name');	
$email = session('email');
$images = session('images');
?>

<body>
    @include('_navbar')

    @foreach($dataUser->take(1) as $user)
<div>
  <div class="card cards">
    <div class="card-inner">
        <div class="card-image">
            <img src="../data_file/{{$user->Images_profile}}" alt="" class="img-card">
        </div>
        <div class="card-body">
            <div class="card-content">
                <div class="card-text-body">
                    <h5 class="card-title">{{$user->name}} </h5>
                    <div class="bio">
                      <small class="card-text" >{{$user->bio}}</small>
                    </div>
                    <button type="submit" class="btn btn-outline-info btnFollow" following_user_id="{{$user->id}}">
                      {{ auth()->user()->followedUser->contains($user->id) ? 'Unfollow' : 'Follow' }}
                  </button>
                  <a href="/messages/{{$user->id}}" class="btn btn-outline-secondary">message</a>
                </div>
            </div>
            <?php 
            $countPost = DB::table('post')->where('user_id',$user->id)->count('id');
            $followingCount = DB::table('follower')->where('user_id',$user->id)->count('following_user');
            $followingCount = $followingCount - 1 ;
            $followerCount = DB::table('follower')->where('following_user',$user->id)->count('following_user');
            $followerCount = $followerCount - 1;
            ?>
            <div class="card-footer">
                <div class="footer-data">
                    <small><b>follower : {{$followerCount}} </b></small>
                    <small><b>following : {{$followingCount}} </b></small>
                    <small><b>Post : {{$countPost}} </b></small>
                  </div>
            </div>
        </div>
    </div>
  </div>
  
</div>
@endforeach

<hr>
@if ($dataPost[0]->id == null)
    <h1 align="center">data profile kosong</h1>
@else
<div class="container">
  @foreach ($dataPost as $data)
  <div class="card w-100 p-3" >
   <div class="container-image-post-profile">
    <img src="../data_file/{{$data->images}}" width="100%" height="100%" alt="{{$data->images}}">
   </div>
       <div class="rowContainer">
          <button type="submit" class="btn btn-primary position-relative" postId="{{$data->id}}" id="likebtn">
            {{ auth()->user()->Liked->contains($data->id) ? 'unlike' : 'like' }}
          </button>  
          <span class="top-0 start-100 translate-middle badge rounded-pill bg-danger" id="likecount" postId="{{$data->id}}">
            {{ $likesCount[$data->id] ?? 0 }}
          </span>
            </div>
  
    <div class="card-body">
      <h5 class="card-title">{{$data->title}}</h5>
      <div class="mypostover">
        <p class="card-text">{{$data->body}}</p>
      </div>
      <div class="readMore">
        <a  href="/{{$data->id}}-{{$data->title}}">Read More...</a>
      </div>

    </div>
    <div>
      <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{$data->id}}" aria-expanded="false" aria-controls="collapseExample">
        View Comments
      </button>
    </p>
    <div class="collapse" id="collapseExample{{$data->id}}">
      <div class="card card-body">
        <div class="comment" postId="{{$data->id}}">

        @foreach($comments as $comment)
          @if($comment->id_post == $data->id)
          <p class="commentText"><strong>{{ $comment->name }}:</strong> {{ $comment->body }}</p>
          @endif
          @endforeach
        </div>
        <div class="input-group mb-3">
          <input type="text" name="bodytes" class="form-control inputkomen" placeholder="Your comment" aria-label="Your comment" aria-describedby="button-addon2" id="" postId="{{$data->id}}" >
          <button class="btn btn-outline-secondary buttonkomen" type="submit" id="" postId="{{$data->id}}" username="{{$name}}">Comment</button>
          </div>
        
      </div>
    </div>
  </div>
  </div>
  <hr>
    @endforeach
</div>    
@endif
    
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
  //script untuk handle like tanpa reload
  let likebtn = document.querySelectorAll('#likebtn')
  likebtn.forEach(function(button){
  button.addEventListener('click', function(){
      let postId = this.getAttribute('postId')
      console.log('id', postId)
      fetch(`/likes/${postId}`,{
        method:"post",
        headers: {'Content-Type': 'application/x-www-form-urlencoded',},
        body: 'postId=' + postId //postId sebagai name dalam elemen input
      })
      .then(response => response.text())
      .then(data =>{
        if (button.innerText === 'like') {
                button.innerText = 'unlike';
            } else {
                button.innerText = 'like';
            }
      })
      .catch((err)=>{
        console.log(err)
      })
    })
  })
  // menampilkan komentar tanpa reload halaman
  document.addEventListener('DOMContentLoaded', function () {
        var buttons = document.getElementsByClassName('buttonkomen');
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener('click', function () {
                var postId = this.getAttribute('postId');
                var username = this.getAttribute('username');
                var inputElement = document.querySelector('.inputkomen[postId="' + postId + '"]');
                var commentcont = document.querySelector('.comment[postId="' + postId + '"]');
            // Menggunakan createElement untuk membuat elemen div baru dan menambahkan commentText ke dalamnya
              var commentelem = document.createElement('div');
              commentelem.style.height = '19.5px';
              commentelem.innerHTML += '<p class="commentText">'+'<strong>' + username + ':</strong> ' + inputElement.value + '</p>';
           // Menambahkan elemen div baru ke dalam commentcont
              commentcont.appendChild(commentelem);
              fetch('/comment',{
                method:"POST",
                headers: {'Content-Type': 'application/x-www-form-urlencoded',},
                body: 'postId=' + postId +
                       '&body=' + inputElement.value
              })
              .then(response => response.text())
              .then(data =>{
                console.log(data)
              })
              .catch(err =>{
                console.log(err)
              })
              inputElement.value = ''; // Membersihkan input field
          });
        }
    });



</script>

</body>
</html>