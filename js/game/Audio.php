/**********************
        Audio
        
        Sound Manager of Kutingo
***********************************/

function SoundManager(app){
    var self = this;
    
    // Membres Vars ///////////////////////////////////////////////////////////////
    
    self.app = app;

    self.bgSegments;
    self.firstPlayBgmusic;
    
    self.sfx_bonus;
    self.sfx_gameover;
    self.sfx_jingle;
    self.bgm;
    
    
    // CONSTRUCTOR  ///////////////////////////////////////////////////////////////
    
    self.init = function()
    {
        soundManager.setup({
          url: 'lib/soundmanager2_flash9.swf',
          flashVersion: 9, // optional: shiny features (default = 8)
          // optional: ignore Flash where possible, use 100% HTML5 mode
          preferFlash: false,
          onready: function() {
            self.initSounds();
            $(self.app).trigger('appMayStart');
          },
          ontimeout: function() {
            // Hrmm, SM2 could not start. Missing SWF? Flash blocked? Show an error, etc.?
              console.log("SOUNDMANAGER couldn't start properly");
          }
        });
        
        self.bgHandler = document.getElementById("bgmusic");
        self.bgSegments = 3;
        self.firstPlayBgmusic = true;
        
        
    }
    
    self.initSounds = function()
    {
        self.sfx_bonus = soundManager.createSound({
            id:'sfx_bonus',
            url:'sound/KutBreak.mp3',
            autoLoad:true
        });
        soundManager.setVolume('sfx_bonus',90);
        
        self.sfx_gameover = soundManager.createSound({
            id:'sfx_gameover',
            url:'sound/KutGameOver.mp3',
            autoLoad:true
        });
        soundManager.setVolume('sfx_gameover',90);
        
        self.sfx_jingle = soundManager.createSound({
            id:'sfx_jingle',
            url:'sound/KutingoJingle.mp3',
            autoLoad:true
        });
        soundManager.setVolume('sfx_jingle',100);
        
        self.bgm = soundManager.createSound({
            id:'bgm',
            url:'sound/Kutingo.mp3',
            autoLoad:true
        });
    }
    
    self.resetBgmusic = function()
    {
        if(!self.firstPlayBgmusic)
        {
            soundManager.setPosition('bgm', Math.floor(Math.random()*self.bgSegments) * (self.bgm.duration / self.bgSegments))
        }
        if(self.firstPlayBgmusic)
            self.firstPlayBgmusic = false;
    }
    
    self.playBgmusic = function()
    {
        //self.bgHandler.play();
        self.bgm.play({
            onfinish : self.playBgmusic,
        });
    }
    
    self.pauseBgmusic = function()
    {
        self.bgm.pause();
        //self.bgHandler.pause();
    }
    
    self.update = function()
    {
        
    }
    
    // Methods  ///////////////////////////////////////////////////////////////////
    
    
    
    
    
    // LAUNCH OBJECT !! YEAH  ! /////////////////////////////////////////////////
    self.init();
}