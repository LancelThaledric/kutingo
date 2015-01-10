/**********************
        Audio
        
        Sound Manager of Kutingo
***********************************/

function SoundManager(app){
    var self = this;
    
    // Membres Vars ///////////////////////////////////////////////////////////////
    
    self.app = app;
    
    self.bgHandler;
    self.bgSegments;
    self.firstPlayBgmusic;
    
    // CONSTRUCTOR  ///////////////////////////////////////////////////////////////
    
    self.init = function()
    {
        self.bgHandler = document.getElementById("bgmusic");
        self.bgSegments = 3;
        self.bgHandler.pause();
        self.firstPlayBgmusic = true;
    }
    
    self.resetBgmusic = function()
    {
        if(!self.firstPlayBgmusic)
        self.bgHandler.currentTime = Math.floor(Math.random()*self.bgSegments) * (self.bgHandler.duration / self.bgSegments);
        if(self.firstPlayBgmusic)
        self.firstPlayBgmusic = false;
    }
    
    self.playBgmusic = function()
    {
        self.bgHandler.play();
    }
    
    self.pauseBgmusic = function()
    {
        self.bgHandler.pause();
    }
    
    self.update = function()
    {
        if(self.bgHandler.currentTime >= self.bgHandler.duration)
            self.bgHandler.currentTime = 0;
    }
    
    // Methods  ///////////////////////////////////////////////////////////////////
    
    // LAUNCH OBJECT !! YEAH  ! /////////////////////////////////////////////////
    self.init();
}