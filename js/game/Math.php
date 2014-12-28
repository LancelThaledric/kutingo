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