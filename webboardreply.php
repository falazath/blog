<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocument</title>
    <link href="css/styles.css" rel="stylesheet"/>
    
  </head>
<body>
  <hearder>
  <?php include("menu.php");?>

    <section class="header-calory">
      <br><br>
        <nav>
          <div>
            <a href="webboard.php"><img src="img/body/webboard.svg" alt="webboard"></a>
          </div>
          <div>
            <h1>กระทู้ โต้ตอบ</h1>
            <h3>สร้างโพสต์เพื่อขอคำปรึกษาจากสมาชิกคนอื่นหรือผู้เชี่ยวชาญได้</h3>
          </div>
        </nav>
    </section>

    <section class="webboard-reply">
        <nav>
          <div class="header-post">
            <h1>โพสต์ของฉัน</h1>
            <div>
                <input type="text" name="search" id="search" placeholder="ค้นหา...">
            </div>
          </div>
          <br>
          <div class="new-post">
            <a href="#"><img src="img/webboard/+.svg" alt="+"></a>
            <h2>สร้างโพสต์</h2>
          </div>
          <br>
          <div class="body-post">
            <div class="post-0">
              <h3>ชื่อคนโพสต์</h3>
              <a id="time">เวลาที่โพสต์</a>
              <h4>หัวข้อที่โพส</h4>
              <a id="status">สถานะ<img src="img/webboard/report.svg" alt="report"></a>
              <div id="comment-1">
                <div id="l-cm">
                  <a href="#"><img src="img/webboard/heart.svg" onmouseover="this.src='img/webboard/heart_onclick';" onmouseout="this.src='img/webboard/heart.svg';"/></a>
                  <a href="webboardreply.html"><img src="img/webboard/reply.svg" alt="reply"></a>
                </div>
                <nav>
                    <ul>
                        <li>ตอบกลับ 10</li>
                        <li>ถูกใจ 10</li>
                    </ul>
                    <div>
                        <input type="box" name="reply" id="reply" placeholder="เขียนตอบกลับ...">
                    </div>
                    <div>
                      <a href="#"><img src="img/webboard/attach.svg" alt="attach"></a>
                      <a href="#"><img src="img/webboard/send.svg" alt="send"></a>        
                    </div>
                </nav>
              </div>
            </div>
            <br>
            <div id="post-1">
                <h3>ชื่อคนโพสต์</h3>
                <a id="time">เวลาที่โพสต์</a>
                <h4>หัวข้อที่โพส</h4>
                <a id="status">สถานะ<img src="img/webboard/report.svg" alt="report"></a>
                <div>
                    <a href="#"><img src="img/webboard/heart_onclick.svg" alt="heaart-click"></a>
                    <h3>10</h3>
                </div>
            </div>
            <br>
            <div id="post-2">
                <h3>ชื่อคนโพสต์</h3>
                <a id="time">เวลาที่โพสต์</a>
                <h4>หัวข้อที่โพส</h4>
                <a id="status">สถานะ<img src="img/webboard/report.svg" alt="report"></a>
                <div>
                    <a href="#"><img src="img/webboard/heart_onclick.svg" alt="heaart-click"></a>
                    <h3>10</h3>
                </div>
            </div>
          </div>
        </nav>
    </section>

    <?php include("footer.php");?>

  </hearder>

</body>
</html>