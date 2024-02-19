<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../style.css" rel="stylesheet">

    <title>fishbook|message</title>
    <style>
    </style>
</head>
<body>
    @include('_navbar')
    {{-- <hr>
    <div onclick=disappear() id="notif">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
      @endif
      
      @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
      @endif --}}
{{-- users --}}
<main id="container-all-mgs">

<aside id="container-user-msg">

  <div class="cont-btn-msg">  
    <div class="cont-user">
      @foreach($userdatasorted as $user)
      <div class="user-msg alert @if($user->id == $receiver) alert-dark @else alert-light @endif" role="alert">
        <img src="../data_file/{{$user->Images_profile}}" alt="" id="image-suggestions">
        <a href="/messages/{{$user->id}}" class="alert-link stretched-link">{{$user->name}}</a>
      </div>
      @endforeach
    </div>
  </div>

</aside>
  {{-- message --}}
  <article id="container-chat-msg">

    <div class="container-chat-form">
      <div class="container-chat-content">
                  @if($sender == $receiver) 
                    <h6 class="no-msg"> <a href="/listusers">klik existing users or here to start a conversation</a></h6>
                  @endif
                  @foreach($messagesSender as $msg)
                  @if($sender == $msg->user_id)
                  <div class="alert alert-info msg w-25 p-3 msg-user" role="alert">
                        <figure class="text-end">
                          <blockquote class="blockquote">
                            <p> {{$msg->content}}</p>
                          </blockquote>
                          <figcaption class="blockquote-footer">
                            send <cite title="Source Title">{{$msg->created_at}}</cite>
                          </figcaption>
                        </figure>
                      </div>
                      @else
                      <div class="alert alert-danger w-25 p-3 msg-receiver" role="alert">
                        <figure class="text-start">
                          <blockquote class="blockquote">
                            <p> {{$msg->content}}</p>
                          </blockquote>
                          <figcaption class="blockquote-footer">
                            send <cite title="Source Title">{{$msg->created_at}}</cite>
                          </figcaption>
                          </figure>
                        </div>
                        @endif
                        @endforeach
                      </div>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="messages"  aria-describedby="button-addon2" id="inputmsg" name="content" @if($sender == $receiver) hidden @endif>
                  <button class="btn btn-outline-primary" reciever="{{$receiver}}" type="submit" id="button-addon2" @if($sender == $receiver) hidden @endif >Send</button>
                </div>
              </div>
          </article>
          <section id="container-info-msg">

          </section>
        </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
      document.addEventListener('DOMContentLoaded',function(){
        let sendbtn = document.getElementById('button-addon2')
        let msgcontainer = document.getElementsByClassName('container-chat-content')[0]
          sendbtn.addEventListener('click',function(){
            let recieverId = this.getAttribute('reciever')
            let msgtext = document.getElementById('inputmsg')
            let msg = document.createElement('div')
            if(msgtext.value){
            msg.className = 'alert alert-info msg w-25 p-3 msg-user'
            msg.role = 'alert'
            msg.innerHTML = '<figure class="text-end">' + '<blockquote class="blockquote">' +'<p>'+msgtext.value+'</p>' + '</blockquote>' + '<figcaption class="blockquote-footer">' +
                              'send'+'<cite title="Source Title">'+'</cite>'+'</figcaption>'+'</figure>'
            msgcontainer.insertBefore(msg, msgcontainer.firstChild);
            fetch('/sendmsg',{
              method:"POST",
              headers: {'Content-Type': 'application/x-www-form-urlencoded',},
              body: 'content=' + msgtext.value +
                       '&reciever=' + recieverId
            })
            .then(response => response.text())
            .then(data =>{
              console.log(data);
            })
            .catch( err =>{
              console.log(err)
            })
            msgtext.value = ''
          }
          })
        
      })
    </script>
    
</body>
</html>