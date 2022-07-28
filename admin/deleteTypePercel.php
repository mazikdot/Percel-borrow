<?php
    include('includes/config.php');
    if(isset($_GET['deleteId'])){
        $id = $_GET['deleteId'];
        $sql = "delete from  tbtypepercel  WHERE TypePercelIdAuto=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':id',$id);
        $query -> execute();
    }
?>