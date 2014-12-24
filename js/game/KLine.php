/**********************
        KLine
        
        Line that is controlled by the player
***********************************/

function KLine(){
    var self = this;
    
    // Members Vars ///////////////////////////////////////////////////////////////

    
    // Logic
    self.size;
    self.orientation;
    self.speed;
    self.color;
    
    // Display
    self.disp_line;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        self.size = 5;
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.handleEvents = function()
    {
        
    }
    
    self.update = function()
    {
        // TEMPORARY
        self.cube.rotation.x += 0.1;
        self.cube.rotation.y += 0.1;
    }
    
    self.draw = function()
    {
        
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}