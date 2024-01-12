<?php 
$user = auth()->user()
?>

<header id="row1">
    <div class="img-fluid">
      <img src="../data_file/{{$user->Images_profile}}" alt="" class="profilePic">
    </div>
 
<div class="container-data-header">
  <h1>{{$user->name}} </h1>
  <h5> {{$user->email}}</h5>
  <a class="btn btn-info" href="/post">Create a post</a>
</div>
</header>
<hr>