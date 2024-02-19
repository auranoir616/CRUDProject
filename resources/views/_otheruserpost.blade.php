<?php
  $username = auth()->user()->name;
?>
      <div>
        @if($postdata->isEmpty())
        <div class="container">
          <h1>Belum ada postingan</h1>
        </div>
        @else

    @foreach ($postdata as $data)
    <div class="row g-0 position-relative" id="container-post">
      <div>
        {{-- <a href="/profile/{{$data->name}}" class="link-light link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"><b>{{$data->name}}</b></a> --}}
        <small>{{$data->formatted_updated_at}}</small>
        <br>
        <br>
      </div>
        <hr>
    <div class="text-body-post" id="containerPost{{$data->id}}" postId="{{$data->id}}">
      <p class="card-text">{{$data->body}}</p>
    </div>
    <a href="#" class="link-info" postId="{{$data->id}}" onclick="ReadPost('{{$data->id}}'); event.preventDefault();" align="right">Read More</a>
<hr>
    @if(!$data->images)
    @else
    <div id="container-images">
      
      <img src="../data_file/{{$data->images}}" width="80%" height="100%" alt="...">
    </div>
    @endif
    <br>
    <div id="likesCount">
      <div>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
          <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
        </svg>
        <span postId="{{$data->id}}" id="likesCount{{$data->id}}" class="likesCount">
        </span>
      </div>
  
    </div>
    <br>
    <br>
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown" id="button-container">
        <?php
        $post = $data->id
        ?>
          <button type="submit" class="btn btn-secondary" postId="{{$data->id}}" id="likebtn">
            @if(auth()->user()->Liked->contains($post))
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16">
              <path d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.38 1.38 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51q.205.03.443.051c.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.9 1.9 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2 2 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.2 3.2 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.8 4.8 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591"/>
            </svg>
            unlike
            @else
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
              <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
            </svg>
            like
            @endif
          </button>  
        <button id="commentbtn" class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{$data->id}}" aria-expanded="false" aria-controls="collapseExample"> 
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
          <path d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
        </svg>
        Comment
      </button>
    
        <button id="sharebtn"  type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16">
            <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5"/>
          </svg>
          Share
        </button>
        <ul class="dropdown-menu">
          @foreach($sharepage as $key => $value)
          <li><a class="dropdown-item" href="{{$value}}{{$data->id}}" target="blank">{{$key}}</a></li>
          @endforeach
</ul>
    </div>
    <div class="collapse" id="collapseExample{{$data->id}}" postId="{{$data->id}}">
      <div class="comment-container" postId="{{$data->id}}">
    @foreach ($comments as $comment)
    @if ($comment->id_post == $data->id)
       <small class="d-inline-flex mb-1 px-2 py-1 fw-semibold text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle rounded-2">
        <strong>{{ $comment->name }}&nbsp;:&nbsp; </strong>
         {{ $comment->body }}
      </small>
      @endif
      @endforeach

      </div>
      <div class="input-group mb-3">
        <input type="text" name="bodytes" class="form-control inputkomen" placeholder="Your comment" aria-label="Your comment" aria-describedby="button-addon2" id="" postId="{{$data->id}}" >
        <button class="btn btn-outline-secondary buttonkomen" type="submit" id="" postId="{{$data->id}}" username="{{$username}}">Comment</button>
        </div>
  </div>
</div>
<hr>
@endforeach
@endif
    </div>
    @include('_footer')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script >
// document.getElementById('loadingOverlay').style.display= 'block'
// document.getElementById('content').style.display= 'none'
// setTimeout(() => {
//     document.getElementById('loadingOverlay').style.display= 'none'
//     document.getElementById('content').style.display= 'block'

//     }, 1500);
//script untuk handle like tanpa reload
document.addEventListener('DOMContentLoaded', function(){
  let postContainer = document.querySelectorAll('.text-body-post')
  postContainer.forEach(function(post){
    let id = post.getAttribute('postId')
    let textContainer = document.getElementById(`containerPost${id}`)
    let containerHeight = parseInt(window.getComputedStyle(textContainer).height);
    if (containerHeight < 50) {
      document.querySelector(`.link-info[postId="${id}"]`).hidden = true;
    } 
  })})
function ReadPost(postId){
  let textContainer = document.getElementById(`containerPost${postId}`)
 if(event.target.textContent === 'Read More'){
    readMore(postId)
  }else{
    readLess(postId)
  }
}
function readMore(postId){
  let textContainer = document.getElementById(`containerPost${postId}`)
  textContainer.style.transition = 'height 0.5s'; // Menggunakan transisi selama 0.5 detik
  textContainer.style.maxHeight = '500px';
  event.target.textContent = 'Read Less'
}
function readLess(postId){
  let textContainer = document.getElementById(`containerPost${postId}`)
  textContainer.style.transition = 'height 0.5s'; // Menggunakan transisi selama 0.5 detik
  textContainer.style.maxHeight = '50px';
  event.target.textContent = 'Read More'

}

function likesCount(postId){
    fetch(`/likesCount/${postId}`)
    .then(response => response.json())
    .then(data => {
      let text = document.getElementById(`likesCount${postId}`)
      text.textContent = data.CountLikesPost
    })
    .catch(err=>{
      console.log(err)
    })
  }

document.addEventListener('DOMContentLoaded', function(){
  let spans = document.querySelectorAll('.likesCount');
  spans.forEach(function (span) {
    let postId = span.getAttribute('postId');
    likesCount(postId);
  });
    let likebtn = document.querySelectorAll('#likebtn')
    likebtn.forEach(function(button){
    button.addEventListener('click', function(){
      let postId = this.getAttribute('postId')
      let likests = this.innerHTML
      fetch(`/likes/${postId}`,{
        method:"post",
        headers: {'Content-Type': 'application/x-www-form-urlencoded',},
        body: 'postId=' + postId //postId sebagai name dalam elemen input
      })
      .then(response => response.json())
      .then(data =>{
        let unlikeIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16">
          <path d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.38 1.38 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51q.205.03.443.051c.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.9 1.9 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2 2 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.2 3.2 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.8 4.8 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591"/>
          </svg>`
          
          let likeIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
            <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
            </svg>`      
            
        if(data.existingLike === null){
          button.innerHTML = unlikeIcon + ' unlike';
        }else{
          button.innerHTML = likeIcon + ' like';
          }
          likesCount(postId)
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
                var commentcont = document.querySelector('.comment-container[postId="' + postId + '"]');
            // Menggunakan createElement untuk membuat elemen div baru dan menambahkan commentText ke dalamnya
            if(inputElement.value){
              var commentelem = document.createElement('small');
              commentelem.className = 'd-inline-flex mb-1 px-2 py-1 fw-semibold text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle rounded-2';
              commentelem.innerHTML += '<strong>' + username + ' :</strong> &nbsp;'+ inputElement.value;
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
            }
              inputElement.value = ''; // Membersihkan input field
          });
        }
    });
    //handle tombol follow
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
