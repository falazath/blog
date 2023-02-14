<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health For You</title>
    <link href="css/styles.css" rel="stylesheet" />
    
  </head>
<body>
  <hearder>
  <?php include("menu.php");?>
    <section class="header-info">
      <br><br>
      <nav>
        <div class="img-logo">
          <a href="homepage.php"><img src="img/image 4.svg" alt="image"></a>
        </div>
        <div>
          <h1>จัดการบัญชี</h1>
          <h3>บัญชีส่วนตัวและข้อมูลต่างๆ</h3>
        </div>
      </nav>
    </section>

    <?php include("menu_teb.php");?>

      <div class="pass">
          <div class="pw">
              <br>
              <div id="pw-col-1">
                <h3>รหัสผ่านปัจจุบัน</h3>
                <input type="text" name="pass01" id="pass01" placeholder=" กรุณากรอกรหัสผ่านปัจจุบัน">
                </div>
              <div id="pw-col-2">
                <h3>รหัสผ่านใหม่</h3>
                <input type="password" name="pass02" id="password02" placeholder=" กรุณากรอกรหัสผ่านใหม่">
              </div>
              <div id="pw-col-3">
                <h3>ยืนยันรหัสผ่านใหม่</h3>
                <input type="password" name="pass03" id="pass03" placeholder=" กรุณากรอกรหัสผ่านใหม่อีกครั้ง">
              </div>
                <div id="pw-col-4">
                <button class="btn-2" type="submit">บันทึก</button>
              </div>
          </div>
      </div>

    <?php include("footer.php");?>

  </hearder>

</body>
</html>