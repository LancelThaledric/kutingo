/**********************
        PlayState
        
        In-Game managment
***********************************/

<?php

require_once('KLine.php');

?>

function PlayState(app){
    var self = this;
    
    // Members Vars ///////////////////////////////////////////////////////////////

    self.app;
    
    
    self.line;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        
        self.app = app;
        
        self.line = new KLine(self.app);
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.handleEvents = function()
    {        
        self.line.handleEvents();
    }
    
    self.update = function()
    {
        self.line.update();
    }
    
    self.draw = function()
    {
        self.line.draw();
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}