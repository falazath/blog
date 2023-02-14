<?php
session_start();
include('connect.php');
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'add') { //เพิ่มรายการ
        if ($_GET['menu'] == 'get') {
            $pid = $_GET['pid'];
            if (isset($_SESSION['food-list'])) {
                $max = count($_SESSION['food-list']);
                $_SESSION['food-list'][$max]['pid'] = $pid;
                header('location: record_create.php');
            } else {
                $_SESSION['food-list'] = array();
                $_SESSION['food-list'][0]['pid'] = $pid;
                header('location: record_create.php');
            }
        } else if ($_GET['menu'] == 'burn') {
            $pid = $_POST['met'];
            $new = array('duration' => $_POST['duration'], 'met' => $pid);
            if (isset($_SESSION['burn-list'])) {
                $max = count($_SESSION['burn-list']);
                $check = 0;
                for ($i = 0; $i < $max; $i++) {
                    if ($pid == $_SESSION['burn-list'][$i]['met']) {
                        $check = 1;
                        break;
                    }
                }
                if ($check == 1) return;
                $max = count($_SESSION['burn-list']);
                $_SESSION['burn-list'][$max] = $new;
                header('location: record_create.php');
            } else {
                $_SESSION['burn-list'] = array();
                $_SESSION['burn-list'][0] = $new;
                header('location: record_create.php');
            }
        }
    } else if ($_GET['action'] == 'del') {
        if ($_GET['menu'] == 'get') {
            $pid = $_GET['pid'];
            $max = count($_SESSION['food-list']);  // ดึงจำนวนสินค้าในตะกร้าออกมา
            for ($i = 0; $i < $max; $i++) { // วนลูปค้นหาตามรหัสสินค้า
                if ($pid == $_SESSION['food-list'][$i]['pid']) { // ถ้ารหัสสินค้าตรงกัน
                    unset($_SESSION['food-list'][$i]); // ลบสินค้านั้นออก
                    $max-=1;
                    break;
                }
            }
            $_SESSION['food-list'] = array_values($_SESSION['food-list']);
            if($max==0) unset($_SESSION['food-list']);
            header('location: record_create.php');
        } else if ($_GET['menu'] == 'burn') {
            $pid = $_GET['pid'];
            $max = count($_SESSION['burn-list']);
            for ($i = 0; $i < $max; $i++) {
                if ($pid == $_SESSION['burn-list'][$i]['pid']) {
                    unset($_SESSION['burn-list'][$i]);
                    $max-=1;
                    break;
                }
            }
            $_SESSION['burn-list'] = array_values($_SESSION['burn-list']);
            if ($max== 0) unset($_SESSION['burn-list']);
            header('location: record_create.php');
        }
    }else if ($_GET['action'] == 'save-record') {
        $sql_insert = $conn->prepare("INSERT INTO planner VALUES ('',now(),?,?,?,?,1);");
        $sql_insert->bindParam(1, $_SESSION['getCal']);
        $sql_insert->bindParam(2, $_SESSION['burnCal']);
        $sql_insert->bindParam(3, $_SESSION['tdee']);
        $sql_insert->bindParam(4, $_GET['pid']);
        if ($sql_insert->execute()) {
            $planid = $conn->lastInsertId();
            if (isset($_SESSION['food-list'])) {
                $max = count($_SESSION['food-list']);
                echo $max;
                for ($i = 0; $i < $max; $i++) {
                    $pid = $_SESSION['food-list'][$i]['pid'];
                    $sql_insert = $conn->exec("INSERT INTO detail_plan_food VALUES('',$pid,$planid);");
                }
                unset($_SESSION['food-list']);
            }
            if (isset($_SESSION['burn-list'])) {
                $max = count($_SESSION['burn-list']);
                for ($i = 0; $i < $max; $i++) {
                    $pid = $_SESSION['burn-list'][$i]['met'];
                    $dur = $_SESSION['burn-list'][$i]['duration'];
                    $total = $_SESSION['burn-list'][$i]['total'];
                    $sql_insert = $conn->exec("INSERT INTO detail_plan_ex VALUES('',$dur,$total,$pid,$planid);");
                }
                unset($_SESSION['burn-list']);
            }
            unset($_SESSION['tdee']);   
            header('location: record_list.php');
            echo '<script>alert("บันทึกเรียบร้อย")</script>';
        }
    }else if ($_GET['action'] == 'clear'){
        unset($_SESSION['food-list']);
        unset($_SESSION['burn-list']);
        unset($_SESSION['tdee']);
        echo '<script>alert("ลบเรียบร้อย")</script>';
        header('location: record_list.php');
    }
}

?>8