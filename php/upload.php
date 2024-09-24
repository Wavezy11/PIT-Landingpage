<?php


session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Stuur de gebruiker naar de login-pagina als hij/zij niet is ingelogd
    header("Location: login.php");
    exit();
}

$host = 'localhost'; 
$dbname = 'pit landing-page'; 
$username = 'root';
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kan geen verbinding maken met de database: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];

    // Check if description exceeds 400 characters
    if (strlen($description) > 400) {
        echo "<script>alert('Beschrijving mag maximaal 400 karakters zijn. De overtollige tekst is verwijderd.');</script>";
        $description = substr($description, 0, 400);
    }

    // Sanitize the title for the filename
    $sanitizedTitle = preg_replace('/[^a-zA-Z0-9_-]/', '_', $title);
    $imageExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $image = $sanitizedTitle . '.' . $imageExtension;
    $target = '../img/' . basename($image);

    // Upload de afbeelding
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $stmt = $pdo->prepare("INSERT INTO apps (title, description, image, link) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $description, $image, $link]);
        echo "<div class='kaas'>App succesvol geüpload! . </div>";
    } else {
        echo "Er is een fout opgetreden bij het uploaden van de afbeelding.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload App - PIT</title>
    <link rel="stylesheet" href="../css/upload.css">
    
</head>
<body>
    <header>
        <img src="../img/logo-yonder.png" alt="logo">
        <a href="../index.php"> <button> Keer terug naar het hoofdpagina</button> </a>
    </header>

    <main>
        <h1>Upload een nieuwe app</h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="title">Titel:</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Beschrijving:</label>
            <textarea name="description" id="description" required></textarea>

            <div>
                <span id="charCount">0</span>/400 karakters
            </div>
            

            <label for="image">Afbeelding:</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <label for="link">Link naar de applicatie:</label>
<input type="url" name="link" id="link" required>

            <button type="submit">Upload</button>
        </form>

      

        <script src="../js/upload.js"></script>
    </main>
</body>
</html>
