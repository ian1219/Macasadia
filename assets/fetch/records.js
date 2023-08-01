


$(document).ready(function() {
     $.fn.dataTable.ext.errMode = 'none'; 

    falert_dataTable = $('#floodalert').DataTable({
            searchHighlight: true,
            search: {
               smart: false
            },
            "order": [  [ 2, "desc" ] ,[ 1, "desc" ]],
            columnDefs: [
                { type: "time-uni", targets: [1] ,orderData: [2, 1]},
                { type: "date", targets: [2] ,orderData: [2, 1]}
            ]
        });

    fetch_update_flood_records(); 
});


setInterval(function () 
{
    fetch_update_flood_records();
}, 50000);



function fetch_update_flood_records(){

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../api/main_handler.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {		
       
        falert_dataTable.clear().draw(false); // Clear all data to avoid duplicate
    
        const obj = JSON.parse(this.responseText);
        if(obj.data.length === 0)//if object is empty
           return false;

        function ts_getDate(unix_timestamp){
            var a = new Date(unix_timestamp);
            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            //var months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
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
            falert_dataTable.row.add(["Flood Alert Level "+value.c_floodlevel,ts_getTime(value.c_timestamp),ts_getDate(value.c_timestamp),value.c_barangay]).draw(false);
          
            return true;
        });
    };
    xhr.send('type=get_records');
}