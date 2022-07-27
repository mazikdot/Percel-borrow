<?php
    include('includes/config.php');
    if(isset($_GET['deleteId'])){
        $id = $_GET['deleteId'];
        $sql = "delete from  tblemployees  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':id',$id, PDO::PARAM_STR);
        $query -> execute();
    }
?>