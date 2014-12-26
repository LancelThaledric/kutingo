/**********************
        PlayState
        
        In-Game managment
***********************************/

<?php

require_once('KLine.php');
require_once('KBullets.php');

?>

function PlayState(app){
    var self = this;
    
    // Members Vars ///////////////////////////////////////////////////////////////

    self.app;
    
    
    self.line;
    self.bullets;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        
        self.app = app;
        
        self.line = new KLine(self.app);
        
        self.bullets = new KBullets(self.app);
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.handleEvents = function()
    {        
        self.line.handleEvents();
    }
    
    self.update = function()
    {
        self.line.update();
        self.bullets.update();
    }
    
    self.draw = function()
    {
        self.line.draw();
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}