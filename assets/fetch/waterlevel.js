
$(document).ready(function() {
	get_waterlevel();
});


setInterval(function () 
{
 	update_water_data();
}, 30000);


function get_waterlevel(){
	var chart = {
		animations: { enabled: false },
		zoom: {
          enabled: false
		},
          height: 430,
			type: 'area',
			stacked: false,
			foreColor: '#4e4e4e',
			toolbar: {
				  show: false
				},
			dropShadow: {
				enabled: false,
				opacity: 0.1,
				blur: 3,
				left: -7,
				top: 22,
			}
	};
	var plotOptions = {
		bar: {
			columnWidth: '30%',
			endingShape: 'rounded',
			dataLabels: {
				position: 'top', // top, center, bottom
			},
		}
	};
	var stroke = {
		show: true,
		curve: 'smooth'
		  // colors: ['transparent']
	};
	var grid = {
		show: true,
		borderColor: 'rgba(0, 0, 0, 0.10)',
	};
	var xaxis = {
		type: 'category',
		tickPlacement: 'on',
		labels: {
			rotate: -45,
			rotateAlways: true
		}
	};
	var colors = ["#02ba5a", '#e72e7a'];
	var tooltip = {
		theme: 'light',
		y: {
			formatter: function (val)
			{
				return " " + val + " feet"
			}
		}
	};
	var options = {
        series: [],
        chart: chart,
		plotOptions:plotOptions,
		dataLabels: {
          enabled: false,
			formatter: function(val) {
				return parseInt(val);
			},
			offsetY: -20,
			style: {
				fontSize: '14px',
				colors: ["#304758"]
			}
		},
		stroke: stroke,
		grid: grid,
        noData: {
          text: 'Loading...'
        },
        xaxis: {
          type: 'category',
          tickPlacement: 'on',
          labels: {
            rotate: -45,
            rotateAlways: true
          }
        },
		yaxis: {
			tickAmount: 16,
			min: 0,
			max: 8,
			floating: false,
			labels: {
				formatter: function (value) {
			  		return value + " ft";
			}
		  },
		},
		colors: colors,
		tooltip: tooltip,
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					height: 330,
					stacked: true,
				},
				legend: {
				  show: !0,
				  position: "bottom",
				  horizontalAlign: "center",
				  offsetX: -20,
				  fontSize: "10px",
				  markers: {
					radius: 50,
					width: 10,
					height: 10
				  }
				  },
				  plotOptions: {
					bar: {
						columnWidth: '30%'
						}
					}
				}
			}]
    };

    window.chart = new ApexCharts(document.querySelector("#chart1"), options);
    window.chart.render();
	
	update_water_data();
}

function update_water_data(){

	var xhr = new XMLHttpRequest();	
    xhr.open('POST', '../api/main_handler.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function () {	
		const obj = JSON.parse(this.responseText);
		window.chart.updateSeries(obj);
		

		/*chart.updateSeries([{
          "name": 'River',
          "data": [{"x":1,"y":23},{"x":2,"y":23},{"x":3,"y":21}]
        }])*/
	};
    xhr.send('type=get_water_feet_data');
}