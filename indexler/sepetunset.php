<?php 
session_start();
unset($_SESSION["shoppingCart"]);
header("Location:../siparislerim.php");
?>