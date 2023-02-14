<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="./asset/dist/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="./css/map.css" />
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
</head>
<body>

<?php
include('menu_member.html');
include('connect.php');
$conn = new PDO("mysql:host=localhost; dbname=project; charset=utf8", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = $conn->prepare("SELECT * FROM place,place_category WHERE place.place_cate_id = place_category.place_cate_id");
$sql->execute();
?>

<section class="header-info">
  <div class="container-fluid bg-white">
    <div class="row align-items-center">
      <div class="col-xl-2 col-sm-4 ms-auto">
        <a href="manage_member.php"><img src="img/body/map.png" class="w-100 h-100 float-start" alt="Logo"></a>
      </div>
      <div class="col-xl-3 col-sm-7 me-auto align-self-center">
        <h1 class="fw-bold pt-4">แผนที่</h1>
      </div>
    </div>
  </div>
</section>

<div id="map" class="mx-auto" style="width:90%;height:80%;"></div>

<div class="row mt-5">
  <div class="col-6 d-block mx-auto">
  <table class="table border" style="font-size: 1.5vw;">
  <thead>
    <tr>
      <th>ชื่อสถานที่</th>
      <th>ประเภทสถานที่</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $sql->fetch()) { ?>
      <tr>
        <th><?= $row['place_name'] ?></th>
        <td><?= $row['place_cate_name'] ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
  </div>
</div>


<script>
  function initMap() {
    var mapOptions = {
      center: {
        lat: 14.88515308140623,
        lng: 103.48916768261233
      },
      zoom: 15,
    }

    var maps = new google.maps.Map(document.getElementById("map"), mapOptions);

    var marker, info;

    $.getJSON("json.php", function(jsonObj) {
      //*** loop
      $.each(jsonObj, function(i, item) {
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(item.place_lat, item.place_lng),
          map: maps,
          title: item.place_name
        });

        info = new google.maps.InfoWindow();

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            info.setContent(item.place_name);
            info.open(maps, marker);
          }
        })(marker, i));

      }); // loop

    });

  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9YoemEKkwHIU--Nrg6wRIfX_N2ARCM30&callback=initMap" async defer></script>
<?php include('footer.html') ?>