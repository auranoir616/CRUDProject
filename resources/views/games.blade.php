<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Creepster&family=Sancreek&display=swap" rel="stylesheet">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        #canvas1{
            border: 5px solid black;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 100%;
            max-height: 100%;
            font-family: 'Creepster', cursive;
        }
        #player, #layer1, #layer2, #layer3, #layer4, #layer5,#enemy_fly,#enemy_plant,#enemy_spider_big,#fire,#collision,#lives{
            display: none;
        }
        .buttons{
            position: absolute;
            top:10%;
            left: 50%;
            transform: translate(-50%, -50%)
        }
        h5{
            position: absolute;
            top: 85%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin-top: 20px;

        }
    </style>
</head>
<body>
    
<canvas id="canvas1"></canvas>
<h5>
    <ul>
        <li>Arrows to navigate</li>
        <li>S to skill</li>
        <li>Achive 40 score to win</li>
    </ul>
    
</h5>
<img src="../fullgame/aset/player.png" id="player">
<img src="../fullgame/aset/forest-2.png" id="layer2">
<img src="../fullgame/aset/forest-3.png" id="layer3">
<img src="../fullgame/aset/forest-4.png" id="layer4">
<img src="../fullgame/aset/forest-1.png" id="layer1">
<img src="../fullgame/aset/forest-5.png" id="layer5">
<img src="../fullgame/aset/enemy_fly.png" id="enemy_fly">
<img src="../fullgame/aset/enemy_plant.png" id="enemy_plant">
<img src="../fullgame/aset/enemy_spider_big.png" id="enemy_spider_big">
<img src="../fullgame/aset/fire.png" id="fire">
<img src="../fullgame/aset/boom (1).png" id="collision">
<img src="../fullgame/aset/lives.png" id="lives">

<div class="buttons">
    <a href="/allpost" class="btn btn-light">Back</a>
    <button class="btn btn-secondary">reset game</button>
</div>
    <script type="module" src="../fullgame/main.js"></script>
    <script>
        let btn = document.querySelector('.btn-secondary')
        btn.addEventListener('click', function(){
            window.location.reload()
        })
    </script>
</body>
</html>