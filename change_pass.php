<?php
session_start();
include("header.html");
include("menu_member.html");
include("connect.php");
if (isset($_POST['save']) && ($_POST['pwd'] == $_POST['confirm'])) {
  $stmt = $conn->prepare("UPDATE user SET user.user_pass = ? WHERE user_id LIKE ?;");
  $stmt->bindParam(1, $_POST['pwd']);
  $stmt->bindParam(2, $_SESSION['id']);
  if ($stmt->execute()) {
    header('Location: account_detail.php');
  }else {
    header('Location: change_pass.php');
  }
} 
$conn = null;
?>
<section class="header-info">
  <div class="container-fluid bg-white">
    <div class="row align-items-center">
      <div class="col-xl-2 col-sm-4 ms-auto">
        <a href="manage_member.php"><img src="img/image 4.svg" class="w-100 h-100 float-start" alt="Logo"></a>
      </div>
      <div class="col-xl-3 col-sm-7 me-auto align-self-center">
        <h1 class="fw-bold pt-4">จัดการบัญชี</h1>
        <h3>บัญชีส่วนตัวและข้อมูลต่างๆ</h3>
      </div>
    </div>
  </div>
</section>
<section class="body">
  <div class="row">
    <div class="col-3 pt-5">
    <ul>
        <li><a class="fw-bold text-decoration-none" href="account_detail.php"><img class="pe-3" src="img/account.svg" alt="account"> รายละเอียดบัญชี</a></li>
        <img src="img/line/Line 1.svg" alt="Line">

        <li><a class="fw-bold text-decoration-none" href="change_pass.php"><img class="pe-3" src="img/password.svg" alt="password"> เปลี่ยนรหัสผ่าน</a></li>
        <img src="img/line/Line 1.svg" alt="Line">

        <li><a class="fw-bold text-decoration-none" href="logout.php"><img class="pe-3" src="img/logout.svg" alt="logout">ออกจากระบบ</a></li>
        <img src="img/line/Line 1.svg" alt="Line">

        <li><a href="https://lin.ee/6S2ek6H"><img src="img/line/line.png" class="add-line w-25 h-25" alt="AddLine"></a></li>
      </ul>
    </div>
    <div class="body-manage col">
      <div class="data-manage">
        <!--เปลี่ยนรหัสผ่าน-->
        <div>
          <div class="row pt-2">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
              <div class="col ps-5 mb-3">
                <label for="pwd" class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" name="pwd" id="pwd" placeholder="กรอกรหัสผ่านใหม่...">
              </div>
              <div class="col ps-5 mb-3">
                <label for="confirm" class="form-label">ยืนยันรหัสผ่าน</label>
                <input type="password" class="form-control" name="confirm" id="confirm" placeholder="กรอกยืนยันรหัสผ่านใหม่...">
              </div>
              <div class="d-grid col-3 mx-auto">
                <input class="btn btn-primary" type="submit" name="save" value="SAVE">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include("footer.html"); ?>