/**********************
        KPattern
        
        Pattern af spawing bullets and targets
***********************************/

function KPattern(app, parentstate){
    var self = this;
    
    var patternDivider = 16;
    
    // Members Vars ///////////////////////////////////////////////////////////////

    self.app;
    self.parentstate;
    
    // Logic
    self.duration;
    self.data;
    self.starttime;
    self.previousMicroTap;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        self.app = app;
        self.parentstate = parentstate;
        
        self.duration = 4;
        
        self.data = new Array(self.duration * patternDivider);
        
        self.data[0] = [];
        
        self.data[0].push( new KBulletSpawner(self.app, self.parentstate,
                                              0, 0, 1));
        self.data[0].push( new KBulletSpawner(self.app, self.parentstate,
                                              Math.PI, 0, 1));
        
        self.data[2*patternDivider] = [];
        self.data[2*patternDivider].push( new KBulletSpawner(self.app, self.parentstate,
                                              -Math.PI/2, 0, 1));
        self.data[2*patternDivider].push( new KBulletSpawner(self.app, self.parentstate,
                                              Math.PI/2, 0, 1));
        
        self.starttime = self.app.clock.elapsedTime;
        self.previousMicroTap = -1;

    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.update = function()
    {        
        var microtap = Math.floor((self.app.clock.elapsedTime - self.starttime) / (self.parentstate.bpm / patternDivider));
        if(microtap > self.previousMicroTap){
            self.previousMicroTap = microtap;
            
            if(self.data[microtap] !== undefined){
                // self.data[n] must be an array.
                
                // TODO spawn bullets
            }
            
            
            
        }
        
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}






/**********************
        KPatternElement
        
        A list of bullets and targets to be spawned at a time T
***********************************/

function KPatternElement(app, parentstate)
{
    var self = this;
    
    // Members Vars ///////////////////////////////////////////////////////////////

    self.app;
    self.parentstate;
    
    // Logic
    self.bullets;
    self.targets;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        self.app = app;
        self.parentstate = parentstate;

    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.update = function()
    {
        // Nothing ?
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}



/**********************
        KBullet Spawner
        
        All the information of How to spawn a bullet
***********************************/

function KBulletSpawner(app, parentstate, rad, off, speed){
    var self = this;
    
    // Members Vars ///////////////////////////////////////////////////////////////

    self.app;
    self.parentstate;
    
    // Logic
    self.off;
    self.rad;
    self.speed;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        self.app = app;
        self.parentstate = parentstate;
        
        self.rad = rad;
        self.off = off;
        self.speed = speed;
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.spawn = function()
    {
        
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}



/**********************
        KTarget Spawner
        
        All the information of How to spawn a bullet
***********************************/

function KTargetSpawner(app, parentstate){
    var self = this;
    
    // Members Vars ///////////////////////////////////////////////////////////////

    self.app;
    self.parentstate;
    
    // Logic
    self.off;
    self.rad;
    self.speed;
    self.size;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        self.app = app;
        self.parentstate = parentstate;
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.spawn = function()
    {
        
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}