<div class="cardProfile">
    @foreach($userData as $user)
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
                    </div>
                </div>
                
                <div class="card-footer">
                    <div class="footer-data">
                        <small><b>follower : {{$followerCount}} </b></small>
                        <small><b>following : {{$followingCount}} </b></small>
                        <small><b>Post : {{$postCount}} </b></small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <hr>
<!-- Button trigger modal -->
  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Create a Post</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @auth

  {{-- <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded fluid-form" > --}}
    {{--! tambahkan  enctype="multipart/form-data" jika ada upload file--}}
    {{-- <h1 style="text-align: center"></h1>
    <hr> --}}
      <form action="/createpost" method="POST" enctype="multipart/form-data"> 
          @csrf
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Images</label>
      <input type="file" class="form-control" id="exampleFormControlInput1" name="images">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Body Post</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body" oninput="CountChar()" maxlength="600"></textarea>
    </div>
    <div class="container-info-char">
      <p class="jumlah">0/600</p>
    </div>
    <div class="d-grid gap-2 col-6 mx-auto">
    <button type="submit" class="btn btn-light ">Post</button>
    </div>
      </form>
  {{-- </div> --}}
  @else
    <h1>tidak login</h1>
    @endauth

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
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