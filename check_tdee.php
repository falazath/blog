<?php
session_start();
include('header.html');
include('connect.php');

$sql = $conn->prepare("SELECT * FROM detail_user WHERE user_id = ".$_SESSION['id']." ORDER BY detUser_date DESC LIMIT 1");
if($sql->execute()){
    $user = $sql->fetch();
}
if (!isset($_SESSION['tdee'])) {
    if(isset($_POST['tdee'])){
        $tdee = $user['detUser_bmr'] * $_POST['tdee-select'];
        $_SESSION['tdee'] = $tdee;
        header('location: record_create.php');
    }
        
}else{
    header('location: record_create.php');
}
?>
<div class="container">
    <div class="row">
        <div class="col">
        <form action="" method="post">
                        <label for="tdee">TDEE</label>
                        <select class="form-select" name="tdee-select" id="tdee">
                            <option selected value="1.2">ไม่ออกกำลังกายหรือกิจวัตรประจำวันเป็นการทำงานนั่งโต๊ะ</option>
                            <option value="1.375">ออกกำลังกายเบา ๆ หรือออกกำลังกาย 1 – 2 ครั้งต่อสัปดาห์</option>
                            <option value="1.55">ออกกำลังกายปานกลาง หรือออกกำลังกาย 3 – 5 ครั้งต่อสัปดาห์</option>
                            <option value="1.725">ออกกำลังกายหนัก หรือออกกำลังกาย 6 – 7 ครั้งต่อสัปดาห์</option>
                            <option value="1.9">ออกกำลังกายหนักมาก หรือออกกำลังกายทุกวัน วันละ 2 เวลา</option>
                        </select>
                        <button class="btn btn-success" type="submit" name="tdee" value="save">บันทึก</button>
                    </form>
        </div>
    </div>
</div>
