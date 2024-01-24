<?php 
$user = auth()->user();
$countPost = DB::table('post')->where('user_id',$user->id)->count('id');
$followingCount = DB::table('follower')->where('user_id',$user->id)->count('following_user');
$followingCount = $followingCount - 1 ;
$followerCount = DB::table('follower')->where('following_user',$user->id)->count('following_user');
$followerCount = $followerCount - 1;

?>
{{-- <style>
.card-body-head{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 5px
}
.card-body-cont-head{
    margin-top: 25px
}

</style>
<header>
  <div class="card mb-3 container-fluid">
    <div class="row g-0">
      <div class="col-md-4 img-cont">
        <img src="../data_file/{{$user->Images_profile}}" class="card-image-head"  alt="...">
      </div>
      <div class="col-md-8 card-body-cont-head">
        <div class="card-body-head">
          <h5 class="card-title">{{$user->name}} </h5>
          <p class="card-text">{{$user->bio}}</p>
          <p class="card-text"><small class="text-body-secondary"> <a class="btn btn-secondary" href="/post"><strong>Create a post</strong></a>
          </small></p>
        </div>
        <div class="card-footer bg-transparent border-success">
          <div class="footer-profile">
            <strong >follower : {{$followerCount}} </strong>
            <strong>following : {{$followingCount}} </strong>
            <strong>Post : {{$countPost}} </strong>
          </div>
        </div>
      </div>
        </div>
      </div>
</header>
<hr>
 --}}
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
      width: 10%;
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
                  <a class="btn btn-secondary btn-sm" href="/post"><strong>Create a post</strong></a>
              </div>
          </div>
       
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

<hr>
