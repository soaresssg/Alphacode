<?php
include "db_conn.php";
$id = $_GET['id'];
$sql = "DELETE FROM `contatos` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if($result){
    header("Location: index.php?msg=Exclusão realizada com sucesso");
}
else {
    echo "Failed: " . mysqli_error($conn);
}
?>