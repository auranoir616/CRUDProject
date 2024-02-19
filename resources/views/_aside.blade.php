
        <ul class="list-group list-group-flush">
            @foreach($sugestedUsers as $user)
            <li class="list-group-item">
              <div id="suggestions">

                <div>
                  <img src="./data_file/{{$user->Images_profile}}" class="card-img-top" id="image-suggestions" alt="...">
                  <a href="/profile/{{$user->id}}-{{$user->username}}" class="link-light link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                    {{$user->name}}
                  </a>
                </div>
                
                <div>
                  <button type="submit" @if(auth()->user()->followedUser->contains($user->id)) class="btn btn-secondary btnFollow btn-sm" @endif class="btn btn-light btnFollow btn-sm" following_user_id="{{$user->id}}">
                    {{ auth()->user()->followedUser->contains($user->id) ? 'Unfollow' : 'Follow' }}
                  </button>
                </div>
                
              </div>
              </li>
            @endforeach
            <a href="/listusers" class="link-light" align="center">view more</a>
          </ul>
          {{-- <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow. --}}
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