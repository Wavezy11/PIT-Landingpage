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

// Verwerken van verwijderen
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM apps WHERE id = ?");
    $stmt->execute([$id]);
    echo "App succesvol verwijderd!";
}

// Verwerken van wijzigen
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link']; // Nieuwe variabele voor de link

    // Sanitize the title for the filename
    $sanitizedTitle = preg_replace('/[^a-zA-Z0-9_-]/', '_', $title);

    if (!empty($_FILES['image']['name'])) {
        $imageExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = $sanitizedTitle . '.' . $imageExtension;
        $target = '../img/' . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $stmt = $pdo->prepare("UPDATE apps SET title = ?, description = ?, image = ?, link = ? WHERE id = ?");
            $stmt->execute([$title, $description, $image, $link, $id]);
        }
    } else {
        $stmt = $pdo->prepare("UPDATE apps SET title = ?, description = ?, link = ? WHERE id = ?");
        $stmt->execute([$title, $description, $link, $id]);
    }

    echo "App succesvol gewijzigd!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Apps - PIT</title>
    <link rel="stylesheet" href="../css/manage.css">
</head>
<body>
    <header>
        <img src="../img/logo-yonder.png" alt="logo">
        <a href="../index.php"> <button> Keer terug naar het hoofdpagina</button> </a>
    </header>

    <main>
        <h1>Beheer Apps</h1>
        <div class="container">
            <?php
            // Ophalen van apps uit de database
            $stmt = $pdo->query("SELECT * FROM apps ORDER BY id DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="app">';
                echo '<img class="homepage-image" src="../img/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '">';
                echo '<p class="app-date">' . date('d F Y', strtotime($row['created_at'])) . '</p>';
                echo '<p class="apptitle">' . htmlspecialchars($row['title']) . '</p>';
                echo '<p class="beschrijving">' . htmlspecialchars($row['description']) . '</p>';
                echo '<p class="app-link"><a href="' . htmlspecialchars($row['link']) . '" target="_blank">Link naar applicatie</a></p>'; // Link

                // Wijzigen formulier
                echo '<form method="POST" enctype="multipart/form-data">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<label for="title">Titel:</label>';
                echo '<input type="text" name="title" value="' . htmlspecialchars($row['title']) . '" required>';
                echo '<label for="description">Beschrijving:</label>';
                echo '<textarea name="description" required>' . htmlspecialchars($row['description']) . '</textarea>';
                echo '<label for="link">Link naar de applicatie:</label>'; // Link label
                echo '<input type="url" name="link" value="' . htmlspecialchars($row['link']) . '" required>'; // Link input
                echo '<label for="image">Afbeelding wijzigen:</label>';
                echo '<input type="file" name="image" accept="image/*">';
                echo '<button type="submit" name="update">Wijzigen</button>';
                echo '</form>';

                // Verwijderen formulier
                echo '<form method="POST">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<button type="submit" name="delete" onclick="return confirm(\'Weet je zeker dat je deze app wilt verwijderen?\')">Verwijderen</button>';
                echo '</form>';
                echo '</div>';
            }
            ?>

            <a href="upload.php"><button>uploaden?</button></a>
        </div>
    </main>
</body>
</html>
