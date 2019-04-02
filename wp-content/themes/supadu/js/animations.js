$(function() {
    $('.site-content').animate({ 
        opacity: 1,
        marginLeft: "+=3vw",
    }, 1800 );
    $('.entry-title').animate({ 
        marginLeft: "-=20vw",
    }, 1800 );
    $('.sp__the-author').animate({ 
        marginTop: "+=40vh",
    }, 1800 );
    $('.sp__the-format').animate({ 
        marginTop: "+=43vh",
    }, 1800 );
    $('.sp__the-imprint').animate({ 
        marginTop: "+=46vh",
    }, 1800 );
    $('.sp__the-publication-date').animate({ 
        marginTop: "+=49vh",
    }, 1800 );
    $('.sp__the-description').animate({ 
        opacity: 1,
    }, 1800 );
    $('.sp__the-isbn13').animate({ 
        marginTop: "+=52vh",
    }, 1800 );
    $('.sp__the-pages').animate({ 
        marginTop: "+=55vh",
    }, 1800 );
    $('.svg-slide').animate({ 
        marginLeft: "+=10vw",
    }, 1800 );
});

/*fade in content / article on load*/

/*$(function() {
    api( 'background_image', function( value ) {
    value.bind( function( to ) {
        $( 'body' ).toggleClass( 'custom-background-image', '' !== to );
    } );
} );
});*/

   /* Click 1 
   $(".click-1").click(function() {
    var clicks = $(this).data("clicks");
    if (clicks) {
    $('.site-content').animate({ 
        marginTop: "-=5vh;",
    }, 900 );

    } else {  
    
    $('.site-content').animate({ 
        marginTop: "-=5vh",
    }, 900 ); }

    $(this).data("clicks", !clicks);
    });*/

