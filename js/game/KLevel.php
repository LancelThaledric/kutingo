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
        self.linewidth = 40;
        self.bpm = 60./140.;
        
        
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.load = function(){
        // Load a level  
        self.parentstate.line.size = self.linewidth;
        self.parentstate.bpm = self.bpm;
        self.parentstate.patternlist = 
        [
            Pattern_CrossBullet(new KPattern(self.app, self.parentstate)),
            Pattern_CrossBulletDiag(new KPattern(self.app, self.parentstate))
        ];
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}