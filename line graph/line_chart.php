<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title></title>

        <script type="text/javascript" src="../jquery.js"></script>
        <script type="text/javascript">
    $(document).ready(function(){       
    var chart;
    var dates="";
  
                $("#view_line").click(function(){
                   var from=$("#load_from").val();
                   var to=$("#load_to").val();
                   if(from!="" && to!=""){
                  var info="from="+from+"&to="+to;
                       $.ajax({
                          type:"POST",
                          url:"get_dates.php",
                          data:info,
                          success:function(msg1){
                              chart.xAxis[0].setCategories(JSON.parse(msg1));
                          }
                      });
                       
                       $.ajax({
                           type:"POST",
                           url:"get_duration.php",
                           data:info,
                           success:function(msg){
                           chart.series[0].setData(JSON.parse(msg));
                           }
                       });
                       
            chart = new Highcharts.Chart({
            chart:{
            renderTo:'container',
            },
            title: {
                text: 'Daily Total Duration',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: Time Tracker(FoV)',
                x: -20
            },
            xAxis: {
                categories: []
            },
            yAxis: {
                title: {
                    text: 'Duration(mins.)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'mins'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'user',
                data: []
            }]
        });
            
            }
                     else{
                     alert("select dates first");
                     }  
              });});
        </script>
    </head>
    <body>
        <script src="../highcharts.js"></script>


<input type="date" id="load_from" name="load_from">
<input type="date" id="load_to" name="load_to">
<input type="button" id="view_line" name="view_line" value="View">
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
    </body>
</html>