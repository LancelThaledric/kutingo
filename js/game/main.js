/**********************
        Kutingo
        
        by Valentin Mourot
         & Olivier Falconnet
***********************************/


function Kutingo(){
    var self = this;
    
    // Constants
    self.aspectRatio = 16./9.;
    self.clearColor = 0x550000;
    
    // Scene vars
    self.focus = false;
    
    self.scene = new THREE.Scene();
    self.camera = new THREE.PerspectiveCamera( 75, self.aspectRatio, 0.1, 1000 );
    
    if (window.WebGLRenderingContext)
        self.renderer = new THREE.WebGLRenderer();
    else
	    self.renderer = new THREE.CanvasRenderer();
    
    self.canvas = this.renderer.domElement;
    self.canvas.setAttribute("id", "glrenderer");
    
    // Methods
    self.update = function()
    {
        cube.rotation.x += 0.1;
        cube.rotation.y += 0.1;
    }
    
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
    
    self.init = function()
    {
        self.renderer.setClearColor(self.clearColor);
    }
    
    self.render = function()
    {
        self.update();
        requestAnimationFrame( self.render );
        self.renderer.clear();
        self.renderer.render( self.scene, self.camera );
    }
    
    // Initialization
    document.getElementById("game").appendChild( self.canvas );
    self.onResize();
    self.init();
    
    // Cube time !
    var geometry = new THREE.BoxGeometry( 1, 1, 1 );
    var material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
    var cube = new THREE.Mesh( geometry, material );
    self.scene.add( cube );

    self.camera.position.z = 5;
    
    self.render();
}