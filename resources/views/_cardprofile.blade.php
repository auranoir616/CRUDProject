<?php 
$user = auth()->user();
$countPost = DB::table('post')->where('user_id',$user->id)->count('id');
$followingCount = DB::table('follower')->where('user_id',$user->id)->count('following_user');
$followingCount = $followingCount - 1 ;
$followerCount = DB::table('follower')->where('following_user',$user->id)->count('following_user');
$followerCount = $followerCount - 1;

?>
    <style>
  </style>
  <div class="cardProfile">
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
                      <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Create a Post
                      </button>
                      <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Edit bio
                      </button>
                      
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
<!-- Button trigger modal -->
  <!-- Button trigger modal -->

<!-- bio Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Bio</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/editBio/{{$user->id}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
    
        <div class="mb-3">
          {{-- <label for="exampleFormControlTextarea1" class="form-label">Bio</label> --}}
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="editBio" oninput="CountCharBio()" maxlength="150"></textarea>
        </div>
        <div class="container-info-char">
          <p id="jumlahBio">0/150</p>
        </div>
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button> 
      </div>
    </form>
    </div>
  </div>
</div>
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
      <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="body" oninput="CountChar()" maxlength="600" value=""></textarea>
    </div>
    <div class="container-info-char">
      <p id="jumlahPost">0/600</p>
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
  function CountChar(){
var char = document.getElementById("exampleFormControlTextarea2").value
var jmlhchar = char.length
console.log(jmlhchar)
document.getElementById("jumlahPost").innerHTML = jmlhchar + '/600'

}
function CountCharBio(){
var char = document.getElementById("exampleFormControlTextarea1").value
var jmlhchar = char.length
console.log(jmlhchar)
document.getElementById("jumlahBio").innerHTML = jmlhchar + '/150'


}

</script>