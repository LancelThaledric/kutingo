/**********************
        KLevel
        
        Level initialiser
***********************************/

function KLevel(app, parentstate){
    var self = this;
    
    
    // Members Vars ///////////////////////////////////////////////////////////////

    self.app;
    self.parentstate;
    
    self.linewidth;
    self.bpm;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        
        self.app = app;
        self.parentstate = parentstate;
        
        // Temporry : Base level information
        self.linewidth = 20;
        self.bpm = 60./ 140.;
        
        
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.load = function(){
        // Load a level  
        self.parentstate.line.size = self.linewidth;
        self.parentstate.bpm = self.bpm;
        self.parentstate.patternlist = 
        [
            new Pattern_CrossBullet(),
            new Pattern_CrossBulletDiag(),
            new Pattern_RandomLittleBulletRafale(),
            new Pattern_RandomTwoSidedBulletRafale(),
            //new Pattern_BulletFan(),
            new Pattern_RandomBulletShrapnel(),
            
            new Pattern_RandomTargetRafale(),
            new Pattern_RandomTwoSidedTargetRafale(),
            new Pattern_RandomTwoSidedLittleRapidTargetRafale(),
            new Pattern_TargetSoloRandom(),
            new Pattern_TargetSoloRandom(),
            new Pattern_TargetSoloRandom(),
            new Pattern_TargetSoloRandom()
        ];
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}