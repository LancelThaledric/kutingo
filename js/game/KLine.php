/**********************
        KLine
        
        Line that is controlled by the player
***********************************/

function KLine(app){
    var self = this;
    
    // Members Vars ///////////////////////////////////////////////////////////////

    self.app;
    
    // Logic
    self.size;          // Lenght of the line
    self.orientation;   // Rotaztion in radians. 0 is horizontal.
    self.speed;         // Speed of rotation in radian per second
    self.color;         // Color of the line
    self.thickness;     // Thickness of the line;
    
    // Display
    self.disp_line;     // THREE.js Line scene element
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        self.app = app;
        
        self.size = 20;
        self.orientation = 0;
        self.speed = 5.2;
        self.color = 0xFFFFFF;
        self.thickness = 4;
        
        // Displine
        var geometry = new THREE.Geometry();
        geometry.vertices.push(
            new THREE.Vector3(-1, 0, 0),
            new THREE.Vector3(1, 0, 0)
        );
        var material = new THREE.LineBasicMaterial({
            color: self.color,
            linewidth : self.thickness
        });
        self.disp_line = new THREE.Line(geometry, material);
        self.app.scene.add(self.disp_line);
        
        self.draw();
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.handleEvents = function()
    {
        if(app.eventHandler.leftKey)
        {
            self.orientation += self.speed * app.deltaTime;
        }
        
        if(app.eventHandler.rightKey)
        {
            self.orientation -= self.speed * app.deltaTime;
        }
    }
    
    self.update = function()
    {
        // Nothing ?
    }
    
    self.draw = function()
    {
        // Update Displayed Line
        self.disp_line.scale.set(self.size, self.size, self.size);
        self.disp_line.rotation.z = self.orientation;
        //self.disp_line.material.color = self.color;
        //self.disp_line.material.linewidth = self.thickness;
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}