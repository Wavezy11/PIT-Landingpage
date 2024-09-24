<?php
session_start();
session_destroy(); // Verwijder alle sessies

// Redirect naar de login-pagina
header("Location: login.php");
exit();
?>
