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
<main id="container-all-msg">
  {{-- message --}}
  
<aside id="container-user-msg">
<br>
<ul class="nav nav-underline justify-content-center nav nav-pills nav-fill">
  <li class="nav-item">
    <a class="nav-link link-light" href="#" onclick="currentChat(); event.preventDefault();">Chat</a>
  </li>
  <li class="nav-item">
    <a class="nav-link link-light position-relative" href="#"  onclick="unreplyInbox(); event.preventDefault();">
      Inbox
      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        {{$inboxCount}}
      </span>
    </a>
    
  </li>
</ul>
      <div class="list-group list-group-flush" id="chat">
      @foreach($userdatasorted as $user)
      <a href="/messages/{{$user->id}}" class="list-group-item list-group-item-action stretched-link">
        <img src="../data_file/{{$user->Images_profile}}" alt="" id="image-suggestions">
        <span id="user-name-msg">
          {{$user->name}}
        </span>
        @php
        $unreadCount = $inboxMessages->where('user_id', $user->id)->where('read_status', 0)->count();
        @endphp
        @if(!$unreadCount)
        @else
        <span class="badge bg-danger rounded-pill" msgId="{{$user->id}}" id="inbox{{$user->id}}">
          {{$unreadCount}}
        </span>
        @endif
      </a>
      @endforeach 
  </div>

  <div class="list-group list-group-flush" id="inbox" hidden>

    @foreach($userdatasortedInbox as $user)
    @if($user->id == auth()->id())
    <h3 align="center">No Unreply Messages</h3>
    @else
    <a href="/messages/{{$user->id}}" class="list-group-item list-group-item-action stretched-link">
      <img src="../data_file/{{$user->Images_profile}}" alt="" id="image-suggestions">
      {{$user->name}}
      @php
      $unreadCount = $inboxMessages->where('user_id', $user->id)->where('read_status', 0)->count();
      @endphp
      @if(!$unreadCount)
      @else
      <span class="badge bg-danger rounded-pill" msgId="{{$user->id}}" id="inbox{{$user->id}}">
        {{$unreadCount}}
      </span>
      @endif
    </a>
    @endif
    @endforeach 
</div>
</aside>

  <article id="container-chat-msg">
    <div class="container-chat-form">
      @if($sender == $receiver)
      <div id="noChat-msg">
        <h3>No Chat Selected</h3>
      </div>
      @endif
      <div class="container-chat-content">
                  @foreach($messagesSender as $msg)
                  @if($sender == $msg->user_id)
                  <div class="w-50 p-3 sender-msg" >
                            <div class="d-inline-flex mb-3 px-3 py-2 fw-semibold text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-2 container-msg" >
                              <p align="right">
                                {{$msg->content}} 
                              </p>
                              <small style="font-size: 10px">
                                {{$msg->formatted_updated_at}}
                              </small>
                            </div>
                             
                            </div>
                      @else
                      <div class="w-50 p-3 receiver-msg">
                        <div class="d-inline-flex mb-3 px-3 py-2 fw-semibold text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-2 container-msg" >
                          <p msgId='{{$msg->id}}' id="pesanElement{{$msg->id}}">
                            {{$msg->content}} 
                          </p>
                          <small style="font-size: 10px">
                            {{$msg->formatted_updated_at}}
                          </small>
                        </div>
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
            <div id="container-info-msg-user">
              <img src="../data_file/{{$datauser->Images_profile}}" alt="" class="image-user-msg">
              <a href="/profile/{{$datauser->id}}-{{$datauser->username}}" class="link-light">
                <h4>
                  {{$datauser->name}}
                </h4>
              </a> 
            </div>

          </section>
        </main>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>

let chat = document.getElementById('chat')
let inbox = document.getElementById('inbox')
function currentChat(){
  inbox.hidden = true
  chat.hidden = false
}
function unreplyInbox(){
  chat.hidden = true
  inbox.hidden = false
}


      document.addEventListener('DOMContentLoaded',function(){
        let sendbtn = document.getElementById('button-addon2')
        let msgcontainer = document.getElementsByClassName('container-chat-content')[0]
          sendbtn.addEventListener('click',function(){
            let recieverId = this.getAttribute('reciever')
            let msgtext = document.getElementById('inputmsg')
            let msg = document.createElement('div')
            if(msgtext.value){
            msg.className = 'w-50 p-3 sender-msg'
            msg.style.display = 'flex';
            msg.style.alignSelf = 'flex-end';
            msg.innerHTML = '<div class="d-inline-flex mb-3 px-3 py-2 fw-semibold text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-2 container-msg">'
                               + '<p align="right">' + msgtext.value + '</p>' + '<small style="font-size: 10px">'+ 'just now' + '</small>' + '</div>'
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
            msgtext.focus();
          }
          })

      })
      function readInbox(messages){
            fetch(`/readInbox/${messages}`)
            .then(response => response.json())
            .then(data => {
              console.log(data)
            })
            .catch( err => {
              console.log(err)
            }
            )
          }
  var elemenmsgList = document.querySelectorAll('p[msgId]');
    elemenmsgList.forEach(function(elemenmsg) {
    var msgId = elemenmsg.getAttribute('msgId');
    var targetElement = document.querySelector(`#pesanElement${msgId}`);
//function untuk mendeteksi pesan dilihat atau tidak
var observer = new IntersectionObserver(function(entries, observer) {
    entries.forEach(function(entry) {
        // entry.isIntersecting akan true jika elemen terlihat dalam viewport
        if (entry.isIntersecting) {
            // Lakukan tindakan yang diinginkan, misalnya, tandai pesan sebagai sudah dibaca
            markMessageAsRead(msgId);
            // Unobserve elemen setelah terlihat agar tidak mendeteksinya lagi
            observer.unobserve(entry.target);

        }
    });
}, { threshold: 1 }); // threshold: 1 artinya akan memicu saat seluruh elemen terlihat
// Memulai pengawasan pada elemen target
observer.observe(targetElement);
if(observer.observe(targetElement)){
            var elemenInbox = document.querySelectorAll('span[msgId]');
            elemenInbox.forEach(function(inbox) {
            var msgId = inbox.getAttribute('msgId');
            var inboxText = document.querySelector(`#inbox${msgId}`);
            inboxText.textContent = '0';
          })
        }
// Fungsi untuk menandai pesan sebagai sudah dibaca
function markMessageAsRead(msgId) {
    fetch(`/readInbox/${msgId}`)
    .then(res => res.json())
    .then(data =>{
    })
}
})



    </script>
    
</body>
</html>