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

var Pattern_LeftBulletRafale = function(){
    
    this.setPattern = function(pat)
    {
        pat.duration = 4;
        pat.data = new Array(pat.duration * pat.patternDivider);

        for(var i=0; i<pat.data.length ; i+=2)
        {
            pat.data[i] = new KPatternElement();
            pat.data[i].bullets.push(
                new KBulletSpawner(pat.app, pat.parentstate,   Math.PI, 0, 2)
            );
        }
        return pat;
    }
}




var Pattern_RightBulletRafale = function(){
    
    this.setPattern = function(pat)
    {
        pat.duration = 4;
        pat.data = new Array(pat.duration * pat.patternDivider);

        for(var i=0; i<pat.data.length ; i+=2)
        {
            pat.data[i] = new KPatternElement();
            pat.data[i].bullets.push(
                new KBulletSpawner(pat.app, pat.parentstate,   0, 0, 2)
            );
        }
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
        pat.duration = 2;
        pat.data = new Array(pat.duration * pat.patternDivider);

        pat.data[0] = new KPatternElement();
        
        pat.data[0].targets[0] =
            new KTargetSpawner(pat.app, pat.parentstate,
                               Math.random()*Math.PI*2,
                               Math.random()*20-10,
                               0.4,
                               10);
    
        return pat;
    }
};