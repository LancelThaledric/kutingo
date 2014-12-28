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
    self.scalarstm2;
    self.scalarstm1;
    self.scalarst;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        
        self.app = app;
        
        self.line = new KLine(self.app);
        
        self.bullets = new KBullets(self.app);
        
        self.scalarstm2 = new Array(self.bullets.directions.lenght);
        self.scalarstm1 = new Array(self.bullets.directions.lenght);
        self.scalarst = new Array(self.bullets.directions.lenght);
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
        var lineVector = [Math.cos(self.line.orientation),
                          Math.sin(self.line.orientation)];
        var lineVectortm1 = [Math.cos(self.line.orientationtm1),
                          Math.sin(self.line.orientationtm1)];
        var bulletVector, bulletVectortm1;
        var newposBullet,
            x1line = Math.cos(self.line.orientation + Math.PI/2),
            y1line = Math.sin(self.line.orientation + Math.PI/2),
            x2line = Math.cos(self.line.orientation - Math.PI/2),
            y2line = Math.sin(self.line.orientation - Math.PI/2);
        // Step 0 : Compute each bullet
        for(var i=0, is3 = 0 ; i<self.bullets.positions.length ; i+= 3, is3++)
        {
            // Step 1 : If the ball has already bounced, we don't compute it.
            if(self.bullets.hasBounced[is3])
                continue;
            
            //Step 2 : Check if the bullet has crossed the line            
            
            bulletVector = [self.bullets.positions[i],
                            self.bullets.positions[i+1]];
            bulletVectortm1 = [self.bullets.positionstm1[i],
                               self.bullets.positionstm1[i+1]];
            var st = lineVector[0] * bulletVector[0]
                   + lineVector[1] * bulletVector[1];
            
            self.scalarstm2[is3] = self.scalarstm1[is3];
            self.scalarstm1[is3] = self.scalarst[is3];
            self.scalarst[is3] = st;
            
            if(st*self.scalarstm2[is3] > 0 ) //st and stm1 does have the same sings.
            {
                continue;
            }
            
            
                        
            // Step 3 : Check the distance between the bullet and the center
            if (self.bullets.positions[i] * self.bullets.positions[i]
               + self.bullets.positions[i+1] * self.bullets.positions[i+1]
               > self.line.size * self.line.size)
            {
                // No Collision
                continue;
            }
            
            
            
            // Else : There is a cross of the line !
            console.log("REBOND !");
            
            // Step 4 : Collision ! We compute the direction of the bullet
            self.bullets.directions[is3] =
                -(-self.bullets.directions[is3] + 2*(self.line.orientation - Math.PI/2) - Math.PI / 2) + Math.PI/2;
            // C'est MEGA MOCHE, mais ça marche ! :D
            
            
            // Final : We change the direction of the bullet
            self.bullets.speeds[is3] = 4;
            self.bullets.hasBounced[is3] = true;
            
        }
    }
    
    self.draw = function()
    {
        self.line.draw();
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}