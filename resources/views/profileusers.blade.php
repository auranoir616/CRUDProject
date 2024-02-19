<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../style.css" rel="stylesheet">

    <title>fishbook|profile</title>
</head>
<?php 
$name = session('name');	
$email = session('email');
$images = session('images');
?>
<body>
    @include('_navbar')
    <main>
        <aside>
        </aside>
        <article>
            @include('_cardotherprofile')
            @include('_otheruserpost')

        </article>
    <section>

    </section>
    </main>
</body>
<script>
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

</script>
</html>