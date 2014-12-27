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
        self.checkBarCollisions();
        
        // Reflection of bullets on the bar
        
    }
    
    self.checkBarCollisions = function(){
        // Step 0 : Compute each bullet
        for(var i=0, is3 = 0 ; i<self.bullets.positions.length ; i+= 3, is3++)
        {
            // Step 1 : Check the distance between the bullet and the center
            if (self.bullets.positions[i] * self.bullets.positions[i]
               + self.bullets.positions[i+1] * self.bullets.positions[i+1]
               > self.line.size * self.line.size)
            {
                // No Collision
                continue;
            }
            
            //Step 2 : Check if the bullet has crossed the line
            if()
            {
                continue;
            }
            
            // Final : We change the direction of the bullet
            self.bullets.speeds[is3] = -1;
            
        }
    }
    
    self.draw = function()
    {
        self.line.draw();
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}