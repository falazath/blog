<?php
    session_start();
    include("header.html");
    include("connect.php");
    isset ($_POST['weight']) ? $w = $_POST['weight'] : $w = null;
    isset ($_POST['height']) ? $h = $_POST['height'] : $h = null;
    $bmi=0;
    $bmr=0;
    
    if(isset($_POST['save'])){
        $stmt = $conn->prepare("SELECT * , DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),'user_birth')), '%Y') 
        + 0 AS age FROM user WHERE user_id = ? ");
        $stmt->bindParam(1,$_SESSION['id']);
        $stmt->execute();
        $row = $stmt->fetch();
        $bmi = $w/(($h/100)*($h/100));
        if($row['sex_id'] == 1){
          
          $bmr = 66.4730 + (13.7516*($w)) +(5.0033*($h))-(6.7550*($row['age']));
        }else{
          $bmr = 655.0955 + (9.5634*($w)) +(1.8496*($h))-(4.6756*($row['age']));
        }
        
        $stmt = $conn->prepare("INSERT INTO detail_user VALUES ('',now(),?,?,?,?,?) ");
        $stmt->bindParam(1,$w);
        $stmt->bindParam(2,$h);
        $stmt->bindParam(3,$bmi);
        $stmt->bindParam(4,$bmr);
        $stmt->bindParam(5,$_SESSION['id']);
        if($stmt->execute()){
          echo "<script>" ;
          echo "alert('BMI: ".$bmi." ,BMR: ".$bmr."');";
          echo "window.location='index_member.php';";
          echo "</script>";
        }else{
          echo "<script type='text/javascript'> alert('Fail') </script>";
        }
    }
?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
<div class="mb-3">
  <label for="weight" class="form-label">น้ำหนัก</label>
  <input type="text" class="form-control" name="weight" id="weight" placeholder="กรอกน้ำหนัก..." required>
</div>
<div class="mb-3">
  <label for="height" class="form-label" >ส่วนสูง</label>
  <input type="text" class="form-control" name="height" id="height" placeholder="กรอกส่วนสูง..." required>
</div>
<div>
  <input class="btn btn-primary" type="submit" name="save" value="Save">
</div>
</form>
<h1>BMI: <?=$bmi?></h1>
<h1>BMR: <?=$bmr?></h1>