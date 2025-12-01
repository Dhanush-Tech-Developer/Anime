<?php
session_start();
include "connect.php";

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = ''; // Initialize message variable

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];

    $stmt = $connection->prepare("INSERT INTO dashboard (user_id, title, genre, image_url, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $title, $genre, $image_url, $description);

    if ($stmt->execute()) {
        $message = "Anime added successfully!";
    } else {
        $message = "Error adding anime.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnimeHub | Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- NAVBAR -->
    <header class="navbar">
        <div class="logo">AnimeHub</div>
        <nav>
            <a href="index.html">Home</a>
            <a href="animelist.php">Anime List</a>
            <a href="genre.html">Genres</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="news.html">News</a>
            <a href="profile.php">Profile</a>
            <a href="contact.html">Contact</a>
        </nav>
        <div class="auth-buttons">
            <a href="login.php" class="btn login-btn">Login</a>
            <a href="register.php" class="btn register-btn">Register</a>
        </div>
    </header>

    <!-- DASHBOARD HEADER -->
    <section class="page-title">
        <h1>Dashboard</h1>
        <p>Manage your anime collection and see analytics.</p>
    </section>

    <!-- MESSAGE -->
    <?php if ($message != ''): ?>
        <p class="msg"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- ADD NEW ANIME -->
    <section class="form-box">
        <h2>Add New Anime</h2>
        <form id="addAnimeForm" method="POST" action="">
            <input type="text" name="title" placeholder="Anime Title" required>
            <input type="text" name="genre" placeholder="Genre" required>
            <input type="url" name="image_url" placeholder="Image URL">
            <textarea name="description" placeholder="Description" rows="4" required></textarea>
            <button type="submit">Add Anime</button>
        </form>
    </section>

    <!-- ALL ANIME -->
    <section class="anime-section">
        <h2>All Anime</h2>
        <div id="animeList" class="anime-container">
            <?php
            $stmt = $connection->prepare("SELECT * FROM dashboard WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="anime-card">
                    <img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['title']) . '">
                    <h3>' . htmlspecialchars($row['title']) . '</h3>
                    <p>' . htmlspecialchars($row['genre']) . '</p>
                    <p>' . htmlspecialchars($row['description']) . '</p>
                </div>
                ';
            }
            ?>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>© 2025 AnimeHub — Created with ❤️ by Dhanush</p>
    </footer>
</body>

</html>