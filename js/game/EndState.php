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
        $(self.hudscore).addClass('HUDscore').addClass('HUDbigscore');
        
        self.hudpseudo = document.createElement('input');
        $(self.hudpseudo).attr('id','inputPseudo');
        $(self.hudpseudo).attr('placeholder','Your name here');
        
        
        if(self.app.pseudo != '')
        {
            $(self.hudpseudo).val(self.app.pseudo);
        }
        else
        {
        var cookiepseudo = self.readCookie('pseudo');
        if(cookiepseudo != null)
            $(self.hudpseudo).val(cookiepseudo);
        }
        
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
        
        if(self.app.pseudo != '')
            self.createCookie('pseudo', self.app.pseudo, 365);
        
        self.app.hud.removeChild(self.hudscore);
        self.app.hud.removeChild(self.hudpseudo);
    }
    
    
    self.createCookie = function(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
    }

    self.readCookie = function(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}