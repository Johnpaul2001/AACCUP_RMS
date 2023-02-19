<script>

    var json = [
        {
            icon: "fa fa-folder fa-fw",
            text: "S.1. The institution has a system of determining the Vision and Mission."
        },
        {
            icon: "fa fa-folder fa-fw",
            text: "S.2. The Vision clearly reflects what the Institution hopes to become in the future."
        },
        {
            icon: "fa fa-folder fa-fw",
            text: "S.3. The Mission clearly reflects the Institution’s legal and other statutory mandates."
        },
        {
            icon: "fa fa-folder fa-fw",
            text: "S.4 The Goals of the College/Academic Unit are consistent with the Mission of the institution."
        },
        {
            icon: "fa fa-folder fa-fw",
            text: "S.5. The Objectives of the program have the expected outcomes in terms of competencies ( skills and knowledge), values and other attributes of the graduates which include the development of:",
            nodes: [
                {
                    icon: "fa fa-folder fa-fw",
                    text: "S.5.1. technical/ pedagogical skills; <button>Upload</button>",
                },
                {
                    icon: "fa fa-folder fa-fw",
                    text: "S.5.2. research and extension capabilities;"
                },
                {
                    icon: "fa fa-folder fa-fw",
                    text: "S.5.3. students’ own ideas, desirable attitudes and personal discipline;"
                },
                {
                    icon: "fa fa-folder fa-fw",
                    text: "S.5.4. moral character;"
                },
                {
                    icon: "fa fa-folder fa-fw",
                    text: "S.5.5. critical analytical, problem solving and other higher order thinking skills; and"
                    
                },
                {
                    icon: "fa fa-folder fa-fw",
                    text: "S.5.6. aesthetic and cultural values."
                }
                    ] 
        }
            
    ];
    
    $(document).ready(function() {
        $('<?php echo $id ?>').bstreeview({
            data: json,
            expandIcon: 'fa fa-angle-down fa-fw',
            collapseIcon: 'fa fa-angle-right fa-fw',
            indent: 1.25,
            parentsMarginLeft: '1.25rem',
            openNodeLinkOnNewTab: true
        });        
    });    


</script>