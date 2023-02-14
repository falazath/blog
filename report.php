<?php
include("header.html");
include("connect.php");
isset($_POST['re_id']) ? $report = $_POST['re_id'] : $report=null;
echo "menu=".$_GET['menu'];
echo "ID=".$report;
echo $_POST['getID'];
if(isset($_POST['action']) && ($_POST['action'] == 'report')){
    
    if(isset($_GET['menu']) && $_GET['menu'] == 'post'){
        echo "1";
        $sql = $conn->prepare("INSERT INTO report_post VALUES ('',?,?)");
        $sql->bindParam(1,$_POST['reportID']);
        $sql->bindParam(2,$_POST['getID']);
        
        
}else if(isset($_GET['menu']) && $_GET['menu'] == 'reply'){
    echo "2";
    $sql = $conn->prepare("INSERT INTO report_reply VALUES ('',?,?)");
    $sql->bindParam(1,$_POST['reportID']);
    $sql->bindParam(2,$_POST['getID']);
}
if($sql->execute()){
    echo '<script> alert("Success")</script>';
    
}else{
    echo '<script> alert("Fail")</script>';
}
header('location:view_topic.php?topicID='.$_GET['postID'].'');
    
}
?>
<form action="" method="post">
<div class="form-check">
  <input class="form-check-input" type="radio" name="reportID" id="id1" value="1" checked>
  <label class="form-check-label" for="id1">
  ภาพโป๊เปือย
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="reportID" id="id2" value="2">
  <label class="form-check-label" for="id2">
  ความรุนแรง
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="reportID" id="id3" value="3">
  <label class="form-check-label" for="id3">
  สแปม
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="reportID" id="id4" value="4">
  <label class="form-check-label" for="id4">
  ข้อมูลเท็จ
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="reportID" id="id5" value="5">
  <label class="form-check-label" for="id5">
  ความรุนแรง
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="reportID" id="id6" value="6">
  <label class="form-check-label" for="id6">
  ข้อความที่แสดงถึงความเกลียดชัง
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="reportID" id="id7" value="7">
  <label class="form-check-label" for="id7">
  ข้อมูลเท็จ
  </label>
  <input type="hidden" name='getID' value="<?=$report?>">
  <button class="btn btn-primary" type="submit" name="action" value="report">Send</button>
</div>
</form>