var tree_list = [];
var tree_data = {};
var level_code = '';
var area_code = '';

$(document).ready(function()
{  
    //console.log(tree_list);
    //console.log(tree_data);

    // Indicators Tree
    $.each( tree_list, function( key, value ) {
        var id = value['id'];  
        $("#"+id).click(function(){
            var area_code = value['area_code'];
            var program_code = value['program_code'];
            //var folders = tree_data[area_code][program_code]['nodes'];
            var folders = value['tree_json'];
            //console.log(folders);
            $('#tree_'+id).bstreeview({
                data: folders,
                expandIcon: 'fa fa-angle-down fa-fw',
                collapseIcon: 'fa fa-angle-right fa-fw',
                indent: 1.25,
                parentsMarginLeft: '1.25rem',
                openNodeLinkOnNewTab: true
            });
            $('#spinner_'+id).hide();
        });      
    }); 
    if (area_code != '' && level_code != '') {
        var area_id = 'area_'+level_code+'_'+area_code;
        if ($('#'+area_id).length != 0) {
            $('#'+area_id).click();  
        }
    }
});