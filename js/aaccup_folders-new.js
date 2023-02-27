var area_list = {};
var area_code = '';

$(document).ready(function()
{  
    if (area_code != '') {
        if ($('#area_'+area_code).length != 0) {
            $('#area_'+area_code).click();  
        }
    }

    // Indicators Tree
    $.each( tree_list, function( key, value ) {
        var id = value['id'];       
        $('#alert_msg_'+id).hide();
        $("#"+id).click(function(){
            var params = value;     
            $.ajax({
                url: "index.php?m=folders", 
                data: params,
                type: 'POST',
                success: function(resp){               
                    var folders = JSON.parse(resp);
                    $('#tree_'+id).bstreeview({
                        data: folders,
                        expandIcon: 'fa fa-angle-down fa-fw',
                        collapseIcon: 'fa fa-angle-right fa-fw',
                        indent: 1.25,
                        parentsMarginLeft: '1.25rem',
                        openNodeLinkOnNewTab: true
                    });
                    $('#spinner_'+id).hide();
                }
            });
        }); 
    });  

    
    /*
    $("#delete-file").on('click', function() {    
        var fpath = $(this).data('fpath');
        alert(fpath);
        $.ajax({
            url: "area.php?m=area", 
            data: {
                level_code: level_code,
                area_code: area_code
            },
            type: 'POST',
            success: function(resp){   
                $("#"+area_code+"-pane").html(resp);
            }
        });
    });
    */

});


function deleteFile()
{
    //alert('delete');
    //var fpath = $(this).data('fpath');
    //alert(fpath);
}
