import {Player} from "./player.js"
import { InputHandler } from "./input.js";
import { Background } from "./backGround.js";
import { FlyingEnemy,ClimbingEnemy,GroundEnemy } from "./enemies.js";
import { UI } from "./UI.js";

window.addEventListener("load",function(){
    const canvas = document.getElementById('canvas1')
    const ctx = canvas.getContext('2d');
    canvas.width = 500
    canvas.height = 500

    class Game{
        constructor(width, height){
            this.width = width;
            this.height = height;
            this.groundMargin = 50
            this.speed = 0
            this.maxSpeed = 6
            this.background = new Background(this)
            this.player = new Player(this)
            this.input = new InputHandler(this)
            this.ui = new UI(this)
            this.enemies = []
            this.particles = []
            this.collisions = []
            this.messages = []
            this.enemyTimer = 0
            this.enemyInterval = 1000
            this.debug = false
            this.score = 0
            this.time = 0
            this.lives = 5
            this.energy = 0 //!
            this.currentEnergy = this.energy
            this.maxEnergy = 100
            this.winScore = 40
            this.maxTime = 30000
            this.gameOver = false
            this.maxParticles = 50
            this.fontColor = "black"
            this.player.currentState = this.player.states[0]
            this.player.currentState.enter()
    
        }
        update(deltaTime){
            this.time += deltaTime
            if(this.time > this.maxTime) this.gameOver = true
            this.background.update()
            this.player.update(this.input.keys, deltaTime)
            //handle enemy
            if(this.enemyTimer > this.enemyInterval){
                this.addEnemy()
                this.enemyTimer = 0
            }else{
                this.enemyTimer += deltaTime
            }
            this.enemies.forEach(enemy =>{
                enemy.update(deltaTime)
            })
        //handle message
             this.messages.forEach(msg =>{
            msg.update()
              })

        //handle particles
            this.particles.forEach((particle, index)=>{
                particle.update()
            })
        if(this.particles.length > this.maxParticles ){
            this.particles.length = this.maxParticles
        }
        //handle collision
        this.collisions.forEach((collision, index)=>{
            collision.update(deltaTime)
        })
        this.enemies = this.enemies.filter(enemy => !enemy.markedForDelletion)
        this.particles = this.particles.filter(particle => !particle.markedForDelletion)
        this.collisions = this.collisions.filter(collision => !collision.markedForDelletion)
        this.messages = this.messages.filter(msg => !msg.markedForDelletion)
        


        }
        
        draw(ctx){
            this.background.draw(ctx)
            this.player.draw(ctx)
            this.enemies.forEach(enemy =>{
                enemy.draw(ctx)
            })
            this.particles.forEach(particle =>{
                particle.draw(ctx)
            })
            this.collisions.forEach(collision =>{
                collision.draw(ctx)
            })
            this.messages.forEach(msg =>{
                msg.draw(ctx)
            })
    
            this.ui.draw(ctx)

        }
        addEnemy(){
            if(this.speed > 0 && Math.random() < 0.5) this.enemies.push(new GroundEnemy(this))
            if(this.speed > 0 && Math.random() > 0.5) this.enemies.push(new ClimbingEnemy(this))
            this.enemies.push(new FlyingEnemy(this))
            // console.log(this.enemies)

        }
    }

    const game = new Game(canvas.width, canvas.height)
    // console.log(game)
    let lastTime = 0
    function animate(timeStamp){
        const deltaTime = timeStamp - lastTime
        lastTime = timeStamp
        ctx.clearRect(0,0,canvas.width,canvas.height)
        game.update(deltaTime)
        game.draw(ctx)
        if(!game.gameOver) requestAnimationFrame(animate)
    }
    animate(0)

})