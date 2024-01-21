<div class="accordion" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Suggested to follow
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <ul class="list-group list-group-flush">
   
          @foreach($sugestedUsers as $user)
          <li class="list-group-item"><img src="./data_file/{{$user->Images_profile}}" alt="" class="thumbnailImgProfile">
            <a href="/profile/{{$user->username}}">{{$user->name}}</a>
            <button type="submit" class="btn btn-outline-info btnFollow btn-sm" following_user_id="{{$user->id}}">
              {{ auth()->user()->followedUser->contains($user->id) ? 'Unfollow' : 'Follow' }}
          </button>
          </li>
          @endforeach
        </ul>
        <p align="center"><a href="/listusers">View more</a></p>

        </div>
      </div>
    </div>
  </div>
