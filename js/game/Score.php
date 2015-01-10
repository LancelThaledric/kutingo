/**********************
        Score
        
        Score and interaction with it.
***********************************/

function Score(app, parentstate){
    var self = this;
    
    // Members Vars ///////////////////////////////////////////////////////////////

    self.app;
    self.parentstate = parentstate;
    
    // Logic
    
    self.timescore;
    self.bonusscore;
    self.totalscore;
    
    // display
    
    self.canvas;
    self.ctx;
    self.gradient;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        self.app = app;
        
        self.bonusscore = 42;
        self.timescore = 0;
        self.update();
        
        //self.disp_text;
        
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.update = function()
    {        
        self.totalscore = self.timescore + self.bonusscore;
    }
    
    self.reset = function(){
        self.timescore = 0;
        self.bonusscore = 0;
    }
    
    self.draw = function(){
        // Fill with gradient
        
        console.log(self.totalscore);
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}