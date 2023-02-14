<?php
session_start();
include("header.html");
include("menu_member.html");
include("connect.php");

isset($_POST['action']) ? $act = $_POST['action'] : $act = null;
if (($act == 'save')) {
    $sql_ans = $conn->prepare("INSERT INTO reply VALUES ('',?,now(),1,?,?)");
    $sql_ans->bindParam(1, $_POST['reply-text']);
    $sql_ans->bindParam(2, $_GET['topicID']);
    $sql_ans->bindParam(3, $_SESSION['id']);
    $sql_ans->execute();
}

if ($act == 'delete') {
    if (isset($_POST['po_id'])) {
        $del = $conn->prepare("UPDATE post SET status_id = 0 WHERE post_id LIKE " . $_POST['po_id']);
        $del->execute();
        header('location:webboard.php');
    } else {
        $del = $conn->prepare("UPDATE reply SET status_id = 0 WHERE reply_id LIKE " . $_POST['re_id']);
        $del->execute();
    }
}

$sql_post = $conn->prepare("SELECT * FROM post,user,status_user WHERE post.user_id = user.user_id AND user.status_user_id = status_user.status_user_id AND post_id LIKE ? AND post.status_id LIKE 1");
$sql_post->bindParam(1, $_GET['topicID']);
$sql_post->execute();
$post = $sql_post->fetch();

$sql_reply = $conn->prepare("SELECT * FROM reply,user,status_user WHERE reply.user_id = user.user_id AND user.status_user_id = status_user.status_user_id AND reply.post_id LIKE ? AND reply.status_id LIKE 1 ORDER BY reply_time DESC");
$sql_reply->bindParam(1, $_GET['topicID']);
$sql_reply->execute();


?>

<div class="container">


<table class="table table-white border mt-5">
    <tr>
        <th>
            <p class="h2 fw-bold"><?= $post['post_subject'] ?></p>
        </th>
    </tr>
    <tr>
        <td class="table-light">
            <p class="h5 fw-medium"><?= $post['post_text'] ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p class="text-end">ชื่อผู้ใช้: <?= $post['user_nameid'] ?> สถานะผู้ใช้: <?= $post['status_user_name'] ?></p>
            <p class="text-end">เวลาที่โพสต์: <?= $post['post_time'] ?></p>
        </td>
    </tr>
    <tr class="">
        <td>
            <?php
            if ($post['user_id'] == $_SESSION['id']) {
            ?>
                <form action="" method="post">
                    <div class="col ms-auto">
                    <input type="hidden" name="po_id" value="<?= $post['post_id'] ?>">
                    <button class="btn btn-danger d-block ms-auto" type="submit" name="action" value="delete">ลบโพสต์</button>
                    </div>
                    
                </form>
            <?php

            } else {
            ?>
                <form action="report.php?postID=<?= $post['post_id'] ?>&menu=post" method="post">
                <div class="col ms-auto">
                <input type="hidden" name="re_id" value="<?= $post['post_id'] ?>">
                <button class="btn btn-warning d-block ms-auto" type="submit" name="action" value="delete">รายงานโพสต์</button>
                </div>
                    
                </form>
            <?php
            }
            ?>
        </td>
    </tr>
</table>

<br><br>

<table class="table table-light border">
    <?php
    while ($reply = $sql_reply->fetch()) {
    ?>
        <tr>
            <td class="table table-white">
                <p class="h5 fw-medium"><?= $reply['reply_text'] ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="text-end">ชื่อผู้ใช้: <?= $reply['user_nameid'] ?> สถานะผู้ใช้: <?= $reply['status_user_name'] ?></p>
                <p class="text-end">เวลาที่โพสต์: <?= $post['post_time'] ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if ($reply['user_id'] == $_SESSION['id']) {
                ?>
                    <form action="" method="post">
                        <div class="col ms-auto">
                        <input type="hidden" name="re_id" value="<?= $reply['reply_id'] ?>">
                        <button class="btn btn-danger d-block ms-auto" type="submit" name="action" value="delete">ลบการตอบกลับ</button>
                        </div>
                    </form>
                <?php

                } else {
                ?>
                    <form action="report.php?postID=<?= $post['post_id'] ?>&menu=reply" method="post">
                    <div class="col ms-auto">
                    <input type="hidden" name="re_id" value="<?= $reply['reply_id'] ?>">
                        <button class="btn btn-warning d-block ms-auto" type="submit" name="edit-reply">รายงานการตอบกลับ</button>
                    </div>
                        
                    </form>
                <?php
                }
                ?>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<form action="" method="post">
    <table class="table table-light">
        <tr>
            <td>
                <label for="reply-text" class="form-label">ตอบกลับ</label>
                <textarea class="form-control" id="reply-text" name="reply-text" rows="3"></textarea>

            </td>
        </tr>
        <tr>
            <td>
                <div class="col ms-auto">
                <input type="hidden" name="post_id" id="<?= $_GET['topicID'] ?>">
                <input class="btn btn-primary d-block ms-auto" type="submit" name="action" value="ตอบกลับ">
                </div>
                
            </td>
        </tr>

    </table>
</form>
</div>
<?php
$conn = null;
?>