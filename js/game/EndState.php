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
    self.hudtip;
    self.saved;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        
        self.app = app;
        
        self.score = 0;
        self.saved = false;
        
        self.hudscore = document.createElement('div');
        self.app.hud.appendChild(self.hudscore);
        $(self.hudscore).addClass('HUDscore').addClass('HUDbigscore');
        
        self.hudpseudo = document.createElement('input');
        $(self.hudpseudo).attr('type','text');
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
        
        self.hudtip = document.createElement('div');
        if(!self.app.autosave)
            $(self.hudtip).html('Press Space or Enter to save your score and retry');
        else
            $(self.hudtip).html('Score saved. Press Space or Enter to retry.');
        self.app.hud.appendChild(self.hudtip);
        
        self.hudtoogleautosave = document.createElement('input');
        $(self.hudtoogleautosave).attr('type','checkbox');
        $(self.hudtoogleautosave).attr('id','hudtoogleautosave');
        if(self.app.autosave) $(self.hudtoogleautosave).attr('checked','checked');
        self.app.hud.appendChild(self.hudtoogleautosave);
        
        self.hudtoogleautosavetip = document.createElement('label');
        $(self.hudtoogleautosavetip).attr('for','hudtoogleautosave');
        $(self.hudtoogleautosavetip).html('Auto-record your score');
        self.app.hud.appendChild(self.hudtoogleautosavetip);
        
        $(self.hudtoogleautosave).on('click',
            function(){self.app.autosave = !self.app.autosave;}
        );
        
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
        
        self.recordScore();
        
        self.app.hud.removeChild(self.hudscore);
        self.app.hud.removeChild(self.hudpseudo);
        self.app.hud.removeChild(self.hudtip);
        self.app.hud.removeChild(self.hudtoogleautosave);
        self.app.hud.removeChild(self.hudtoogleautosavetip);
    }
    
    self.recordScore = function(){
        if(self.saved) return;
        
        if(self.app.pseudo != ''){
            $.ajax({
                url: "ajax/record.php",
                type: "POST",
                dataType: "html",
                data : 'pseudo='+self.app.pseudo+'&score='+self.score
            })
            .done(function(content) {
                //Nothing
            })
            .fail(function() {
                alert('Failed to record your score.');
            });
            
            self.saved = true;
        }
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