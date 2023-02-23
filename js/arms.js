$( document ).ready(function() {

    
    $( "#admin_areasxx" ).submit(function( event ) {
        //event.preventDefault();
        $.ajax({
            type: 'POST',
            url: "admin.php?m=areas", 
            success: function(result){
                
            }
        });
    });


});

