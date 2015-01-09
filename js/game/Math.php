/**********************
        Math
        
        Mathematics functions
***********************************/

function segmentIntersect(x1, y1, x2, y2, x3, y3, x4, y4)
{
    // Thanks to Alexander Hristov
    // http://www.ahristov.com/tutorial/geometry-games/intersection-segments.html
    
    var d = (x1-x2)*(y3-y4) - (y1-y2)*(x3-x4);
    if (d == 0) return null;
    
    var xi = ((x3-x4)*(x1*y2-y1*x2)-(x1-x2)*(x3*y4-y3*x4))/d;
    var yi = ((y3-y4)*(x1*y2-y1*x2)-(y1-y2)*(x3*y4-y3*x4))/d;
    
    if (xi < Math.min(x1,x2) || xi > Math.max(x1,x2)) return null;
    if (xi < Math.min(x3,x4) || xi > Math.max(x3,x4)) return null;
    
    return [xi, yi];
}

collisionLineSegment = function (pt1, pt2, pt3, pt4) 
{ 
    var pt1_pt2 = new THREE.Vector2(pt2.x - pt1.x, pt2.y - pt1.y);
    var pt1_pt4 = new THREE.Vector2(pt4.x - pt1.x, pt4.y - pt1.y);
    var pt1_pt3 = new THREE.Vector2(pt3.x - pt1.x, pt3.y - pt1.y);

    if (  (pt1_pt2.x * pt1_pt4.y - pt1_pt2.y * pt1_pt4.x) 
      * (pt1_pt2.x * pt1_pt3.y - pt1_pt3.y * pt1_pt3.x) < 0) 
        return true; 

    return false; 
}

collisionSegmentSegment = function(pt1, pt2, pt3, pt4) 
{ 
  if (collisionLineSegment(pt1, pt2, pt3, pt4)  == false) 
     return false;  // inutile d'aller plus loin si le segment [OP] ne touche pas la droite (AB) 
  if (collisionLineSegment(pt3, pt4, pt1, pt2) == false) 
     return false;

    return true; 
}