<?php
session_start();
include "connect.php";

// If user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// ---------------- Add Anime to List ----------------
if (isset($_POST['add_anime'])) {

    $title = trim($_POST['title']);
    $status = $_POST['status'];
    $episodes_watched = (int)$_POST['episodes_watched'];
    $score = (int)$_POST['score'];

    // Check empty title or negative episodes
    if (empty($title) || $episodes_watched < 0) {
        $message = "Please fill all required fields correctly.";
    } else {

        // Check if anime already exists for this user
        $check = $connection->prepare("SELECT id FROM animelist WHERE user_id=? AND title=?");
        $check->bind_param("is", $user_id, $title);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $message = "You already added this anime!";
        } else {

            // Insert new data
            $insert = $connection->prepare("INSERT INTO animelist (user_id, title, status, episodes_watched, score) VALUES (?, ?, ?, ?, ?)");
            $insert->bind_param("issii", $user_id, $title, $status, $episodes_watched, $score);

            if ($insert->execute()) {
                header("Location: animelist.php");
                exit();
            } else {
                $message = "Error adding anime.";
            }
        }
    }
}

// ---------------- Fetch data to display ----------------
$list = $connection->prepare("SELECT * FROM animelist WHERE user_id=? ORDER BY title ASC");
$list->bind_param("i", $user_id);
$list->execute();
$result = $list->get_result();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Anime List | AnimeHub</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

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
            <span style="color:white;margin-right:10px;">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php" class="btn login-btn">Logout</a>
        </div>
    </header>

    <div class="container">
        <h1>My Anime Watchlist</h1>
        <p>Your personal list of animes you have watched or plan to watch.</p>

        <?php echo $message; ?>

        <h2>Add New Anime</h2>
        <form action="animelist.php" method="POST" class="add-form">
            <input type="text" name="title" placeholder="Anime Title" required autofocus>
            <select name="status" required>
                <option value="">Select Status</option>
                <option value="Watching">Watching</option>
                <option value="Completed">Completed</option>
                <option value="Plan to Watch">Plan to Watch</option>
                <option value="Dropped">Dropped</option>
                <option value="On Hold">On Hold</option>
            </select>
            <input type="number" name="episodes_watched" placeholder="Episodes Watched" min="0" value="0" required>
            <input type="number" name="score" placeholder="Score" min="1" max="10">
            <button type="submit" name="add_anime">Add to List</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Episodes Watched</th>
                    <th>My Score</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td><?php echo htmlspecialchars($row['episodes_watched']); ?></td>
                            <td><?php echo ($row['score'] !== null) ? htmlspecialchars($row['score']) : 'N/A'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">No anime added yet!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>