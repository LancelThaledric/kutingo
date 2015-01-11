/**********************
        EndState
        
        Game Over Screen, share score
***********************************/

function EndState(app){
    var self = this;
    
    
    // Members Vars ///////////////////////////////////////////////////////////////

    self.app;
    
    self.hasToPop = false;
    
    self.score;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        
        self.app = app;
        
        self.score = 0;
        
        self.hudelem = document.createElement('div');
        self.app.hud.appendChild(self.hudelem);
        
        $(self.hudelem).css({
            'font' : '200px monospace bold',
            'text-shadow' : '#fff 0px 0px 20px, #fff 0px 0px 50px'
        });
        
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.handleEvents = function()
    {
        if(self.app.eventHandler.spaceKey)
        {
            self.app.eventHandler.spaceKey = false;
            self.hasToPop = true;
            self.app.states.push(new PlayState(self.app));
        }
    }
    
    self.update = function()
    {
        
    }
    
    self.draw = function()
    {
        self.hudelem.innerText = self.score;
    }
    
    self.onDestroy = function()
    {
        self.app.hud.removeChild(self.hudelem);
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}