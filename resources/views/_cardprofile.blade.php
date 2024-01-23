<?php 
$user = auth()->user();
$countPost = DB::table('post')->where('user_id',$user->id)->count('id');
$followingCount = DB::table('follower')->where('user_id',$user->id)->count('following_user');
$followingCount = $followingCount - 1 ;
$followerCount = DB::table('follower')->where('following_user',$user->id)->count('following_user');
$followerCount = $followerCount - 1;

?>
<style>
  #card-info-profile{
    padding: 5px;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;

  }
</style>
<div id="card-info-profile">
  <div class="card mb-3 container-fluid">
    <div class="row g-0">
      <div class="col-md-4 img-cont">
        <img src="../data_file/{{$user->Images_profile}}" class="card-image"  alt="...">
      </div>
      <div class="col-md-8 card-body-cont">
        <div class="card-body">
          <h5 class="card-title">{{$user->name}} </h5>
          <p class="card-text">{{$user->bio}}</p>
          <p class="card-text"><small class="text-body-secondary"> <a class="btn btn-secondary" href="/post"><strong>Create a post</strong></a>
          </small></p>
        </div>
        <div class="card-footer bg-transparent border-success">
          <div class="footer-profile">
            <small >follower : {{$followerCount}} </small>
            <small>following : {{$followingCount}} </small>
            <small>Post : {{$countPost}} </small>
          </div>
        </div>
      </div>
        </div>
      </div>
    </div>
<hr>
