<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Highcharts Example</title>
</head>

<body>

    <canvas id="myChart" style="min-width:70vw;max-width:700px; min-height:50vh;"></canvas>






    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script>
        CallBackendData();

        function CallBackendData() {
            $.ajax({
                url: "./databasebutton.php",
                method: "POST",
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    if (result.status) {
                        console.table(result.value);
                        
                        var X_axis = [];
                        var Y_axis = [];
                        var objValue = result.value;

                        objValue.map(function(value) {
                            
                            let timeData = value.time;
                            let Temp = value.data;
                            let Yes = "ON";
                            
                            if(Temp == Yes)
                            {
                                let TempY = 1;
                                X_axis = [...X_axis, timeData];
                                Y_axis = [...Y_axis, TempY];
                            }
                            else
                            {
                                let TempN = 0;
                                X_axis = [...X_axis, timeData];
                                Y_axis = [...Y_axis, TempN];
                            }

                            // X_axis = [...X_axis, timeData];
                            // Y_axis = [...Y_axis, Temp];
                        })
                        getChatGraph(X_axis, Y_axis)


                        //recall again...........................
                        setTimeout(function() {
                            CallBackendData();
                        }, 500);
                    } else {
                        alert("somthing wents wrong!");
                    }


                },
                error: function(error) {
                    return error;
                }

            })
        }


        function getChatGraph(xAccess, yAccess) {

            var xValues = xAccess;
            var yValues = yAccess;

            new Chart("myChart", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,0,255,1.0)",
                        borderColor: "rgba(0,0,255,0.1)",
                        data: yValues
                    }]
                },
                options: {
                    animation: false,
                    legend: {
                        display: false
                    }
                }
            });
        }
    </script>
</body>

</html>