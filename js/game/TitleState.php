/**********************
        TitleState
        
        Title Screen, choose level
***********************************/

function TitleState(app){
    var self = this;
    
    
    // Members Vars ///////////////////////////////////////////////////////////////

    self.app;
    
    self.hasToPop = false;
    
    self.sphere;
    self.uniforms;
    self.attributes;
    
    self.TitleImg;
    self.TitlePlane;
    
    self.StartImg;
    self.StartPlane;
    
    self.starttime;
    self.time;
    
    self.noise = [];
    
    self.attributes = {

				size: {	type: 'f', value: [] },
				customColor: { type: 'c', value: [] }

			};

	self.uniforms = {

				amplitude: { type: "f", value: 1.0 },
				color:     { type: "c", value: new THREE.Color( 0xffffff ) },
				texture:   { type: "t", value: THREE.ImageUtils.loadTexture( "img/spark1.png" ) },

			};

    self.shaderMaterial = new THREE.ShaderMaterial( {

				uniforms:       self.uniforms,
				attributes:     self.attributes,
				vertexShader:   document.getElementById( 'vertexshader' ).textContent,
				fragmentShader: document.getElementById( 'fragmentshader' ).textContent,

				blending:       THREE.AdditiveBlending,
				depthTest:      false,
				transparent:    true

			});
    
    
    self.radius;
	self.geometry = new THREE.Geometry();
    
    // Constructor  ///////////////////////////////////////////////////////////////
    
    self.init = function(){
        
        self.app = app;
        
        self.radius = Math.sqrt(10000 + 10000*self.app.aspectRatio*self.app.aspectRatio);
        
        self.app.camera = new THREE.PerspectiveCamera( 40, self.app.aspectRatio, 1, 10000 );
        self.app.camera.position.z = 300;
        
        
        for ( var i = 0; i < 100000; i ++ ) {

            var vertex = new THREE.Vector3();
            vertex.x = Math.random() * 2 - 1;
            vertex.y = Math.random() * 2 - 1;
            vertex.z = Math.random() * 2 - 1;
            vertex.multiplyScalar( self.radius );

            self.geometry.vertices.push( vertex );

        }
        
        self.sphere = new THREE.PointCloud( self.geometry, self.shaderMaterial );
        self.sphere.dynamic = true;
        //self.sphere.sortParticles = true;
        
        var vertices = self.sphere.geometry.vertices;
        var values_size = self.attributes.size.value;
        var values_color = self.attributes.customColor.value;
        
        for ( var v = 0; v < vertices.length; v++ ) 
        {
            values_size[ v ] = 10;
            values_color[ v ] = new THREE.Color( 0xffaa00 );

            if ( vertices[ v ].x < 0 )
                values_color[ v ].setHSL( 0.5 + 0.1 * ( v / vertices.length ), 0.7, 0.5 );
            else
                values_color[ v ].setHSL( 0.0 + 0.1 * ( v / vertices.length ), 0.9, 0.5 );

        }
        
        self.app.scene.add( self.sphere );
        
        
        
        
        
        self.TitleImg = new THREE.MeshLambertMaterial({
            map:THREE.ImageUtils.loadTexture('img/Kutingo.png'),
            transparent : true,
            opacity : 0
        });
        // plane
        self.TitlePlane = new THREE.Mesh(new THREE.PlaneGeometry(2012, 704),self.TitleImg);
        self.TitlePlane.overdraw = true;
        self.TitlePlane.position.set(0,0,290);
        self.TitlePlane.scale.set(0.004,0.004,0.004);
        self.app.scene.add(self.TitlePlane);
        
        
        
        
        
        
        
        self.StartImg = new THREE.MeshLambertMaterial({
            map:THREE.ImageUtils.loadTexture('img/start.png'),
            transparent : true,
            opacity : 0
        });
        // plane
        self.StartPlane = new THREE.Mesh(new THREE.PlaneGeometry(1597, 275),self.StartImg);
        self.StartPlane.overdraw = true;
        self.StartPlane.position.set(0,-2,290);
        self.StartPlane.scale.set(0.004,0.004,0.004);
        self.app.scene.add(self.StartPlane);
        
        
        
        
        
        if(!self.app.jinglePlayed)
        {
            self.app.soundmanager.sfx_jingle.play();
            self.app.jinglePlayed = true;
        }
        
        self.starttime = self.app.clock.elapsedTime;
    }
    
    // Methods     ///////////////////////////////////////////////////////////////
    
    self.handleEvents = function()
    {
        if(self.app.eventHandler.spaceKey)
        {
            self.app.eventHandler.spaceKey = false;
            self.hasToPop = true;
            self.app.states.push(new PlayState(self.app));
        }
    }
    
    self.update = function()
    {
        self.time = self.app.clock.elapsedTime - self.starttime;
        var time = Date.now() * 0.005;

        self.sphere.rotation.z = 0.01 * time;

        for( var i = 0; i < self.attributes.size.value.length; i++ ) {

            self.attributes.size.value[ i ] = 14 + 13 * Math.sin( 0.1 * i + time );


        }
        
        self.TitleImg.opacity = Math.min(1, Math.pow(self.time/2, 10));
        self.TitleImg.needsUpdate = true;
        
        self.StartImg.opacity = Math.min(1, Math.pow(self.time/2-1, 10));
        self.StartImg.needsUpdate = true;

        self.attributes.size.needsUpdate = true;
        
    }
    
    self.draw = function()
    {
        
    }
    
    self.onDestroy = function()
    {
        self.app.scene.remove(self.sphere);
        self.app.scene.remove(self.TitlePlane);
        self.app.scene.remove(self.StartPlane);
        self.app.soundmanager.sfx_jingle.stop();
    }
    
    // YEAH MAN !!! //////////////////////////////////////////////////////////////
    self.init();
}