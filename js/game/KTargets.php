/**********************
        KBTargets
        
        Target Manager of the level
***********************************/

function KTarget(app, parentstate){
    var self = this;
    
    // Members Vars ///////////////////////////////////////////////////////////////
    
    self.app;
    self.parentstate;
    
    // Logic
    
    self.position;
    self.rotation;
    self.rotationSpeed;
    self.direction;
    self.speed;
    self.size;
    self.nb_vertices;
    self.vertices;
    
    self.geometry;
    self.dist;
    
    self.isHit;
    
    // Display
    
    self.material;
    self.disp_target;
    
    // Constructor ////////////////////////////////////////////////////////////////
    
    self.init = function(){
        self.app = app;
        self.parentstate = parentstate;
        
        self.dist = 80;
        
        self.position = new THREE.Vector3(0, 0, 10);
        self.rotation = 0;
        self.rotationSpeed = Math.PI / 128;
        self.direction = 0;
        self.speed = 0;
        self.size = 0;
        
        self.isHit = false;
        
        self.nb_vertices = 4;
        var L = self.size / (2 * Math.cos(Math.PI / self.nb_vertices));
        self.vertices = new Array();


        for(var i = 0; i < self.nb_vertices; i++)
        {
            self.vertices.push(new THREE.Vector2(
                Math.cos((2 * i + 1) * Math.PI / self.nb_vertices + self.rotation) * self.size 
                            + self.position.x,
                Math.sin((2 * i + 1) * Math.PI / self.nb_vertices + self.rotation) * self.size 
                            + self.position.y)); 
        }
        
        self.geometry = new THREE.BoxGeometry( 1, 1, 1);
        self.material = new THREE.MeshBasicMaterial( {color: 0x41dae9} );
        
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
        
        self.rotation += self.rotationSpeed;
        
        var L = self.size / (2 * Math.cos(Math.PI / self.nb_vertices));
        for(var i = 0; i < self.vertices.length; i++)
        {
            self.vertices[i].x = 
                L * Math.cos((2 * i + 1 ) * Math.PI / self.nb_vertices + self.rotation) 
                + self.position.x;
            self.vertices[i].y = 
                L * Math.sin((2 * i + 1 ) * Math.PI / self.nb_vertices + self.rotation) 
                + self.position.y;
        }
        
        self.material.color.offsetHSL(0.01, 0, 0);
    }
    
    self.draw = function()
    {
        self.disp_target.position.x = self.position.x;
        self.disp_target.position.y = self.position.y;
        self.disp_target.rotation.z = self.rotation;
        self.disp_target.scale.set(self.size, self.size, self.size);  
    }
    
    self.onDestroy = function()
    {
        self.app.scene.remove(self.disp_target);
    }
    
    self.containsPoint = function(point)
    {
        var L = self.size / (2 * Math.cos(Math.PI / 4));
        var p = new THREE.Vector2(point.x, point.y);
        var pos = new THREE.Vector2(self.position.x, 
                                    self.position.y);
        
        if(p.distanceTo(pos) > L)
        {
            return false;   
        }
        //console.log("distance = " + p.distanceTo(pos)+ ", L = " + L);
        
        var v1, v2;
        var v1_v2 = new THREE.Vector2(0, 0), v1_p = new THREE.Vector2(0, 0);
        var det;
       
        for(var i = 0; i < self.vertices.length; i++)
        {
            v1 = self.vertices[i];

            if (!(i < self.vertices.length - 1))
                v2 = self.vertices[0];
            else
                v2 = self.vertices[i+1];

            v1_p.set(p.x - v1.x, p.y - v1.y);
            v1_v2.set(v2.x - v1.x, v2.y - v1.y);
            det = v1_p.x * v1_p.y - v1_v2.y * v1_p.x;
            if (det < 0)
                return false;
        }
        return true;
    }
    
    self.intersectBar = function(line)
    {       
        
        var L = self.size / (2 * Math.cos(Math.PI / 4));
        var c = new THREE.Vector2(0, 0);
        var pos = new THREE.Vector2(self.position.x, 
                                    self.position.y);
        
        var v1, v2, end1, end2;
        end1 = new THREE.Vector2(
            Math.cos(line.orientation + Math.PI/2) * line.size / 2 + line.position,
            Math.sin(line.orientation + Math.PI/2) * line.size / 2 + line.position);
        end2 = new THREE.Vector2(
            Math.cos(line.orientation - Math.PI/2) * line.size / 2,
            Math.sin(line.orientation - Math.PI/2) * line.size / 2);
        
        if(c.distanceTo(pos) > line.size + L)
        {
            return false;   
        }
         
        for(var i = 0; i < self.vertices.length; i++)
        {
            v1 = self.vertices[i];

            if (!(i < self.vertices.length - 1))
                v2 = self.vertices[0];
            else
                v2 = self.vertices[i+1]; 
            
            if(collisionSegmentSegment(v1, v2, end1, end2))
            {
                return true;
            }
        }
        
        return false;
    }
    
    self.init();
}