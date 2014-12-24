/**********************
        GameState
        
        By-State Architecture of the game
***********************************/

function GameState(app){
    var self = this;
    
    // Members Vars ///////////////////////////////////////////////////////////////
    
    self.app;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        self.app = app;
        
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.handleEvents = function()
    {
        console.log("Handeling events of " + self);
    }
    
    self.update = function()
    {
        console.log("Updating " + self);
    }
    
    self.draw = function()
    {
        console.log("Drawing " + self);
    }
    
    // LAUCHE OBJECT HELL YEAH !    /////////////////////////////////////////////
    self.init();
}