<?php
session_start();
include("header.html");
include("menu_member.html"); ?>
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
    <div class="col" style="background: #C3AED6;">
        <!--แก้ไข-->
          <?php include("connect.php");
          if (isset($_POST['edit'])) {
            $stmt = $conn->prepare("UPDATE user SET user.user_nameid = ?, user.sex_id = ?, user.user_birth = ? WHERE user_id LIKE ?;");
            $stmt->bindParam(1, $_POST['name']);
            $stmt->bindParam(2, $_POST['sex']);
            $stmt->bindParam(3, $_POST['birthday']);
            $stmt->bindParam(4, $_SESSION['id']);
            if ($stmt->execute()) {
              $today = date("Y-m-d");
              $diff = date_diff(date_create($_POST['birthday']), date_create($today));
              $age = $diff->format('%y');
              $bmi = $_POST['weight'] / (($_POST['height'] / 100) * ($_POST['height'] / 100));
              if ($_POST['sex'] == 1) {
                $bmr = 66.4730 + (13.7516 * ($_POST['weight'])) + (5.0033 * ($_POST['height'])) - (6.7550 * ($age));
              } else {
                $bmr = 655.0955 + (9.5634 * ($_POST['weight'])) + (1.8496 * ($_POST['height'])) - (4.6756 * ($age));
              }
              $stmt = $conn->prepare("INSERT INTO detail_user VALUES ('',now(),?,?,?,?,?);");
              $stmt->bindParam(1, $_POST['weight']);
              $stmt->bindParam(2, $_POST['height']);
              $stmt->bindParam(3, $bmi);
              $stmt->bindParam(4, $bmr);
              $stmt->bindParam(5, $_SESSION['id']);
              if($stmt->execute()){
                header('Location: account_detail.php');
              }else{
                header('Location: edit_account.php');
              }
            } else {
              header('Location: edit_account.php');
            }
            $conn = null;
          }

          ?>
          <div class="row m-5 bg-white rounded-5">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
              <div class="col-auto ps-5 my-3">
                <label for="name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="กรอก">
              </div>
              <div class="col ps-5 mb-3">
                <label class="form-label ">เพศ</label>
                <div class="form-check form-white text-start">
                  <input class="form-check-input" type="radio" name="sex" id="male" value="1" checked>
                  <label class="form-check-label" for="male">ชาย</label>
                </div>
                <div class="form-check text-start">
                  <input class="form-check-input" type="radio" name="sex" id="female" value="2">
                  <label class="form-check-label" for="famale">หญิง</label>
                </div>
              </div>
              <div class="col col ps-5 mb-3">
                <label style="color: #560074" for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday" required>
              </div>
              <div class="col ps-5 mb-3">
                <label for="weight" class="form-label">น้ำหนัก</label>
                <input type="text" class="form-control" name="weight" id="weight" placeholder="กรอก">
              </div>
              <div class="col ps-5 mb-3">
                <label for="height" class="form-label">ส่วนสูง</label>
                <input type="text" class="form-control" name="height" id="height" placeholder="กรอก">
              </div>
              <div class="d-grid col-3 mx-auto mb-5">
                <input class="btn btn-primary" type="submit" name="edit" value="SAVE">
              </div>
            </form>
          </div>
      </div>
  </div>
</section>
<?php include("footer.html"); ?>