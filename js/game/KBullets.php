/**********************
        KBullets
        
        Bullet Manager of the level
***********************************/


function KBullets(app){
    var self = this;
    
    // Members Vars ///////////////////////////////////////////////////////////////

    self.app;
    
    // Logic
    
    self.positions;
    self.positionstm1;
    self.directions;
    self.speeds;
    self.hasBounced;
    
    // Display
    
    self.particles;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        self.app = app;
        
        var nb = 10;
        
        var geombuf = new THREE.BufferGeometry();
        self.positions = new Float32Array(nb*3);
        self.positionstm1 = new Float32Array(nb*3);     // pos at t-1
        self.directions = [];
        self.speeds = [];
        self.hasBounced = [];
        
        var rad;
        var off;
        
        for ( var i = 0, is3 = 0 ; i < self.positions.length; i += 3, is3++ )
        {
            
            //rad = Math.random()*Math.PI*2;
            rad = Math.PI / 2;
            off = Math.random()*40-20;
            //off = 0;
            self.positions[i] = Math.cos(rad) * 20 * self.app.aspectRatio * Math.SQRT2;
            self.positions[i+1] = Math.sin(rad) * 20 * self.app.aspectRatio * Math.SQRT2;
            self.positions[i+2] = 0;
            
            self.directions[is3] = -rad;
            self.speeds[is3] = 1;
            self.hasBounced[is3] = false;
            self.positions[i] += off * Math.cos(rad + Math.PI/2);
            self.positions[i+1] += off * Math.sin(rad + Math.PI/2);
        }
        geombuf.addAttribute( 'position', new THREE.BufferAttribute( self.positions, 3 ) );
        
        var material = new THREE.PointCloudMaterial(
            {size:4, sizeAttenuation:false}
        );
        material.color.set(0x00FFFF);
        
        self.particles = new THREE.PointCloud(geombuf, material);
        self.particles.sortParticles = true;
        self.app.scene.add(self.particles);
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.handleEvents = function()
    {
        // Nothing ?
    }
    
    self.update = function()
    {
        for ( var i = 0, is3 = 0 ; i < self.positions.length; i += 3, is3++ )
        {
            self.positionstm1[i] = self.positions[i];
            self.positionstm1[i+1] = self.positions[i+1];
            
            self.positions[i] -= Math.cos(self.directions[is3]) * self.speeds[is3];
            self.positions[i+1] += Math.sin(self.directions[is3]) * self.speeds[is3];
            
        }
        self.particles.geometry.addAttribute( 'position', new THREE.BufferAttribute( self.positions, 3 ) );
    }
    
    self.draw = function()
    {

    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}