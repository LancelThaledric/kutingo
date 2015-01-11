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
    
    self.hudscore;
    self.hudpseudo;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        
        self.app = app;
        
        self.score = 0;
        
        self.hudscore = document.createElement('div');
        self.app.hud.appendChild(self.hudscore);
        
        $(self.hudscore).css({
            'font' : '200px monospace bold',
            'text-shadow' : '#fff 0px 0px 20px, #fff 0px 0px 50px',
            'margin' : '48px'
        });
        
        self.hudpseudo = document.createElement('input');
        $(self.hudpseudo).attr('id','inputPseudo');
        $(self.hudpseudo).attr('placeholder','Your name here');
        $(self.hudpseudo).val(self.app.pseudo);
        self.app.hud.appendChild(self.hudpseudo);
        
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.handleEvents = function()
    {
        if(self.app.eventHandler.spaceKey || self.app.eventHandler.enterKey)
        {
            if($(self.hudpseudo).is(':focus') && self.app.eventHandler.spaceKey)
                return;
            
            self.app.eventHandler.spaceKey = false;
            self.app.eventHandler.enterKey = false;
            self.hasToPop = true;
            self.app.states.push(new PlayState(self.app));
        }
    }
    
    self.update = function()
    {
        
    }
    
    self.draw = function()
    {
        self.hudscore.innerText = self.score;
    }
    
    self.onDestroy = function()
    {
        self.app.pseudo = $(self.hudpseudo).val().trim();
        
        self.app.hud.removeChild(self.hudscore);
        self.app.hud.removeChild(self.hudpseudo);
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}