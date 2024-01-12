<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../style.css" rel="stylesheet">

    <title>messages</title>
</head>
<body>
    <p>sender: {{$sender->id}}</p>
    <p>reciever: {{$reciever}}</p>
    <div class="container-all-msg">
        <div class="w-100 p-3 container-all-msg2">
            <div class="container-user-mgs w-25 p-3">

            </div>
            <div class="container-chat-msg w-50 p-3">
                <div class="container-chat-msg2">

                </div>
                <div class="container-form">
                    <form action="/sendmsg" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="reciever" value=" {{$reciever}}" hidden>
                            <input type="text" class="form-control" placeholder="messages"  aria-describedby="button-addon2" name="content">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">Send</button>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    
</body>
</html>