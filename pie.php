<?php  
//$connect = mysqli_connect("localhost", "root", "", "testing");  
//$query = "SELECT gender, count(*) as number FROM tbl_employee GROUP BY gender";  
//$result = mysqli_query($connect, $query); 
$myPDO = new PDO('sqlite:satellite.db');

    if (!$myPDO) {
        //echo "connection not successful";
    }else{
        //echo "connection successful";
    }

    $query = "SELECT signal_strength, count(*) as number FROM satellite GROUP BY signal_strength";
    $result = $myPDO->query($query); 
?>  
<!DOCTYPE html>  
<html>  
    <head>  
        <title>Simple Pie Chart </title>  
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
        <script type="text/javascript">  
        google.charts.load('current', {'packages':['corechart']});  
        google.charts.setOnLoadCallback(drawChart);  
        function drawChart()  
        {  
            var data = google.visualization.arrayToDataTable([  
                        ['signal_strength', 'Number'],  
                        <?php  
                        //while($row = mysqli_fetch_array($result))  
                        while($row = $result->fetch(PDO::FETCH_BOTH))  
                        {  
                            echo "['".$row["signal_strength"]."', ".$row["number"]."],";  
                        }  
                        ?>  
                    ]);  
            var options = {  
                    title: 'Percentage of azimuth trial code',  
                    //is3D:true,  
                    pieHole: 0.4  
                    };  
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
            chart.draw(data, options);  
        }  
        </script>  
    </head>  
    <body>  
        <br /><br />  
        <div style="width:900px;">  
            <br />  
            <div id="piechart" style="width: 900px; height: 500px;"></div>  
        </div>  
    </body>  
</html>  