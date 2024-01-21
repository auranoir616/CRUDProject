<?php 
$user = auth()->user()
?>
<header id="row1">
<div class="container-data-header">
  <div class="img-fluid">
    <img src="../data_file/{{$user->Images_profile}}" alt="" class="profilePic">
  </div>
  <div class="container-data-header2">
    <h2>{{$user->name}} </h2>
  <a class="btn btn-secondary" href="/post"><strong>Create a post</strong></a>
  </div>
  
</div>
</header>
<hr>