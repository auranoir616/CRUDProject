<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../style.css" rel="stylesheet">

    <title>fishbook|message</title>
</head>
<body>
    @include('_navbar')
    @include('_header')
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
      @endif
{{-- users --}}
      </div>
          <div class="container-all-msg">
        <div class="w-100 p-3 container-all-msg2">
            <div class="container-user-mgs w-25 p-3">
                    <div class="ImgProfile">
                        <img src="../data_file/{{$datauser->Images_profile}}" alt="" class="fluid">
                    </div>
                    <div>
                        <a class="btn btn-secondary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                            {{$datauser->name}}
                          </a>
                    </div>
                    </div>
              <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <div>
                    @foreach($userdata as $user)
                    <div class="user-msg alert @if($user->id == $receiver) alert-dark @else alert-light @endif" role="alert">
                    <img src="../data_file/{{$user->Images_profile}}" alt="" class="thumbnailImgProfile">
                     <a href="/messages/{{$user->id}}" class="alert-link stretched-link">{{$user->name}}</a>
                  </div>
                    @endforeach
                </div>
                </div>
              </div>
            
            

{{-- message --}}
        <?php
        ?>
            <div class="container-chat-msg w-75 p-3">
                <div class="container-chat-msg2 w-100 p-3">
                    @foreach($messagesSender as $msg)
                    @if($sender == $msg->user_id)
                    <div class="alert alert-info msg" role="alert">
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
                      <div class="alert alert-danger" role="alert">
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
                <div class="container-form">
                    <form action="/sendmsg" method="POST" id="sendMessageForm">
                        {{-- <form id="sendMessageForm"> --}}

                        @csrf
                        <input type="text" name="reciever" value=" {{$receiver}}" hidden>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="messages"  aria-describedby="button-addon2" name="content" @if($sender == $receiver) hidden @endif>
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2" @if($sender == $receiver) hidden @endif >Send</button>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    
    {{-- <script>
        function sendMessage() {
            // Ambil data formulir
            var formData = new FormData(document.getElementById('sendMessageForm'));
            // Buat objek XMLHttpRequest
            var xhr = new XMLHttpRequest();
            // Konfigurasi permintaan
            xhr.open('POST', '/sendmsg', true);
            xhr.setRequestHeader('X-CSRF-Token', document.querySelector('meta[name="csrf-token"]').content);
            // Tangkap perubahan status permintaan
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Handle respon dari server (misalnya, perbarui tampilan atau tambahkan pesan)
                        console.log(xhr.responseText);
    
                        // Contoh: tampilkan pesan di dalam elemen dengan ID "messageContainer"
                        document.getElementById('messageContainer').innerHTML = 'Pesan terkirim!';
                    } else {
                        // Handle kesalahan
                        console.error(xhr.statusText);
                    }
                }
            };
    
            // Kirim data ke server
            xhr.send(formData);
        }
    </script> --}}
    
</body>
</html>