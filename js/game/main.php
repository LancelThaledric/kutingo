<?php
header('Content-Type: text/javascript');
?>

/**********************
        Kutingo
        
        by Valentin Mourot
         & Olivier Falconnet
***********************************/

<?php

require_once('Math.php');
require_once('EventHandler.php');
require_once('TitleState.php');
require_once('PlayState.php');
require_once('EndState.php');
require_once('Score.php');
require_once('Audio.php');
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
    self.hud;
    
    self.eventHandler;
    
    self.states;
    
    self.clock;
    self.deltaTime;
    
    self.soundmanager;
    self.jinglePlayed;
    
    self.paused;
    self.pseudo;
    
    
    // CONSTRUCTOR  ///////////////////////////////////////////////////////////////
    
    self.init = function()
    {
        // Gui attributes
        self.aspectRatio = 16./9.;
        self.clearColor = 0x000000;
        self.focus = false;
        
        // Scene vars
        self.scene = new THREE.Scene();
        self.camera = new THREE.OrthographicCamera(
            -self.aspectRatio*100,      // Left
            self.aspectRatio*100,       // Right
            100,                      // Top
            -100,                     // Bottom
            1,                      // znear
            1000                    // zfar
        );
        self.camera.position.z = 100;
        
        // Renderer 
        if (window.WebGLRenderingContext)
            self.renderer = new THREE.WebGLRenderer();
        else
            self.renderer = new THREE.CanvasRenderer();
        self.renderer.setClearColor(self.clearColor);
        self.renderer.antialias = true;
        // Canvas
        self.canvas = this.renderer.domElement;
        self.canvas.setAttribute("id", "glrenderer");
        document.getElementById("game").appendChild( self.canvas );
        self.onResize();
        
        // HUD
        self.hud = document.createElement('div');
        document.getElementById("game").appendChild( self.hud );
        $(self.hud).css({
            'position' : 'absolute',
            'width' : '100%',
            'height' : '100%',
            'top' : 0,
            'line-height' : '40px'
        });
        
        //music
        self.soundmanager = new SoundManager(self);
        self.jinglePlayed = false;
        
        //Pseudo
        self.pseudo = "";
        
        // States
        self.eventHandler = new EventHandler(self);
        self.states = [];
        
        $(self).bind('appMayStart', self.launch);
        
    }
    
    
    // Methods  ///////////////////////////////////////////////////////////////////
    
    self.launch = function()
    {
        
        // Clock Launch
        self.clock = new THREE.Clock(true);
        
        // Stating Game on the Title Screen
        //self.states.push(new PlayState(self));
        self.states.push(new TitleState(self));
        
        // Launch Render Loop
        self.render();
    }
    
    /*
    update
    call the update method of all the arboresence
    */
    self.update = function()
    {
        for(i=0 ; i<self.states.length ; i++)
        {
            if(self.states[i].hasToPop)
            {
                self.states[i].onDestroy();
                self.states.splice(i, 1);
            }
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
    
    self.pause = function(){
        self.paused = true;
    }
    
    self.resume = function(){
        self.paused = false;
        self.render();
    }
    
    /*
    render
    Three.js method for drawing scene
    */
    self.render = function()
    {
        self.deltaTime = self.clock.getDelta();
        self.handleEvents();
        self.update();
        if(!self.paused)
            requestAnimationFrame( self.render );
        self.renderer.clear();
        self.draw();
        self.renderer.render( self.scene, self.camera );
    }
    
    // LAUNCH OBJECT !! YEAH  ! /////////////////////////////////////////////////
    self.init();
}