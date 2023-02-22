
$(document).ready(function()
{
    if ($("#"+id)) {
        $("#"+id).click();
    }

    $.each( tree_list, function( key, value ) {
        var id = value['id'];
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

    
});