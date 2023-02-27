var area_list = {};

$(document).ready(function()
{  
    // AREA Tab
    /*
    $(".area-tab").on('click', function() {    
        var level_code = $(this).data('level_code');
        var area_code = $(this).data('area_code');
        alert(area_code);
        if($("#"+area_code+"-upload").length == 0) {
            alert('does not exists');
        }
        /*
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

    /*
    // PROGRAM Tab
    $(".program-tab").click(function(){
        var level_code = $(this).data('level_code');
        var area_code = $(this).data('area_code');
        var program_code = $(this).data('program_code');
        $("#area-spinner").show();        
        $.ajax({
            url: "area.php?m=program", 
            data: {
                level_code: level_code,
                area_code: area_code,
                program_code: program_code
            },
            type: 'POST',
            success: function(resp){   
                var pane_id = area_code + '_' + program_code;
                $("#area-spinner").hide();        
                $("#"+pane_id+"-pane").html(resp);
            }
        });
    }); 
    */

    // Indicators Tree
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

    //var values=$(this).data('message');

    //console.log(area_list);
});

function checkUploadFields()
{
    if($("#upload_file").length == 0) {
        alert('does not exists');
    } else {
        alert('exists');
    }

}

function displayLevelTab(level_code)
{
    var menu = level_code != 'PSV' ? 'L'+level_code : 'PSV';
    $.ajax({
        url: "index.php?m="+menu, 
        data: {
            level_code: level_code
        },
        type: 'POST',
        success: function(resp){   
            $("#main-section").html(resp);
        }
    });
}

function createFileTrees(area_code)
{      
    alert(area_code);
    /*
    if($("#"+area_code+"-upload").length == 0) {
        alert('does not exists');
    }
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
    */
}