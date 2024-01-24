<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
    background:  linear-gradient(125deg, rgb(49, 49, 49), rgb(129, 129, 129), rgb(230, 230, 230));
    /* background-color: rgb(88, 88, 88) */
    overflow: hidden;
    }
    canvas{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

        }
        #collisioncanvas{
            opacity: 0;
            }
    </style>
</head>
<body>
    <canvas id="collisioncanvas"></canvas>
    <canvas id="canvas1"></canvas>
    <script src="../fullgame/game.js"></script>
</body>
</html>