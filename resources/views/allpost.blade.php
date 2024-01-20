<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    

    <title>fishbook|home</title>
</head>
<body>
<div id="loadingOverlay">
  <div class="text-center" >
    <div class="spinner-border" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
  
</div>
  <div id="content">
    @include('_navbar')
@include('_header')

    <div class="containerHome">
    <article class="w-100 p-3 items-home">
    <div class="container">
      <div>
        @if($postdata->isEmpty())
        <div class="container">
          <h1>Belum ada postingan</h1>
        </div>
        @else
      
    @foreach ($postdata as $data)
<div class="row g-0 position-relative postCont">
  <div class="col-md-6 mb-md-0 p-md-4">
    <img src="./data_file/{{$data->images}}" class="w-100 images" alt="{{$data->images}}">
  </div>
  <div class="col-md-6 p-4 ps-md-0">
    <h5 class="mt-0">{{$data->title}}</h5>
    <div class="over">
      <p class="card-text">{{$data->body}}</p>
    </div>
    <p class="card-text"><small class="text-body-secondary">Last updated {{$data->created_at}}</small></p>
    <p class="card-text">by: {{$data->name}}</p>
    <a href="/{{$data->id}}-{{$data->title}}" >Read More...</a>
   <div class="commentContainer">
    <ul class="nav nav-tabs" >

      <li class="nav-item" style="margin-right: 10px">
        <p class="nav-link active" aria-current="page" >Comments</p>
      </li>
      <div class="rowContainer">
        <?php
        $post = $data->id
        ?>
          <button type="submit" class="btn btn-primary position-relative" postId="{{$data->id}}" id="likebtn">
            {{ auth()->user()->Liked->contains($post) ? 'unlike' : 'like' }}
          </button>  
          <span class="top-0 start-100 translate-middle badge rounded-pill bg-danger" id="likecount" postId="{{$data->id}}">
            {{ $likesCount[$data->id] ?? 0 }}
          </span>
        </div>
    </ul>
                                                                          {{--*--}}

    <div class="comment" postId="{{$data->id}}">
    @foreach ($comments as $comment)
    @if ($comment->id_post == $data->id)
    <div>
      <p class="commentText"><strong>{{ $comment->name }}:</strong>  {{ $comment->body }}</p>
    </div>
      @endif
      @endforeach

  </div>
  <div class="input-group mb-3">
  <input type="text" name="bodytes" class="form-control inputkomen" placeholder="Your comment" aria-label="Your comment" aria-describedby="button-addon2" id="" postId="{{$data->id}}" >
  <button class="btn btn-outline-secondary buttonkomen" type="submit" id="" postId="{{$data->id}}" username="{{$data->name}}">Comment</button>
  </div>
  </div>
</div>
</div>
<hr>

@endforeach
@endif
    </div>
  </div>
</article>
</div>
@include('_footer')
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script >
document.getElementById('loadingOverlay').style.display= 'block'
document.getElementById('content').style.display= 'none'
setTimeout(() => {
    document.getElementById('loadingOverlay').style.display= 'none'
    document.getElementById('content').style.display= 'block'

    }, 1000);
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