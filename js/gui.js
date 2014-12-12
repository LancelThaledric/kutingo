/*
    gui.js
    Make the GUI out-game (website) userfriendly !
*/

$(document).ready(
function(){
    // Overlap
    
    var mainWrapper = $('.main-wrapper');
    var undergame = $('.undergame');
    var outspread_class = 'outspread';
    var outspread_duration = 500;
    var outspread_timeout;
    var animationDone_class = 'slideDown-done'
    
    var o = false;
    
    
    function hideOverlap(){
        outspread_timeout = setTimeout(
            function(){
                undergame.addClass(animationDone_class);
            }
            , outspread_duration
        );
        
        
        mainWrapper.removeClass(outspread_class);
    }
    
    function showOverlap(){
        undergame.removeClass(animationDone_class);
        mainWrapper.addClass(outspread_class);
        clearTimeout(outspread_timeout);
    }
    
    $(document).click(
    function(){
        o = !o;
        if(o) showOverlap();
        else hideOverlap();
    }
    );
    
}
);