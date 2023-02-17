<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top float-end"><i class="fa-solid fa-arrow-up"></i></a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
			integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
			integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
			crossorigin="anonymous"></script>

	<script src="js/bstreeview.js">
	</script>
	<script>
		$(function () {

			var json = [
				{
					text: "Area 1",
					icon: "fa fa-folder fa-fw",
					nodes: [
						{
							text: "Bachelor of Science in Information Technology",
							icon: "fa fa-folder fa-fw",
							nodes: [
								{
									icon: "fa fa-folder fa-fw",
									text: "Parameter A",
                                    nodes: [
                                    {
                                        icon: "fa fa-folder fa-fw",
                                        text: "System - Inputs and Processes"
                                    },
                                    {
                                        icon: "fa fa-folder fa-fw",
                                        text: "Implementation"
                                    },
                                    {
                                        icon: "fa fa-folder fa-fw",
                                        text: "Outcome"
                                    }
							]
								},
								{
									icon: "fa fa-folder fa-fw",
									text: "Parameter B",
                                    nodes: [
                                        {
                                            icon: "fa fa-folder fa-fw",
                                            text: "System - Inputs and Processes"
                                        },
                                        {
                                            icon: "fa fa-folder fa-fw",
                                            text: "Implementation"
                                        },
                                        {
                                            icon: "fa fa-folder fa-fw",
                                            text: "Outcome"
                                        }
                                         ]
								}
							]
						},
						{
							text: "Bachelor of Science in Computer Science",
							icon: "fa fa-folder fa-fw",
							nodes: [
								{
									icon: "fa fa-folder fa-fw",
									text: "Parameter A"
								},
								{
									icon: "fa fa-folder fa-fw",
									text: "Parameter B"
								}
							]
						},
                        {
							text: "Bachelor of Science in Electrical Technology",
							icon: "fa fa-folder fa-fw",
							nodes: [
								{
									icon: "fa fa-folder fa-fw",
									text: "Parameter A"
								},
								{
									icon: "fa fa-folder fa-fw",
									text: "Parameter B"
								}
							]
						},
                        {
							text: "Bachelor of Science in Electronics Technology",
							icon: "fa fa-folder fa-fw",
							nodes: [
								{
									icon: "fa fa-folder fa-fw",
									text: "Parameter A"
								},
								{
									icon: "fa fa-folder fa-fw",
									text: "Parameter B"
								}
							]
						},
                        {
							text: "Bachelor of Science in Industrial Technology - Major  in Food Preparation Service Management", 
							icon: "fa fa-folder fa-fw",
							nodes: [
								{
									icon: "fa fa-folder fa-fw",
									text: "Parameter A"
								},
								{
									icon: "fa fa-folder fa-fw",
									text: "Parameter B"
								}
							]
						}
					]
				},
				{
					text: "Area 2",
					icon: "fa fa-folder fa-fw",
					nodes: [
						{
							text: "Office",
							icon: "fa fa-folder fa-fw",
							nodes: [
								{
									icon: "fa fa-folder fa-fw",
									text: "Customers"
								},
								{
									icon: "fa fa-folder fa-fw",
									text: "Co-Workers"
								}
							]
						},
						{
							icon: "fa fa-folder fa-fw",
							text: "Others"
						}
					]
				},
                {
					text: "Area 3",
					icon: "fa fa-folder fa-fw",
					nodes: [
						{
							text: "Office",
							icon: "fa fa-folder fa-fw",
							nodes: [
								{
									icon: "fa fa-folder fa-fw",
									text: "Customers"
								},
								{
									icon: "fa fa-folder fa-fw",
									text: "Co-Workers"
								}
							]
						},
						{
							icon: "fa fa-folder fa-fw",
							text: "Others"
						}
					]
				}
			];

			$('#tree').bstreeview({
				data: json,
                expandIcon: 'fa fa-angle-down fa-fw',
                collapseIcon: 'fa fa-angle-right fa-fw',
                indent: 1.25,
                parentsMarginLeft: '1.25rem',
                openNodeLinkOnNewTab: true
			});
		});
	</script>
    </body>
</html>
