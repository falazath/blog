 <?php
  include("header.html");
  ?>

<nav class="navbar navbar-expand-lg bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="img/logo.svg" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-size: 1.25vw;">
        <li class="nav-item">
          <a class="nav-link fw-bold" href="#about-us" style="font-size: 1.5vw;">แนะนำเว็บไซต์</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold" href="#bmiCal" style="font-size: 1.5vw;">คำนวณค่า BMI</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

 <section class="header-guest">
   <div class="row">
     <div class="col-sm-6 col-xl-6 ms-5">

       <div class="row align-items-center text-center">
         <div class="col">
           <p class="fw-bolder d-inline" style="font-size: 6vw;color:#B270A2">Health</p>
           <p class="fw-bolder d-inline mx-3" style="font-size: 6vw;color:#F08DB0">For</p>
           <p class="fw-bolder d-inline" style="font-size: 6vw;color:#B270A2">You</p>
           <p class="fw-bold" style="font-size: 2vw;color:#560074">สุขภาพที่ดีเริ่มต้นได้ที่ตัวคุณ ให้เราช่วยดูแลสุขภาพของคุณ</p>
         </div>
       </div>

       <div class="row justify-content-center mt-5">
         <div class="col-sm-3 col-xl-3 " style="font-size: 1.5vw">
           <a class="btn btn-info border border-3 py-2 px-xl-3 px-sm-1 rounded d-block fw-bold" style="font-size: 1.5vw" href="login.php">
             เข้าสู่ระบบ
           </a>
         </div>
         <div class="col-sm-4 col-xl-4">
           <a class="btn btn-info border border-3 py-2 px-xl-3 px-sm-1 rounded d-block fw-bold" style="font-size: 1.5vw" href="register.php">
             สมัครสมาชิก
           </a>
         </div>
       </div>
     </div>
     <div class="col-3 offset-sm-1 offset-xl-1">
       <img src="img/vector.svg" class="float-center w-100 h-100" alt="guest">
     </div>
   </div>
 </section>

 <div class="row justify-content-center">
   <div class="col-7">
     <img src="./img/pic/pic_1.jpg" class="w-100 h-100" alt="">
   </div>
   <div class="about-us col-xl-4  col-sm-10 text-center align-self-center rounded-4" id="about-us">
     <p class="fw-bolder " style="font-size: 2vw;color:white">About Us</p>
     <p class="fw-bold " style="font-size: 1.7vw;color:#560074">เว็บไซต์ของเรา เป็นเว็บไซต์สำหรับให้คำแนะนำทางด้านสุขภาพ ที่มีทั้งการออกกำลังกาย การกินอาหาร
       การควบคุมแคลอรี่ และรวมถึงการบันทึกกิจกรรมที่ทำในแต่ละวัน เพื่อนำไปใช้ในการดูแลสุขภาพ
       นอกจากนั้นยังมีกระทู้ให้ทุกคนได้ปรึกษาปัญหาด้านสุขภาพและแลกเปลี่ยนความคิดเห็นเพื่อแก้ปัญหาที่เกิดขึ้นอีกด้วย
       มาร่วมเป็นส่วนหนึ่งกับพวกเรากันนะครับ</p>
   </div>
 </div>

 <?php
  include("connect.php");
  isset($_POST['weight']) ? $w = $_POST['weight'] : $w = null;
  isset($_POST['height']) ? $h = $_POST['height'] : $h = null;
  $bmi = 0;
  if (isset($_POST['save-detail'])) {
    $bmi = $w / (($h / 100) * ($h / 100));
    if ($bmi < 18.50) {
      $str = "น้ำหนักน้อย";
    } else if ($bmi >= 18.50 && $bmi < 23) {
      $str = "สุขภาพดี";
    } else if ($bmi >= 23 && $bmi < 25) {
      $str = "ท้วม / โรคอ้วนระดับที่ 1";
    } else if ($bmi >= 25 && $bmi < 30) {
      $str = "อ้วน / โรคอ้วนระดับที่ 2";
    } else if ($bmi >= 30) {
      $str = "อ้วนมาก / โรคอ้วนระดับที่ 3";
    }
  }
  ?>

 <div class="row justify-content-around" style="margin-top:10%">
   <div class="service col-xl-4 col-sm-4 text-center align-self-center border border-4 rounded-4" id="service">
     <div class="row ">
       
     
     <div class="col align-self-baseline">
     <p class="fw-bolder" style="font-size: 3vw;">คำนวณค่า BMI</p>
     <form action="index.php" method="post">
       <div class="mb-3">
         <label for="weight" class="form-label">น้ำหนัก</label>
         <input type="text" class="form-control" name="weight" id="weight" placeholder="กรอกน้ำหนัก..." required>
       </div>
       <div class="mb-3">
         <label for="height" class="form-label">ส่วนสูง</label>
         <input type="text" class="form-control" name="height" id="height" placeholder="กรอกส่วนสูง..." required>
       </div>
       <button class="btn btn-primary" type="submit" name="save-detail" id="save-detail">SAVE</button>
     </form>
     </div>
     </div>
     <div class="row mt-4" id="bmiCal">
       <div class="col">
         <p class="fw-bold" style="font-size: 3vw">BMI: <?= $bmi ?></p>
         <?php if (isset($_POST['save-detail'])) { ?>
           <p class="fw-bold mt-3" style="font-size: 2vw">ค่า BMI ของคุณอยู่ในเกณฑ์:</p>
           <p class="fw-bold mt-3" style="font-size: 2vw"><?= $str ?></p>
         <?php } ?>


       </div>
     </div>

   </div>

   <div class="col-xl-5 col-sm-10">
     <div class="row">
     <div class="col-12 d-block align-self-center">
      <p class="fw-bolder" style="font-size:2vw">ค่า BMI คืออะไร ?</p>
       <p>การหาค่าดัชนีมวลกาย (Body Mass Index : BMI) คือเป็นมาตรการที่ใช้ประเมินภาวะอ้วนและผอมในผู้ใหญ่ ตั้งแต่อายุ 20 ปีขึ้นไป สามารถทำได้โดยการชั่งน้ำหนักตัวเป็นกิโลกรัม และวัดส่วนสูงเป็นเซนติเมตร แล้วนำมาหาดัชมีมวลกาย โดยใช้โปรแกรมวัดค่าความอ้วนข้างต้น
         <br> การประเมินระดับความอ้วนด้วยสูตรคำนวน BMI เป็นการประเมินจากค่าเฉลี่ยเชิงสถิติ ผลการคำนวณที่ได้อาจคลาดเคลื่อนจากความเป็นจริง โดยเฉพาะผู้ที่ออกกำลังกายเป็นประจำ หรือกลุ่มนักเพาะกายที่มีปริมาณกล้ามเนื้อสูง</p>
     </div>
     <div class="col-12 align-self-center">
     <img src="./img/pic/pic_2.jpg" class="w-100 h-75 rounded-5" alt="">
     </div>
 
     
   </div>

 </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
 <script script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 <script src="js/bootstrap.js"></script>
 <script type="text/javascript">
   $(function() {
     $('#datepicker').datepicker();
   });
 </script>

 <div class="container-fluid">
   <footer class="row d-block justify-content-center align-items-center py-3 my-4 border-top">
     <div class="col align-self-center">
       <a href="index.php" class="d-block mx-auto link-dark text-decoration-none">
         <img src="img/logo.svg" class="d-block mx-auto" alt="Logo">
       </a>
     </div>
   </footer>
 </div>
 <script src="./js/bootstrap.bundle.min.js"></script>
 </body>

 </html>