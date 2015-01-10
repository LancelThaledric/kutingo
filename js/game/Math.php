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

function collisionLineSegment(pt1, pt2, pt3, pt4) 
{ 
    var pt1_pt2 = new THREE.Vector2(pt2.x - pt1.x, pt2.y - pt1.y);
    var pt1_pt4 = new THREE.Vector2(pt4.x - pt1.x, pt4.y - pt1.y);
    var pt1_pt3 = new THREE.Vector2(pt3.x - pt1.x, pt3.y - pt1.y);

    if (  (pt1_pt2.x * pt1_pt4.y - pt1_pt2.y * pt1_pt4.x) 
      * (pt1_pt2.x * pt1_pt3.y - pt1_pt3.y * pt1_pt3.x) < 0) 
        return true; 

    return false; 
}

function collisionSegmentSegment(pt1, pt2, pt3, pt4) 
{ 
  if (collisionLineSegment(pt1, pt2, pt3, pt4)  == false) 
     return false;  // inutile d'aller plus loin si le segment [OP] ne touche pas la droite (AB) 
  if (collisionLineSegment(pt3, pt4, pt1, pt2) == false) 
     return false;

    return true; 
}

function CollisionPointCircle(A,C,r)
{
   var d2 = (A[0]-C[0])*(A[0]-C[0]) + (A[1]-C[1])*(A[1]-C[1]);
   if (d2>r*r)
      return false;
   else
      return true;
}

function CollisionCircleLine(A,B,C,r)     // A, B, C are arrays of [x, y]. C is circle-center. r is radius.
{
   var u = [];
   u[0] = B[0] - A[0];
   u[1] = B[1] - A[1];
   var AC = [];
   AC[0] = C[0] - A[0];
   AC[1] = C[1] - A[1];
   var numerateur = u[0]*AC[1] - u[1]*AC[0];   // prd vectoriel du vecteur u et AC
   if (numerateur <0)
      numerateur = -numerateur ;   // valeur absolue ; si c'est négatif, on prend l'opposé.
   var denominateur = Math.sqrt(u[0]*u[0] + u[1]*u[1]);  // norme de u
   var CI = numerateur / denominateur;
   if (CI<r)
      return true;
   else
      return false;
}

function CollisionCircleSegment(A,B,C,r)// A, B, C are arrays of [x, y]. C is circle-center. r is radius.
{
   if (CollisionCircleLine(A,B,C,r) == false)
     return false;  // si on ne touche pas la droite, on ne touchera jamais le segment
   var AB = [], AC = [], BC = [];
   AB[0] = B[0] - A[0];
   AB[1] = B[1] - A[1];
   AC[0] = C[0] - A[0];
   AC[1] = C[1] - A[1];
   BC[0] = C[0] - B[0];
   BC[1] = C[1] - B[1];
   var pscal1 = AB[0]*AC[0] + AB[1]*AC[1];  // produit scalaire
   var pscal2 = (-AB[0])*BC[0] + (-AB[1])*BC[1];  // produit scalaire
   if (pscal1>=0 && pscal2>=0)
      return true;   // I entre A et B, ok.
   // dernière possibilité, A ou B dans le cercle
   if (CollisionPointCircle(A,C,r))
     return true;
   if (CollisionPointCircle(B,C,r))
     return true;
   return false;
}