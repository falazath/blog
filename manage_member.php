<?php include("header.html");
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
<section class="body-info">
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
    <div id="info" class="body-manage col">
      <div class="data-manage">
        <!--หน้าแรก-->
        <div id="home" style="display: block" class="p-4">
          <h1>ยินดีต้อนรับเข้าสู่หน้าจัดการบัญชี</h1>
          <h4>ในหน้าสมาชิกนี้ คุณสามารถดู รายละเอียดบัญชี เปลี่ยนรหัสผ่าน และแก้ไขข้อมูลส่วนตัวได้</h4>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include("footer.php"); ?>