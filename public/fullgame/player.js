import { Falling, Jumping, Running, Sitting,Rolling,Diving,Hit } from "./playerState.js";
import { CollisionAnimation } from "./collision.js";
import { Message } from "./message.js";
export class Player{
    constructor(game){
        this.game = game;
        this.width = 100;
        this.height = 91.3;
        this.x = 0;
        this.y = this.game.height - this.height - this.game.groundMargin
        this.vy = 0
        this.weight = 1
        this.image = document.getElementById('player');
        this.frameX = 0
        this.frameY = 0
        this.maxFrame = 5
        this.fps = 20
        this.frameInterval = 1000/this.fps
        this.frameTimer = 0
        this.speed = 0;
        this.maxSpeed = 10
        this.states = [new Running(this.game),new Sitting(this.game), new Jumping(this.game),new Falling(this.game)
            ,new Rolling(this.game), new Diving(this.game),new Hit(this.game)]
        this.currentState = null
    }
    update(input, deltaTime){
        this.checkCollision()
        this.currentState.handlerInput(input)
        //horizontal move
        this.x += this.speed
        if(input.includes("ArrowRight") && this.currentState!== this.states[6])
         this.speed = this.maxSpeed 
        else if(input.includes("ArrowLeft")&& this.currentState!== this.states[6])
         this.speed = -this.maxSpeed
        else this.speed = 0 
        //batasan horizontal
        if (this.x < 0) this.x = 0
        if(this.x > this.game.width - this.width) this.x = this.game.width - this.width
        //vertical move
        this.y += this.vy
        if(!this.onGround()) this.vy += this.weight
        else this.vy = 0
        if(this.y > this.game.height - this.height - this.game.groundMargin) 
        this.y = this.game.height - this.height - this.game.groundMargin


        //animation
        if(this.frameTimer > this.frameInterval){
            this.frameTimer = 0
            if(this.frameX < this.maxFrame) this.frameX++
            else this.frameX = 0
        }else{
            this.frameTimer += deltaTime
        }   
        if(input.includes("s")){
        this.game.energy--}
        else{
            this.game.energy++ 
        }
          if(this.game.energy > this.game.maxEnergy){
        this.game.energy = this.game.maxEnergy
         }else if(this.game.energy < 0){
            this.game.energy = 0
         }
        
        
        

    }
    draw(ctx){
        if (this.game.debug) 
        ctx.strokeRect(this.x + 20, this.y + 20, this.width * 0.7, this.height * 0.8)
        ctx.drawImage(this.image,this.frameX*this.width,this.frameY*this.height,this.width,this.height, this.x, this.y,this.width,this.height)
    }
    onGround(){
        return this.y >= this.game.height - this.height - this.game.groundMargin
    }
    setState(state,speed){
        this.currentState = this.states[state]
        this.game.speed = this.game.maxSpeed * speed
        this.currentState.enter()
    }
    checkCollision(){
        this.game.enemies.forEach(enemy =>{
            if(
                enemy.x < (this.x + 20)+ (this.width * 0.7) &&
                enemy.x + enemy.width >(this.x + 20) &&
                enemy.y < (this.y + 20) + this.height &&
                enemy.y + enemy.height > (this.y + 20)
            ){
                enemy.markedForDelletion = true;
                this.game.collisions.push(new CollisionAnimation(this.game, enemy.x + enemy.width * 0.5, enemy.y + enemy.height * 0.5))
                if(this.currentState === this.states[4] || this.currentState === this.states[5] ){
                    this.game.messages.push(new Message('+1',enemy.x, enemy.y,100,40))
                    this.game.score++


                }else{
                    this.setState(6, 0)
                    this.game.score-=2
                    if(this.game.score <= 0)
                    this.game.score = 0
                    this.game.lives--
                    if(this.game.lives <=0 ) this.game.gameOver = true
                }
            }
        })
    }
}