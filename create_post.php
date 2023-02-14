<?php
session_start();
include("header.html");
include("menu_member.php");
include("connect.php");
if(isset($_POST['create'])){
    $stmt = $conn->prepare("INSERT INTO post VALUES ('',?,?,now(),1,?);");
    $stmt->bindParam(1,$_POST['subject']);
    $stmt->bindParam(2,$_POST['text']);
    $stmt->bindParam(3,$_SESSION['id']);
    if($stmt->execute()){
        header('location:webboard.php');
    }

}
?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="col ps-5 mb-3">
        <label for="subject" class="form-label">ชื่อหัวข้อ</label>
        <input type="text" class="form-control" name="subject" id="subject" placeholder="กรอกชื่อหัวข้อ">
    </div>
    <div class="col ps-5 mb-3">
        <label for="text" class="form-label">เนื้อหา</label>
        <input type="textarea" class="form-control" name="text" id="text" placeholder="กรอกเนื้อหา">
    </div>
    <div class="d-grid col-3 mx-auto">
                <input class="btn btn-primary" type="submit" name="create" value="SAVE">
              </div>
</form>