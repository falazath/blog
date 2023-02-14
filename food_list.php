<?php
session_start();
include("header.html");
include("connect.php");
$sql = $conn->prepare("SELECT * FROM food,food_category WHERE food.food_cate_id = food_category.food_cate_id");
$sql->execute();



?>
<div class="container">
    <div class="row my-4">
    <input class="form-control" id="myInput" type="text" placeholder="Search..">
    </div>
    <table class="table table-white border">
        <thead>
            <tr>
                <th class="col">Picture</th>
                <th class="col">Name</th>
                <th class="col">Calorie</th>
                <th class="col">Category</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?php
                while($data = $sql->fetch()){
            ?>
            <tr>
            <td>
                    <img src="img/<?=$data['food_photopath']?>" width="300" height="auto" alt="picture<?=$data['food_id']?>">
                </td>
                <th><?=$data['food_name']?></th>
                <td><?=$data['food_calorie']?></td>
                <td><?=$data['food_cate_name']?></td>
                <td>
                    <a class="btn btn-success" href="record_action.php?menu=get&pid=<?=$data['food_id']?>&action=add" >เพิ่ม</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<?php
include("footer.php")
?>