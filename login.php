<?php
include("header.html");
include("connect.php");
session_start();
isset($_POST['username']) ? $user = $_POST['username'] : $user = NULL;
isset($_POST['pwd']) ? $pass = $_POST['pwd'] : $pass = NULL;
if ((isset($_POST['sign-in']))) {
  include("connect.php");
  $stmt = $conn->prepare("SELECT * FROM user WHERE user_username LIKE ? AND user_pass LIKE ?");
  $stmt->bindParam(1, $user);
  $stmt->bindParam(2, $pass);
  $stmt->execute();
  if ($row = $stmt->fetch()) {
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['name'] = $row['name'];
    $_SESSION['id'] = $row['user_id'];
    $stmt = $conn->prepare("SELECT * FROM user,detail_user WHERE user.user_id = detail_user.user_id AND user.user_id = " . $_SESSION['id'] . "");
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row['detUser_id']) {
      header('Location: index_member.php');
    } else {
      header('Location: detail_user.php');
    }
  } else {
    echo '<scripts type="text/javascript">';
    echo "alert('Incorrect username and/or password!')";
    echo '</scripts>';
  }
}
$conn = null;
?>
<div class="card text-white bg-white">

  <div class="card-body text-center">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
      <h2 class="fw-bold mt-3 mb-3 text-uppercase" style="color: #560074">Sign in</h2>
      <div class="modal-body">
        <div class="form-outline form-white mb-4">
          <label class="form-label " style="color: #560074" for="typeEmailX">Username</label>
          <input type="text" name="username" id="typeEmailX" class="form-control form-control-md" placeholder="Enter Username" style="background-color: #C3AED6" required>
        </div>
        <div class="form-outline form-white mb-4">
          <label class="form-label" style="color: #560074" for="typePasswordX">Password</label>
          <input type="password" name="pwd" id="typePasswordX" class="form-control form-control-md" placeholder="Enter Password" style="background-color: #C3AED6" required>
        </div>

      </div>
      <button class="btn btn-outline-dark py-2 px-3 mb-4 rounded" type="submit" name="sign-in" id="sign-in">SIGN IN</button>
    </form>
  </div>
</div>