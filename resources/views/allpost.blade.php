<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>fishbook|home</title>
</head>
<?php
  $username = auth()->user()->name;
?>
<body>
    @include('_navbar')
  <hr>
  <main>
<hr>
      <aside>
        @include('_cardprofile')
        @include('_aside')
      </aside>
    <article>
      @include('_allpost')
</article>
<section>
</section>
</main>
</body>
</html>