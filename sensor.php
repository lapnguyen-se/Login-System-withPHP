<?php
session_start();
$username = $_SESSION['username'];
if ($_SESSION['logged_in'] != true) {
    $_SESSION['message'] = "Please login first before using.";
    header("location: index.php");
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sensor Data</title>
    <?php include 'css/css.html'; ?>
</head>
<body>
<div class="wrapper">
    <?php
    include 'side-bar.php';
    ?>

    <div id="content">
        <div class="scrollable" style="height: 400px">
            <table class="table table-hover table-bordered" id="dataTable">
                <thead style="background-color: yellow;">
                <tr>
                    <th scope="col">xbee ID</th>
                    <th scope="col">Mote ID</th>
                    <th scope="col">Mote Location</th>
                    <th scope="col">HubName</th>
                    <th scope="col">Temperature</th>
                    <th scope="col">Air Pressure</th>
                    <th scope="col">Humidity</th>
                    <th scope="col">Light</th>
                    <th scope="col">Altitude</th>
                    <th scope="col">Mic</th>
                    <th scope="col">Gas</th>
                </tr>
                </thead>
                <tbody id="dataBody">
                </tbody>
            </table>
        </div>

        <table id="legend-table">
            <tr>
                <th colspan="2" style="text-align: center;">Legend</th>
            </tr>
            <tr>
                <td class="bg-danger">high temp</td>
                <td class="bg-info">low temp</td>
            </tr>
            <tr>
                <td class="bg-success">high humidity</td>
                <td class="bg-warning">low humidity</td>
            </tr>
        </table>

        <script>
            $(document).ready(function () {
                $.getJSON('sensor.json', function (data) {
                    $.each(data["sensorreadinglist"], function (key, value) {
                        var student_data = "";
                        student_data += "<tr>";
                        student_data += "<td>" + value.xbeeid + "</td>";
                        student_data += "<td>" + value.moteid + "</td>";
                        student_data += "<td>" + value.motelocation + "</td>";
                        student_data += "<td>" + value.hubname + "</td>";
                        if (value.temperature == 34.09) {
                            student_data += "<td class='bg-danger'>" + value.temperature + "</td>";
                        } else if (value.temperature == 32.34) {
                            student_data += "<td class='bg-info'>" + value.temperature + "</td>";
                        } else {
                            student_data += "<td>" + value.temperature + "</td>";
                        }
                        student_data += "<td>" + value.airpressure + "</td>";
                        if (value.humidity == 58.30) {
                            student_data += "<td class='bg-success'>" + value.humidity + "</td>";
                        } else if (value.humidity == 55.23) {
                            student_data += "<td class='bg-warning'>" + value.humidity + "</td>";
                        } else {
                            student_data += "<td>" + value.humidity + "</td>";
                        }
                        student_data += "<td>" + value.light + "</td>";
                        student_data += "<td>" + value.altitude + "</td>";
                        student_data += "<td>" + value.mic + "</td>";
                        student_data += "<td>" + value.gas + "</td>";
                        student_data += "</tr>";
                        $('#dataTable').append(student_data);
                    })
                });
            });
        </script>
    </div>

</div>

</body>
</html>



