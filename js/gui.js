/*
    gui.js
    Make the GUI out-game (website) userfriendly !
*/

$(document).ready(
function() {
    
    // KUTINGO Motherfucker !!
    var app = new Kutingo();
    
    // Header
    var header = $('.main-header');
    
    
    // Overlap
    
    var mainWrapper = $('.main-wrapper');
    var undergame = $('.undergame');
    var scrollIndicator = $('.scroll-indicator');
    var outspread_class = 'outspread';
    var outspread_duration = 500;
    var outspread_timeout;
    var animationDone_class = 'slideDown-done'
    var hasmenus_class = 'hasmenus';
    
    var o = true;
    
    
    function hideOverlap(){
        scrollIndicator.removeClass(animationDone_class);
        clearTimeout(outspread_timeout);
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
        outspread_timeout = setTimeout(
            function(){
                scrollIndicator.addClass(animationDone_class);
            }
            , outspread_duration
        );
    }
    
    // Events Overlap
    
    
    $(window).on('mousewheel',
    function(event){
        
        if(app.focus) return false;
        
        if(event.deltaY < 0)
        {
            // Scroll Down
            showOverlap();
        }
        else if(undergame.scrollTop() <= 0)
        {
            hideOverlap();
        }
        
    }
    );
    
    $('.game').click(
    function(){
        app.focus = !app.focus;
        o = !o;
        if(o) mainWrapper.addClass(hasmenus_class);
        else mainWrapper.removeClass(hasmenus_class);
    }
    );
    
    $(window).resize(
    function(){
        app.onResize();
    });
    
}
);