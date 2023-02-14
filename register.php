<?php
include("header.html");
include("connect.php");
ob_start();
if (isset($_POST['sign-up'])) {
  include("connect.php");
  $stmt = $conn->prepare("SELECT * FROM user WHERE user_username LIKE ?");
  $stmt->bindParam(1, $_POST["username"]);
  $stmt->execute();
  if (!($stmt->fetch())) {
    $stmt = $conn->prepare("INSERT INTO user VALUES ('', ?, ?, ?,?,?,'','1','1')");
    $stmt->bindParam(1, $_POST["username"]);
    $stmt->bindParam(2, $_POST["pwd"]);
    $stmt->bindParam(3, $_POST["name"]);
    $stmt->bindParam(4, $_POST["sex"]);
    $stmt->bindParam(5, $_POST["birthday"]);
    if ($stmt->execute()) {
      echo "<scripts type='text/javascript'> alert('Fail')</scripts>";
      header('Location:index_php');
    }
  } else {
    echo "<scripts> alert('Fail')</scripts>";
    header('Location:index.php');
  }
}
$conn = null;
?>
<div class="card text-white bg-white">
  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="card-body text-center">

      <h2 class="fw-bold mt-3 mb-3 text-uppercase" style="color: #560074">Sign Up</h2>

      <div class="modal-body mb-3">
        <div class="form-outline form-white mb-4">
          <label class="form-label " style="color: #560074">Username</label>
          <input type="text" id="email" name="username" class="form-control form-control-md" placeholder="Enter Username" style="background-color: #C3AED6" required>
        </div>
        <div class="form-outline form-white mb-4">
          <label class="form-label" style="color: #560074">Password</label>
          <input type="password" id="pwd" name="pwd" class="form-control form-control-md" placeholder="Enter Password" style="background-color: #C3AED6" required>
        </div>
        <div class="form-outline form-white mb-4">
          <label class="form-label " style="color: #560074">ชื่อ</label>
          <input type="text" id="name" name="name" class="form-control form-control-md" placeholder="Enter Name" style="background-color: #C3AED6" required>
        </div>
        <div class="row">
          <div class="col-4">
            <label class="form-label " style="color: #560074">เพศ</label>
            <div class="form-check form-white text-start">
              <input class="form-check-input" type="radio" name="sex" id="male" value="1" checked>
              <label class="form-check-label" style="color: #560074" for="male">ชาย</label>
            </div>
            <div class="form-check text-start">
              <input class="form-check-input" type="radio" name="sex" id="female" value="2">
              <label class="form-check-label" style="color: #560074" for="famale">หญิง</label>
            </div>
          </div>
          <div class="col justify-content-end">
            <label style="color: #560074" for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday" required>
          </div>
        </div>

      </div>
      <button class="btn btn-outline-dark py-2 px-3 mb-4 rounded" type="submit" name="sign-up" id="sign-up">SIGN UP</button>

    </div>
  </form>
</div>