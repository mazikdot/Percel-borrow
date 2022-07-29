<?php
    include('includes/config.php');
    if(isset($_GET['deleteId'])){
        $id = $_GET['deleteId'];
        $sql = "delete from  tbborrow  WHERE BorrowId=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':id',$id);
        $query -> execute();
    }
?>