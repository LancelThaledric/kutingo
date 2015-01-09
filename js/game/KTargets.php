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
        self.rotationSpeed = Math.PI / 128;
        self.direction = -rad;
        self.speed = 1;

        
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
        
        self.rotation += self.rotationSpeed;
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
        //console.log("distance = " + p.distanceTo(pos)+ ", L = " + L);
        
        var v1, v2;
        var v1_v2 = new THREE.Vector2(0, 0), v1_p = new THREE.Vector2(0, 0);
        var det;

        var vertices = new Array();
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI / 4 + self.rotation) + self.position.x,
            L * Math.sin(Math.PI / 4 + self.rotation) + self.position.y));
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI * 3 / 4 + self.rotation) + self.position.x,
            L * Math.sin(Math.PI * 3 / 4 + self.rotation) + self.position.y));
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI * 5 / 4 + self.rotation) + self.position.x,
            L * Math.sin(Math.PI * 5 / 4 + self.rotation) + self.position.y));
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI * 7 / 4 + self.rotation) + self.position.x,
            L * Math.sin(Math.PI * 7 / 4 + self.rotation) + self.position.y));
       
        for(var i = 0; i < vertices.length; i++)
        {
            v1 = vertices[i];

            if (!(i < vertices.length - 1))
                v2 = vertices[0];
            else
                v2 = vertices[i+1];

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
            Math.cos(line.orientation + Math.PI/2) * line.size / 2,
            Math.sin(line.orientation + Math.PI/2) * line.size / 2);
        end2 = new THREE.Vector2(
            Math.cos(line.orientation - Math.PI/2) * line.size / 2,
            Math.sin(line.orientation - Math.PI/2) * line.size / 2);
         
        console.log("end1 : x = " + end1.x + ", y = " + end1.y);
        console.log("end2 : x = " + end2.x + ", y = " + end2.y);
        
        if(c.distanceTo(pos) > line.size + L)
        {
            return false;   
        }
        console.log("distance = " + c.distanceTo(pos)+ ", L + r = " + (L + line.size));
         
        var vertices = new Array();
        var intersect;
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI / 4 + self.rotation) + self.position.x,
            L * Math.sin(Math.PI / 4 + self.rotation) + self.position.y));
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI * 3 / 4 + self.rotation) + self.position.x,
            L * Math.sin(Math.PI * 3 / 4 + self.rotation) + self.position.y));
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI * 5 / 4 + self.rotation) + self.position.x,
            L * Math.sin(Math.PI * 5 / 4 + self.rotation) + self.position.y));
        
        vertices.push(new THREE.Vector2(
            L * Math.cos(Math.PI * 7 / 4 + self.rotation) + self.position.x,
            L * Math.sin(Math.PI * 7 / 4 + self.rotation) + self.position.y));
       
        console.log("end1 : x = " + end1.x + ", y = " + end1.y);
        console.log("end2 : x = " + end2.x + ", y = " + end2.y);
        for(var i = 0; i < vertices.length; i++)
        {
            v1 = vertices[i];

            if (!(i < vertices.length - 1))
                v2 = vertices[0];
            else
                v2 = vertices[i+1]; 
            
            console.log("v1 : x = " + v1.x + ", y = " + v1.y);
            console.log("v2 : x = " + v2.x + ", y = " + v2.y);
            console.log("v1_v2 : x = " + (v2.x - v1.x) + ", y = " + (v2.y - v1.y));
            console.log("norme v1_v2 = "    + (v2.x - v1.x) * (v2.x - v1.x) 
                                            + (v2.y - v1.y) * (v2.y - v1.y));
            console.log("------");
            
            if(collisionSegmentSegment(v1, v2, end1, end2))
            {
                return true;
            }
            
            /*
            intersect = segmentIntersect(v1.x, v1.y,
                                 v2.x, v2.y, 
                                 pos.x, pos.y, 
                                 c.x, c.y);
            
            if(intersect != null)
            {
                return true;    
            }
            */
    
        }
        console.log("------");
        console.log("------");
        
        return false;
    }
    
    self.init();
}