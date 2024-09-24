<?php
session_start();

// Simpele gebruikersgegevens (vervang dit later met databasegebruikers)
$valid_username = "boom";
$valid_password = "boom"; // In de praktijk sla je wachtwoorden gehashed op!

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check of gebruikersnaam en wachtwoord overeenkomen
    if ($username === $valid_username && $password === $valid_password) {
        // Zet sessie variabelen voor de ingelogde gebruiker
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        // Redirect naar beheerpagina
        header("Location: manage.php");
        exit();
    } else {
        $error = "Ongeldige inloggegevens!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</body>
</html>
