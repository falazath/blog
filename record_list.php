<?php
session_start();
include("header.html");
include("menu_member.html");
include("connect.php");

if(isset($_POST['del'])){
  $sql = $conn->exec("UPDATE planner SET status_id = 0 WHERE plan_id = '".$_POST['del']."'");
}
$stmt = $conn->prepare("SELECT * FROM planner,detail_user WHERE planner.detUser_id = detail_user.detUser_id AND planner.status_id = 1 AND detail_user.user_id LIKE ? ORDER BY planner.plan_date DESC");
$stmt->bindParam(1,$_SESSION['id']);
$stmt->execute();
?>
<section class="header-info">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="record_list.php"><img src="img/body/plan.svg" class="w-100 h-100 float-start" alt="Logo"></a>
            </div>
            <div class="col">
                <h1 class="display-3 fw-bold pt-4">ตารางบันทึกแคลอรี่</h1>
                <h3 class="h3 fw-bold">บันทึกแคลอรี่ที่ได้รับจากการกินอาหารและ
                แคลอรี่ที่เผาผลาญจากการออกกำลังกายในแต่ละวัน</h3>
            </div>
        </div>
    </div>
</section>

<section class="body">
<div class="row mb-5">
  <div class="col-xl-2 col-sm-5 mx-auto" >
  <a  class="btn btn-primary d-block mx-auto" href="check_tdee.php">สร้างตารางบันทึกแคลอรี่</a>
  </div>
  </div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">วันเวลาที่สร้าง</th>
      <th scope="col">แคลอรี่ที่ได้รับ</th>
      <th scope="col">แคลอรี่ที่เผาผลาญ</th>
      <th scope="col">น้ำหนัก</th>
      <th scope="col">ส่วนสูง</th>
      <th scope="col">bmi</th>
      <th scope="col">tdee</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while($plan = $stmt->fetch()){
    ?>
    <tr>
      <th><a class="d-block text-decoration-none" href="cal_record.php?planID=<?=$plan['plan_id']?>"><?=$plan['plan_date']?></a></th>
      <td><?=$plan['plan_getCal']?></td>
      <td><?=$plan['plan_burnCal']?></td>
      <td><?=$plan['detUser_weight']?></td>
      <td><?=$plan['detUser_height']?></td>
      <td><?=$plan['detUser_bmi']?></td>
      <td><?=$plan['plan_tdee']?></td>
      <td>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
          <button class="btn btn-danger" type="submit" name="del" value="<?=$plan['plan_id']?>">ลบ</button>
        </form>
      </td>
    </tr>
    <?php
    }
    
    $conn = null;
    ?>
    
  </tbody>
</table>

</section>
<?php include("footer.html"); ?>