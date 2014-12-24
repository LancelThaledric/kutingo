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
        
        self.line = new KLine();
        
        // Cube time !      // TEMPORARY
        self.geometry = new THREE.BoxGeometry( 10, 10, 10 );
        self.material = new THREE.MeshBasicMaterial( { color: 0x0055ff } );
        self.cube = new THREE.Mesh( self.geometry, self.material );
        self.app.scene.add( self.cube );
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.handleEvents = function()
    {
        
    }
    
    self.update = function()
    {
        // TEMPORARY
        self.cube.rotation.x += 0.1;
        self.cube.rotation.y += 0.1;
    }
    
    self.draw = function()
    {
        
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}