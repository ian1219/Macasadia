

$(document).ready(function() {
     $.fn.dataTable.ext.errMode = 'none'; 

    falert_dataTable = $('#floodalert').DataTable({
            
            searching: false, paging: false, info: false,
            "order": [
                [ 3, "desc" ], 
                [ 2, "desc" ]
            ],
            columnDefs: [
                { type: "time-uni", targets: [2] ,orderData: [3, 2]},
                { type: "date", targets: [3] ,orderData: [3, 3]}
            ],
        });
    fetch_update_recent_records();
    fetch_dashboard_level_data();
                
});


setInterval(function () 
{
    fetch_update_recent_records();
    update_level_data();
}, 50000);


//BAR CHART WATER LEVEL PER BARANGAY

function fetch_dashboard_level_data(){

    var ctxB = document.getElementById("barChart").getContext('2d');
    var data = {
        labels: [],
        datasets: [{
            label: 'Water Level',
            data: [],
            backgroundColor: ['rgba(255, 99, 132, 0.2)', 
                'rgba(54, 162, 235, 0.2)', 
                'rgba(255, 206, 86, 0.2)', 
                'rgba(75, 192, 192, 0.2)', 
                'rgba(153, 102, 255, 0.2)', 
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 159, 64, 0.2)'],
            borderColor: ['rgba(255,99,132,1)', 
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)', 
                'rgba(75, 192, 192, 1)', 
                'rgba(153, 102, 255, 1)', 
                'rgba(255, 159, 64, 1)',
                'rgba(255, 159, 64, 1)'],
            borderWidth: 1
        }]
    };
    function formatAMPM(date) {
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        return strTime;
    }

    var options = {

        legend: {
            display: false
        },
        responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        min: 0,
                        max : 5,
                    }
                }]
            }
    };
    var config = {
        type: 'bar',
        data: data,
        options:options
    };
    window.myBarChart = new Chart(ctxB, config);
    update_level_data();
}

function update_level_data(){

    var brgy_labels = [];
    var water_level = [];
    var timestamp = [];

    var xhr = new XMLHttpRequest();	
    xhr.open('POST', '../api/main_handler.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function () {	
        
		const obj = JSON.parse(this.responseText);
        function formatAMPM(date) {
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        }
        obj.data.every(function retry(value, index){

            if(value.c_id !== 0){
                brgy_labels.push(value.brgy_name);
             
                if (value.hlevel !== null) {
                    water_level.push(value.hlevel.c_level);
                    timestamp.push(value.hlevel.c_timestamp);
                }else{
                    water_level.push(0);
                    timestamp.push(0);
                }
            }
            return true;
        });
       
        var callbacks = {
            label: function(tooltipItem) {
                var index = tooltipItem.index;
                var waterlevel = "Water Level: "+Number(tooltipItem.yLabel);
                if(timestamp[index] !== 0){
                    var date = new Date(timestamp[index]);
                    var time = "Time: " + formatAMPM(date);
                }else{
                    var time = "Time: 0";
                }
                return [waterlevel,time];
            }
        }
        window.myBarChart.options.tooltips.callbacks = callbacks;
        window.myBarChart.data.labels = brgy_labels;
        window.myBarChart.data.datasets[0].data = water_level;
        window.myBarChart.update();
	};
    xhr.send('type=get_water_level');
}


//TABLE OF RECENT RECORDS
function fetch_update_recent_records(){

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../api/main_handler.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {      
       
        falert_dataTable.clear().draw(false);

        const obj = JSON.parse(this.responseText);
        if(obj.data.length === 0){
               return false;    
        }
         
        function ts_getDate(unix_timestamp){
            var a = new Date(unix_timestamp);
            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var year = a.getFullYear();
            var month = months[a.getMonth()];
            var date = a.getDate();
            date = date < 10 ? '0'+date : date;
            var time = date + ' ' + month + ' ' + year + ' ';
            return time;
        }
        function ts_getTime(unix_timestamp){
            var ts_obj = new Date(unix_timestamp);
            return ts_obj.toLocaleString('en-PH', { hour: 'numeric', minute: 'numeric', hour12: true });
        }
      
        obj.data.every(function retry(value, index){
            falert_dataTable.row.add(["Flood Alert Level "+value.c_floodlevel,value.c_barangay,ts_getTime(value.c_timestamp),ts_getDate(value.c_timestamp)]).draw(false);
            return true;
        });

    };
    xhr.send('type=get_recent_records');
}