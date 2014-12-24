/**********************
        TitleState
        
        Title Screen, choose level
***********************************/

function TitleState(st){
    var self = this;
    self.parent = st;
    
    // Members Vars ///////////////////////////////////////////////////////////////

    self.app;
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        self.app = st.app;
        
        // Cube time !      // TEMPORARY
        self.geometry = new THREE.BoxGeometry( 1, 1, 1 );
        self.material = new THREE.MeshBasicMaterial( { color: 0x882255 } );
        self.cube = new THREE.Mesh( self.geometry, self.material );
        self.app.scene.add( self.cube );
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