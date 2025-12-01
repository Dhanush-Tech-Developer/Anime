<?php
// profile.php

// Placeholder user data (replace with database later)
$user = [
    "username" => "Dhanush",
    "email" => "dhanush@example.com",
    "favourites" => "Naruto, One Piece, Demon Slayer"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnimeHub | Profile</title>
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
        <a href="favorites.php">Favorites</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="news.php">News</a>
        <a href="profile.php" class="active">Profile</a>
        <a href="contact.php">Contact</a>
    </nav>
    <div class="auth-buttons">
        <a href="login.php" class="btn login-btn">Login</a>
        <a href="register.php" class="btn register-btn">Register</a>
    </div>
</header>

<!-- PROFILE SECTION -->
<section class="profile-section">
    <div class="profile-sidebar">
        <div class="avatar">
            <img src="avatar.png" alt="Profile Picture">
        </div>
        <h2><?php echo $user['username']; ?></h2>
        <p><?php echo $user['email']; ?></p>
        <a href="edit.php" class="btn edit-profile">Edit Profile</a>
    </div>

    <div class="profile-main">
        <h3>My Favorite Anime</h3>
        <ul class="favourites-list">
            <?php 
            $favs = array_map('trim', explode(',', $user['favourites']));
            foreach ($favs as $fav) {
                if(!empty($fav)) echo "<li>$fav</li>";
            }
            ?>
        </ul>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <p>© 2025 AnimeHub — Created with ❤️ by Dhanush</p>
</footer>

</body>
</html>
