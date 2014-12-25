/**********************
        EventHandler
        
        Checker for events
***********************************/

function EventHandler(app){
    var self = this;
    
    // Members Vars ///////////////////////////////////////////////////////////////
    
    self.app = app;
    
    self.leftKey;
    self.rightKey;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function()
    {
        self.leftKey = false;
        self.rightKey = false;
        
        $(window).keydown(self.onKeyDown);
        $(window).keyup(self.onKeyUp);
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.onKeyDown = function(event)
    {
        switch(event.which)
        {
            case 37:    // LEFT ARROW
                self.leftKey = true;
                break;
            case 39:    // RIGHT ARROW
                self.rightKey = true;
                break;
        }
    }
    
    self.onKeyUp = function(event)
    {        
        switch(event.which)
        {
            case 37:    // LEFT ARROW
                self.leftKey = false;
                break;
            case 39:    // RIGHT ARROW
                self.rightKey = false;
                break;
        }
    }
    
    // Lauche Time !    //////////////////////////////////////////////////////////
    self.init();
    
}