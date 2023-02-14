<?php
session_start();
include("header.html");
include("menu_member.html");
?>

<section class="header-info">
  <div class="container">
    <div class="row">
      <div class="col-3">
        <a href="webboard.php"><img src="img/body/webboard.svg" class="w-100 h-100 float-start" alt="Logo"></a>
      </div>
      <div class="col">
        <h1 class="fw-bold pt-4">กระทู้ โต้ตอบ</h1>
        <h3>สร้างโพสต์เพื่อขอคำปรึกษาจากสมาชิกคนอื่นหรือผู้เชี่ยวชาญได้</h3>
      </div>
    </div>
  </div>
</section>
<?php
include("connect.php");
$stmt = $conn->prepare("SELECT * FROM post,user,status_user WHERE post.user_id = user.user_id AND user.status_user_id = status_user.status_user_id AND post.status_id LIKE 1 ORDER BY post_time DESC");
$stmt->execute();
?>
<section class="body-info">
  <a class="btn btn-primary" href="create_post.php">สร้างโพสต์ใหม่</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">หัวข้อ</th>
      <th scope="col">ชื่อผู้ใช้</th>
      <th scope="col">สถานะผู้ใช้</th>
      <th scope="col">เวลาที่โพสต์</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while($row = $stmt->fetch()){
    ?>
    <tr>
      <th><a href="view_topic.php?topicID=<?=$row['post_id']?>"><?=$row['post_subject']?></a></th>
      <td><?=$row['user_nameid']?></td>
      <td><?=$row['status_user_name']?></td>
      <td><?=$row['post_time']?></td>
    </tr>
    <?php
    }
    $conn = null;
    ?>
    
  </tbody>
</table>
</section>