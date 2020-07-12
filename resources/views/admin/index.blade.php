<x-app>
	<!-- Page Wrapper -->
	<div id="wrapper">

		{{-- Side bar --}}
		<x-sidebar></x-sidebar>
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<x-top-navbar></x-top-navbar>

				<x-dashboard></x-dashboard>

			</div>
			<!-- End of Main Content -->

			<x-footer></x-footer>

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<x-top-button></x-top-button>

</x-app>
<script>
	// pie chart code
	$(function(){
		'use strict'
		/**************** PIE CHART ************/
		var pieData = [{
			name: 'Designation Wise Employee',
			type: 'pie',
			radius: '80%',
			center: ['50%', '57.5%'],
			data: <?php echo json_encode($Data); ?>,
			label: {
			normal: {
				fontFamily: 'Roboto, sans-serif',
				fontSize: 11
			}
			},
			labelLine: {
			normal: {
				show: false
			}
			},
			markLine: {
			lineStyle: {
				normal: {
				width: 1
				}
			}
			}
		}];
		var pieOption = {
			tooltip: {
			trigger: 'item',
			formatter: '{a} <br/>{b}: {c} ({d}%)',
			textStyle: {
				fontSize: 11,
				fontFamily: 'Roboto, sans-serif'
			}
			},
			legend: {},
			series: pieData
		};
		var pie = document.getElementById('chartPie');
		var pieChart = echarts.init(pie);
		pieChart.setOption(pieOption);
		/** making all charts responsive when resize **/
	});
</script>