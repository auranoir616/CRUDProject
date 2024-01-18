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
  <div id="loadingOverlay">
    <div class="text-center" >
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    
  </div>
  
  <?php 
  $name = session('name');	
  $email = session('email');
  $images = session('images');
  
  ?>
<div id="content">


    <div>
      @include('_navbar')

    </div>
    @include('_header')
<div onclick=disappear() id="notif">
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

</div>
    <div class="container">
      @foreach ($postdata as $data)

      <div class="card w-100 p-3 " >
       <div class="container-image-post-profile">
        <img src="./data_file/{{$data['images']}}" width="100%" height="100%" alt="{{$data['images']}}">
       </div>
           <div class="rowContainer">
              <button type="submit" class="btn btn-primary position-relative" postId="{{$data->id}}" id="likebtn">
                {{ auth()->user()->Liked->contains($data) ? 'unlike' : 'like' }}
              </button>  
              <span class="top-0 start-100 translate-middle badge rounded-pill bg-danger" id="likecount" postId="{{$data->id}}">
                {{ $likesCount[$data->id] ?? 0 }}
              </span>
                  <div class="dropdown" style="margin-left: -10px">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Options
                    </button>
                    <ul class="dropdown-menu">
                  {{--! form edit & delete --}}
                    <form action="/deletepost/{{$data->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                        <li><a class="dropdown-item" href="/editform/{{$data->id}}">Edit</a></li>
                        <li><a class="dropdown-item" href="/deletepost/{{$data->id}}" onclick="event.preventDefault(); this.closest('form').submit();">Delete</a></li>
                        <li><a class="dropdown-item" href="#">Something else </a></li>
                      </form>
                  {{--! /form edit & delete --}}
                    </ul>
                  </div>
                </div>
      
        <div class="card-body">
          <h5 class="card-title">{{$data['title']}}</h5>
          <div class="mypostover">
            <p class="card-text">{{$data['body']}}</p>
          </div>
          <div class="readMore">
            <a  href="/{{$data->id}}-{{$data->title}}" >Read More...</a>
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
            
                              {{--! form comments --}}
                {{-- <div style="margin-top: 10px; margin-bottom:-25px" style="display: none">
                  <form action="/comment" method="POST">
                    @csrf
                    <input type="hidden" name="postId" value="{{ $data->id }}">
                    <div class="input-group mb-3">
                        <input type="text" name="body" class="form-control" placeholder="Your comment" aria-label="Your comment" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Comment</button>
                    </div>
                  </form>
                </div> --}}
                  {{--! form comments --}}
           
          </div>
        </div>
      </div>
      </div>
        @endforeach

    
    </div>
    @include('_footer')

  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
   const notif = document.getElementById('notif')
  notif.style.display = 'block'
  const time = 1000
  setTimeout(() => {
    notif.style.display = 'none'
  }, time);
    document.getElementById('loadingOverlay').style.display= 'block'
    document.getElementById('content').style.display= 'none'

    setTimeout(() => {
    document.getElementById('loadingOverlay').style.display= 'none'
    document.getElementById('content').style.display= 'block'

    }, 1000);

  //   document.addEventListener('DOMContentLoaded', function(){
  //   document.getElementById('loadingOverlay').style.display= 'none'
  //   document.getElementById('content').style.display= 'block'
  // })
  //script untuk handle like tanpa reload
document.addEventListener('DOMContentLoaded', function(){
  let likebtn = document.querySelectorAll('#likebtn')
    likebtn.forEach(function(button){
      let postId = button.getAttribute('postId')
      let likeStatus = localStorage.getItem(`likeStatus_${postId}`)
      if(likeStatus === 'liked'){
        likebtn.innerText = 'unlike'
      }else{
        likebtn.innerText = 'like'
      }
    button.addEventListener('click', function(){
      let postId = this.getAttribute('postId')
      let likests = this.innerText
      fetch(`/likes/${postId}`,{
        method:"post",
        headers: {'Content-Type': 'application/x-www-form-urlencoded',},
        body: 'postId=' + postId //postId sebagai name dalam elemen input
      })
      .then(response => response.text())
      .then(data =>{
        if (likests === 'like') {
                button.innerText = 'unlike';
                localStorage.setItem(`likeStatus_${postId}`, 'liked');
            } else {
                button.innerText = 'like';
                localStorage.setItem(`likeStatus_${postId}`, 'unliked');
            }
      })
      .catch((err)=>{
        console.log(err)
      })
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
</html>
