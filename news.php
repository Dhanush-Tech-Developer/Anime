<?php
// news.php
// For now, we'll hardcode some news. Later you can fetch from a database or API.
$newsList = [
    [
        "title" => "Attack on Titan Final Season Part 3 Announced!",
        "date" => "2025-11-28",
        "description" => "The thrilling conclusion of AOT is coming soon. Fans are hyped!"
    ],
    [
        "title" => "Demon Slayer Movie Breaks Box Office Records",
        "date" => "2025-11-25",
        "description" => "The latest Demon Slayer movie has become the highest-grossing anime film worldwide."
    ],
    [
        "title" => "New One Piece Arc Revealed",
        "date" => "2025-11-20",
        "description" => "Exciting new storylines and characters await in the upcoming One Piece arc."
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnimeHub | News</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVIGATION -->
<header class="navbar">
    <div class="logo">AnimeHub</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="animelist.php">Anime List</a>
        <a href="genre.html">Genres</a>
        <a href="favorites.php">Favorites</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="news.php" class="active">News</a>
        <a href="profile.php">Profile</a>
        <a href="contact.php">Contact</a>
    </nav>
    <div class="auth-buttons">
        <a href="login.php" class="btn login-btn">Login</a>
        <a href="register.php" class="btn register-btn">Register</a>
    </div>
</header>

<!-- NEWS SECTION -->
<section class="news-section">
    <h1>📢 Latest Anime News</h1>

    <div class="news-container">
        <?php foreach ($newsList as $news): ?>
            <div class="news-card">
                <h2><?php echo $news['title']; ?></h2>
                <span class="news-date"><?php echo $news['date']; ?></span>
                <p><?php echo $news['description']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <p>© 2025 AnimeHub — Created with ❤️ by Dhanush</p>
</footer>

</body>
</html>
