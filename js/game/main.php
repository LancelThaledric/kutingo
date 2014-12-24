<?php
header('Content-Type: text/javascript');
?>

/**********************
        Kutingo
        
        by Valentin Mourot
         & Olivier Falconnet
***********************************/

<?php

require_once('EventHandler.php');
require_once('GameState.php');
require_once('TitleState.php');

?>


function Kutingo(){
    var self = this;
    
    // Membres Vars ///////////////////////////////////////////////////////////////
    
    self.aspectRatio;
    self.clearColor;
    
    self.focus;
    
    self.scene;
    self.camera;
    self.renderer;
    
    self.canvas;
    
    self.stateGeneric;
    self.eventHandler;
    
    self.states;
    
    // CONSTRUCTOR  ///////////////////////////////////////////////////////////////
    
    self.init = function()
    {
        // Gui attributes
        self.aspectRatio = 16./9.;
        self.clearColor = 0x550000;
        self.focus = false;
        
        // Scene vars
        self.scene = new THREE.Scene();
        self.camera = new THREE.OrthographicCamera(
            -self.aspectRatio,      // Left
            self.aspectRatio,       // Right
            1,                      // Top
            -1,                     // Bottom
            1,                      // znear
            1000                    // zfar
        );
        self.camera.position.z = 5;
        
        // Renderer 
        if (window.WebGLRenderingContext)
            self.renderer = new THREE.WebGLRenderer();
        else
            self.renderer = new THREE.CanvasRenderer();
        
        self.renderer.setClearColor(self.clearColor);
        
        // Canvas
        self.canvas = this.renderer.domElement;
        self.canvas.setAttribute("id", "glrenderer");
        document.getElementById("game").appendChild( self.canvas );
        self.onResize();
        
        // States
        self.stateGeneric = new GameState(self);
        self.eventHandler = new EventHandler(self);
        self.states = [];
        
        // Stating Game on the Title Screen
        self.states.push(new TitleState(self.stateGeneric));
        
        // Launch Render Loop
        self.render();
    }
    
    
    // Methods  ///////////////////////////////////////////////////////////////////
    
    /*
    update
    call the update method of all the arboresence
    */
    self.update = function()
    {
        for(i=0 ; i<self.states.length ; i++)
        {
            self.states[i].update();
        }
    }
    
    /*
    handleEvents
    call the handleEvents method of all the arboresence
    */
    self.handleEvents = function()
    {        
        for(i=0 ; i<self.states.length ; i++)
        {
            self.states[i].handleEvents();
        }
    }
    
    /*
    draw
    call the draw method of all the arboresence
    */
    self.draw = function()
    {        
        for(i=0 ; i<self.states.length ; i++)
        {
            self.states[i].draw();
        }
    }
    
    
    /*
    onResize
    Recompute the canvas size to fit to the aspectRatio
    */
    self.onResize = function()
    {
        var w, h;
        if(window.innerWidth >= window.innerHeight * self.aspectRatio)
        {
            // Black bands are on the left and the right
            h = window.innerHeight;
            w = self.aspectRatio*window.innerHeight;
        }
        else
        {
            // Black bands are on the top and the bottom
            w = window.innerWidth;
            h = window.innerWidth / self.aspectRatio;
        }
        
        self.renderer.setSize( w, h);
    }
    
    /*
    render
    Three.js method for drawing scene
    */
    self.render = function()
    {
        self.handleEvents();
        self.update();
        requestAnimationFrame( self.render );
        self.renderer.clear();
        self.draw();
        self.renderer.render( self.scene, self.camera );
    }
    
    // LAUNCH OBJECT !! YEAH  ! /////////////////////////////////////////////////
    self.init();
}