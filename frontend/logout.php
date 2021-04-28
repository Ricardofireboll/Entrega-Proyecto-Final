<?php
setcookie("email", "", time()-1, "/");
setcookie("password", "", time()-1 , "/");

header("Location: login.html");
?>