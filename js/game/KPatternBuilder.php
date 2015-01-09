/**********************
        KPatternBuilder 
        
        List of all patterns of Kutingo
***********************************/

function Pattern_CrossBullet(pat)
{
    pat.duration = 4;
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

function Pattern_CrossBulletDiag(pat)
{
    pat.duration = 4;
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