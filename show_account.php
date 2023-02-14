<?php include("connect.php");
$id = 1;
$stmt = $conn->prepare("SELECT user_username,user.user_nameid,user.user_birth,sex.sex_name 
    FROM user,sex WHERE user.sex_id = sex.sex_id AND user.user_id LIKE ? ;");
$stmt->bindParam(1, $id);
$stmt->execute();
$row = $stmt->fetch();
?>
<div class="edit-member row pt-4">
    <div class="col ps-5">
        <h3 class="fw-bold">Username</h3>
        <h2><?= $row["user_username"] ?></h2>
    </div>
    <div class="col pe-5">
        <h3 class="fw-bold">ชื่อ</h3>
        <h2><?= $row["user_nameid"] ?></h2>
    </div>
</div>
<div class="row">
    <div class="col ps-5">
        <h3 class="fw-bold">เพศ</h3>
        <h2><?= $row["sex_name"] ?></h2>
    </div>
    <div class="col pe-5">
        <h3 class="fw-bold">วันเดือนปี เกิด</h3>
        <h2><?= $row["user_birth"] ?></h2>
    </div>
</div>

<?php $conn = null; ?>