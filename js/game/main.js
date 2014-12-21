/**********************
        Kutingo
        
        by Valentin Mourot
         & Olivier Falconnet
***********************************/


function Kutingo(){
    var self = this;
    
    // Constants
    self.aspectRatio = 16./9.;
    
    
    // Scene vars
    self.focus = false;
    
    self.scene = new THREE.Scene();
    self.camera = new THREE.PerspectiveCamera( 75, self.aspectRatio, 0.1, 1000 );

    self.renderer = new THREE.WebGLRenderer();
    self.canvas = this.renderer.domElement;
    
    // Methods
    self.update = function()
    {
        cube.rotation.x += 0.1;
        cube.rotation.y += 0.1;
    }
    
    self.onResize = function()
    {
        self.renderer.setSize( window.innerWidth, window.innerHeight );
    }
    
    self.render = function()
    {
        self.update();
        requestAnimationFrame( self.render );
        self.renderer.render( self.scene, self.camera );
    }
    
    // Initialization
    document.getElementById("game").appendChild( self.canvas );
    self.onResize();
    
    // Cube time !
    var geometry = new THREE.BoxGeometry( 1, 1, 1 );
    var material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
    var cube = new THREE.Mesh( geometry, material );
    self.scene.add( cube );

    self.camera.position.z = 5;
    
    self.render();
}