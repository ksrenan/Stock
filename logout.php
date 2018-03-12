<?php   
setcookie('usuario', NULL);
header("location:index.php"); //to redirect back to "index.php" after logging out
exit();
?>