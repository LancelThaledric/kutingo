/**********************
        KPatternBuilder 
        
        List of all patterns of Kutingo
***********************************/

var Pattern_CrossBullet = function(){
    
    this.setPattern = function(pat)
    {
        pat.duration = 2;
        pat.data = new Array(pat.duration * pat.patternDivider);
        pat.data[0] = new KPatternElement();
        pat.data[0].bullets.push(
            new KBulletSpawner(pat.app, pat.parentstate, 0, 0, 1),
            new KBulletSpawner(pat.app, pat.parentstate, Math.PI, 0, 1),
            new KBulletSpawner(pat.app, pat.parentstate, Math.PI/2, 0, 1),
            new KBulletSpawner(pat.app, pat.parentstate, -Math.PI/2, 0, 1)
        );
        return pat;
    }
};


var Pattern_CrossBulletDiag = function(){

    this.setPattern = function(pat)
    {
        pat.duration = 2;
        pat.data = new Array(pat.duration * pat.patternDivider);
        pat.data[0] = new KPatternElement();
        pat.data[0].bullets.push(
            new KBulletSpawner(pat.app, pat.parentstate,   Math.PI/4, 0, 1),
            new KBulletSpawner(pat.app, pat.parentstate, 5*Math.PI/4, 0, 1),
            new KBulletSpawner(pat.app, pat.parentstate, 3*Math.PI/4, 0, 1),
            new KBulletSpawner(pat.app, pat.parentstate, 7*Math.PI/4, 0, 1)
        );
        return pat;
    }
}

var Pattern_RandomLittleBulletRafale = function(){

    this.setPattern = function(pat)
    {
        pat.duration = 2;
        pat.data = new Array(pat.duration * pat.patternDivider);
        var dir = Math.random() * Math.PI *2;
        for(var i=0; i<pat.data.length ; i+=pat.patternDivider/2)
        {
            pat.data[i] = new KPatternElement();
            pat.data[i].bullets.push(
                new KBulletSpawner(pat.app, pat.parentstate,   dir, 0, 2)
            );
        }
        return pat;
    }
}

var Pattern_RandomTwoSidedBulletRafale = function(){

    this.setPattern = function(pat)
    {
        pat.duration = 2;
        pat.data = new Array(pat.duration * pat.patternDivider);
        var dir = Math.random() * Math.PI *2;
        for(var i=0; i<pat.data.length ; i+=pat.patternDivider/2)
        {
            pat.data[i] = new KPatternElement();
            pat.data[i].bullets.push(
                new KBulletSpawner(pat.app, pat.parentstate,   dir, 0, 2),
                new KBulletSpawner(pat.app, pat.parentstate,   dir+Math.PI, 0, 2)
            );
        }
        return pat;
    }
}


var Pattern_RandomBulletShrapnel = function(){

    this.setPattern = function(pat)
    {
        pat.duration = 1;
        pat.data = new Array(pat.duration * pat.patternDivider);
        var dir = Math.random() * Math.PI *2;
        
        pat.data[0] = new KPatternElement();
            
        for(var i=0 ; i<10 ; ++i)
            pat.data[0].bullets.push(new KBulletSpawner(pat.app, pat.parentstate,   dir, Math.random()*20-10, 2));
        return pat;
    }
}



var Pattern_BulletFan = function(){
    this.setPattern = function(pat)
    {
        pat.duration = 4;
        pat.data = new Array(pat.duration * pat.patternDivider);

        for(var i=0; i<pat.data.length ; i++)
        {
            pat.data[i] = new KPatternElement();
            pat.data[i].bullets.push(
                new KBulletSpawner(pat.app, pat.parentstate,   i*Math.PI/pat.data.length*4, 0, 2)
            );
        }
        return pat;
    }
}










var Pattern_RandomTargetRafale = function(){

    this.setPattern = function(pat)
    {
        pat.duration = 2;
        pat.data = new Array(pat.duration * pat.patternDivider);
        var dir = Math.random() * Math.PI *2;
        var size = Math.random() * 10 + 10;
        var off = Math.random() * 4 - 2;
        var speed = Math.random() * 0.2 + 0.2;
        for(var i=0; i<pat.data.length ; i+=pat.patternDivider/2)
        {
            pat.data[i] = new KPatternElement();
            pat.data[i].targets.push(
                new KTargetSpawner(pat.app, pat.parentstate,   dir, off, speed, size)
            );
        }
        return pat;
    }
}



var Pattern_RandomTwoSidedTargetRafale = function(){

    this.setPattern = function(pat)
    {
        pat.duration = 2;
        pat.data = new Array(pat.duration * pat.patternDivider);
        var dir = Math.random() * Math.PI *2;
        var size = Math.random() * 10 + 10;
        var off = Math.random() * 40 - 20;
        var speed = Math.random() * 0.2 + 0.2;
        for(var i=0; i<pat.data.length ; i+=pat.patternDivider/2)
        {
            pat.data[i] = new KPatternElement();
            pat.data[i].targets.push(
                new KTargetSpawner(pat.app, pat.parentstate,   dir, off, speed, size),
                new KTargetSpawner(pat.app, pat.parentstate,   dir+Math.PI, off, speed, size)
            );
        }
        return pat;
    }
}



var Pattern_RandomTwoSidedLittleRapidTargetRafale = function(){

    this.setPattern = function(pat)
    {
        pat.duration = 2;
        pat.data = new Array(pat.duration * pat.patternDivider);
        var dir = Math.random() * Math.PI *2;
        var size = Math.random() * 4 + 8;
        var off = Math.random() * 5 + 10;
        var speed = 1;
        for(var i=0; i<pat.data.length ; i+=4)
        {
            pat.data[i] = new KPatternElement();
            pat.data[i].targets.push(
                new KTargetSpawner(pat.app, pat.parentstate,   dir, off, speed, size),
                new KTargetSpawner(pat.app, pat.parentstate,   dir+Math.PI, off, speed, size)
            );
        }
        return pat;
    }
}


var Pattern_TargetSoloRandom = function(){
    this.setPattern = function(pat)
    {
        pat.duration = 1;
        pat.data = new Array(pat.duration * pat.patternDivider);

        pat.data[0] = new KPatternElement();
        
        pat.data[0].targets[0] =
            new KTargetSpawner(pat.app, pat.parentstate,
                               Math.random()*Math.PI*2,
                               Math.random()*20-10,
                               0.2,
                               40);
    
        return pat;
    }
}




/*

var Pattern_TargetDiagFan = function(){
    this.setPattern = function(pat)
    {
        pat.duration = 4;
        pat.data = new Array(pat.duration * pat.patternDivider);

        for(var i=0; i<pat.duration ; i++)
        {
            pat.data[i*pat.patternDivider] = new KPatternElement();
            pat.data[i*pat.patternDivider].targets.push(
                new KTargetSpawner(pat.app, pat.parentstate,   (2*i+1)*Math.PI/4, 20, 0.4, 10)
            );
        }
        return pat;
    }
}

var Pattern_TargetSoloRandom = function(){
    this.setPattern = function(pat)
    {
        pat.duration = 16;
        pat.data = new Array(pat.duration * pat.patternDivider);

        pat.data[0] = new KPatternElement();
        
        pat.data[0].targets[0] =
            new KTargetSpawner(pat.app, pat.parentstate,
                               Math.random()*Math.PI*2,
                               Math.random()*20-10,
                               0.2,
                               40);
    
        return pat;
    }
}



var Pattern_SoloBulletLeft = function(){
    
    this.setPattern = function(pat)
    {
        pat.duration = 2;
        pat.data = new Array(pat.duration * pat.patternDivider);
        pat.data[0] = new KPatternElement();
        pat.data[0].bullets.push(
            new KBulletSpawner(pat.app, pat.parentstate, Math.PI/2, 0, 1)
        );
        return pat;
    }
};*/
