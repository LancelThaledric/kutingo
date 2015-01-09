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
    self.direction;
    self.speed;
    self.size;
    self.geometry;
    self.dist;
    
    // Display
    
    self.material;
    self.disp_target;
    
    // Constructor ////////////////////////////////////////////////////////////////
    
    self.init = function(){
        self.app = app;
        self.parentstate = parentstate;
        
        self.dist = 70;
        
        self.position = new THREE.Vector3(0, 0, 10);
        self.rotation = 0;
        self.direction = 0;
        self.speed = 0;
        self.size = 0;
        
        self.geometry = new THREE.BoxGeometry( 1, 1, 1);
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
        self.disp_target.scale.set(self.size, self.size, self.size);
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
        console.log("distance = " + p.distanceTo(pos)+ ", L = " + L);
        
        var v1, v2;
        var v1_v2 = new THREE.Vector2(0, 0), v1_p = new THREE.Vector2(0, 0);
        var det;

        var vertices = new Array();
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI / 4 + self.rotation) + self.position.x,
            L * Math.cos(Math.PI / 4 + self.rotation) + self.position.y));
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI * 3 / 4 + self.rotation) + self.position.x,
            L * Math.cos(Math.PI * 3 / 4 + self.rotation) + self.position.y));
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI * 5 / 4 + self.rotation) + self.position.x,
            L * Math.cos(Math.PI * 5 / 4 + self.rotation) + self.position.y));
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI * 7 / 4 + self.rotation) + self.position.x,
            L * Math.cos(Math.PI * 7 / 4 + self.rotation) + self.position.y));
       
        for(var i = 0; i < vertices.length; i++)
        {
            v1 = vertices[i];

            if (!(i < vertices.length - 1))
                v2 = vertices[0];
            else
                v2 = vertices[i+1];

            v1_v2.x = v2.x - v1.x;
            v1_v2.y = v2.y - v1.y;
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
        
        if(c.distanceTo(pos) > line.size - L)
        {
            return false;   
        }
        console.log("distance = " + c.distanceTo(pos)+ ", L + r = " + (L+ line.size));
        
        var vertices = new Array();
        var intersect;
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI / 4 + self.rotation) + self.position.x,
            L * Math.cos(Math.PI / 4 + self.rotation) + self.position.y));
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI * 3 / 4 + self.rotation) + self.position.x,
            L * Math.cos(Math.PI * 3 / 4 + self.rotation) + self.position.y));
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI * 5 / 4 + self.rotation) + self.position.x,
            L * Math.cos(Math.PI * 5 / 4 + self.rotation) + self.position.y));
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI * 7 / 4 + self.rotation) + self.position.x,
            L * Math.cos(Math.PI * 7 / 4 + self.rotation) + self.position.y));
       
        for(var i = 0; i < vertices.length; i++)
        {
            v1 = vertices[i];

            if (!(i < vertices.length - 1))
                v2 = vertices[0];
            else
                v2 = vertices[i+1]; 
            
            intersect = segmentIntersect(v1.x, v1.y,
                                 v2.x, v2.y, 
                                 pos.x, pos.y, 
                                 c.x, c.y);
            
            if(intersect != null)
            {
                return true;    
            }
    
        }
        return false;
    }
    
    self.init();
}