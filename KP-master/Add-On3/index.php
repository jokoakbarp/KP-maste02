<?php
$connect = mysqli_connect('localhost', 'root', '', 'add_on');
$data_add_on = mysqli_query($connect, "SELECT tanggal, SUM(minipack) AS minipack FROM add_on GROUP BY tanggal");
$data_tanggal = array();
$data_minipack = array();
while ($data = mysqli_fetch_array($data_add_on)) {
  $data_tanggal[] = date('d-m-Y', strtotime($data['tanggal'])); // Memasukan tanggal ke dalam array
  $data_minipack[] = $data['minipack']; // Memasukan minipack ke dalam array
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Membuat Grafik Di PHP dan MySQL menggunakan Chartjs</title>
  <style>
    .container {
      width: 100%;
      margin: 15px 10px;
    }
    .chart {
      width: 50%;
      float: left;
      text-align: center;
    }
  </style>
  <script type="text/javascript" src="Chart.bundle.min.js"></script>
</head>
<body>
  <div class="container">

    <div class="chart">
      <h2>Line Chart</h2>
      <canvas id="line-chart"></canvas>
    </div>
  </div>
  <script>

    var linechart = document.getElementById('line-chart');
    var chart = new Chart(linechart, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($data_tanggal) ?>, // Merubah data tanggal menjadi format JSON
        datasets: [{
          label: 'Data add_on',
          data: <?php echo json_encode($data_minipack) ?>,
          borderColor: 'rgba(255,99,132,1)',
          backgroundColor: 'transparent',
          borderWidth: 2
        }]
      }
    });
  </script>
</body>
</html>
