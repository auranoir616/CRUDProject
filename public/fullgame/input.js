export class InputHandler {
    constructor(game){
        this.game = game
        this.keys = []
        window.addEventListener('keydown', e =>{
            if (( e.key === 'ArrowDown' || 
                e.key === 'ArrowUp' ||
                e.key === 'ArrowLeft' || 
                e.key === 'ArrowRight' ||
                e.key === 's'
            ) && this.keys.indexOf(e.key) === -1){
                this.keys.push(e.key)
            } else if (e.key === 'k') this.game.debug = !this.game.debug
            
        })
        window.addEventListener('keyup', e =>{
            if ( e.key === 'ArrowDown' || 
                e.key === 'ArrowUp' ||
                e.key === 'ArrowLeft' || 
                e.key === 'ArrowRight' ||
                e.key === 's'){
             this.keys.splice(this.keys.indexOf(e.key), 1)
        }
    })
    }
}