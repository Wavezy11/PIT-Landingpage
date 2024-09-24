<?php
// index.php

// Databaseverbinding
$host = 'localhost';
$db = 'pit landing-page'; // Vervang dit door je database naam
$user = 'root'; // Vervang dit door je database gebruikersnaam
$pass = ''; // Vervang dit door je database wachtwoord

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}



$appsPerPage = 12;


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $appsPerPage) - $appsPerPage : 0;

// Ophalen van het totaal aantal apps voor paginering
$totalApps = $pdo->query('SELECT COUNT(*) FROM apps')->fetchColumn();
$totalPages = ceil($totalApps / $appsPerPage);




// Ophalen van apps uit de database
$stmt = $pdo->prepare("SELECT * FROM apps ORDER BY id DESC LIMIT :start, :appsPerPage");
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':appsPerPage', $appsPerPage, PDO::PARAM_INT);
$stmt->execute();
$apps = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landingpage PIT</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<header>
    <img src="img/logo-yonder.png" alt="logo">
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <a href="php/upload.php"> <button>Edit</button> </a>
    <?php endif; ?>
</header>

    <main>
        <br><br>
        <p class="titel">Onze projecten</p>
        <p class="tekst">
            Welkom bij het Practoraat Interactieve Technologie. Wij presenteren met trots onze vooruitstrevende digitale oplossingen en innovatieve apps. 
            Hier vindt u een overzicht van de projecten die we hebben ontwikkeld, variërend van gebruiksvriendelijke mobiele applicaties tot krachtige webtools.
            <br><br>
            Elk van onze creaties is zorgvuldig ontworpen met oog voor kwaliteit, intuïtief gebruiksgemak en afgestemd op de specifieke wensen van onze partners. 
            <br><br>
            Ontdek hoe onze oplossingen bedrijven en organisaties ondersteunen bij efficiënter werken, effectievere communicatie en versnelde innovatie. 
            <br> 
            Of u nu inspiratie zoekt of geïnteresseerd bent in samenwerking, wij staan klaar om uw organisatie te helpen bij de volgende stap in digitale vooruitgang.
        </p>
        <div class="container">
            <?php foreach ($apps as $row): ?>
                <div class="app" data-title="<?= htmlspecialchars($row['title']) ?>" data-description="<?= htmlspecialchars($row['description']) ?>" data-image="img/<?= htmlspecialchars($row['image']) ?>" data-link="<?= htmlspecialchars($row['link']) ?>">
                    <img class="homepage-image" src="img/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                    <p class="app-date"><?= date('d F Y', strtotime($row['created_at'])) ?></p>
                    <p class="apptitle"><?= htmlspecialchars($row['title']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>




        <div id="popupOverlay" class="overlay"></div>
        <div id="myPopup" class="popup">
            <span class="close" onclick="togglePopup()">×</span>
            <div class="popup-content">
                <div class="popup-left">
                    <img id="popupImage" src="" alt="Popup Image">
                </div>
                <div class="popup-right">
                    <h2 id="popupTitle">Popup Title</h2>
                    <p id="popupDescription">Popup description goes here.</p>
                    <button id="popupbutton" onclick="window.open('', '_blank')">Link naar de applicatie</button>
                </div>
            </div>
        </div>

        

        <script src="js/index.js"></script>
    </main>

    <footer>
        <a href="php/login.php">
        <p>&copy; <?= date('Y') ?> Yonder. Alle rechten voorbehouden.</p>
            </a>
    </footer>