/**********************
        KBTargets
        
        Target Manager of the level
***********************************/

function KTarget(app){
    var self = this;
    
    // Members Vars ///////////////////////////////////////////////////////////////
    
    self.app;
    
    // Logic
    
    self.position;
    self.rotation;
    self.direction;
    self.speed;
    self.size;
    self.geometry;
    
    // Display
    
    self.material;
    self.disp_target;
    
    // Constructor ////////////////////////////////////////////////////////////////
    
    self.init = function(){
        self.app = app;
        
        //var rad = Math.random()*Math.PI*2;
        //var rad = Math.PI / 2;
        var rad = Math.random() * Math.PI*2;
        var off = Math.random() * 40-20;
        var dist = 20;
        
        var x, y, z;
        x = Math.cos(rad) * dist * self.app.aspectRatio * Math.SQRT2 
            + off * Math.cos(rad + Math.PI/2);
        y = Math.sin(rad) * dist * self.app.aspectRatio * Math.SQRT2
            + off * Math.sin(rad + Math.PI/2);
        z = 10;
        
        self.position = new THREE.Vector3(x, y, z);
        self.rotation = 0;
        self.direction = -rad;
        self.speed = 1;
        
        self.size = 5;
        self.geometry = new THREE.BoxGeometry( self.size, self.size, self.size);
        self.material = new THREE.MeshBasicMaterial( {color: 0x000000} );
        
        self.disp_target = new THREE.Mesh(self.geometry, self.material); 
        self.app.scene.add(self.disp_target);
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.handleEvents = function()
    {
        // Nothing ?
    }
    
    self.update = function()
    {        
        self.position.x -= Math.cos(self.direction) * self.speed;
        self.position.y += Math.sin(self.direction) * self.speed;
    }
    
    self.draw = function()
    {
        self.disp_target.position.x = self.position.x;
        self.disp_target.position.y = self.position.y;
        self.disp_target.rotation.z = self.rotation;
    }
    
    self.init();
}