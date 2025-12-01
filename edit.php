<?php
session_start();
include "connect.php";

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = '';

// Fetch current user data
$stmt = $connection->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $favorite_anime = $_POST['favorite_anime'];

    // Update users table
    $stmt = $connection->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $email, $user_id);
    $stmt->execute();

    $message = "Profile updated successfully!";
    // Refresh data
    $userData['username'] = $username;
    $userData['email'] = $email;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
</head>
<body>
<div class="container">
    <h2>Edit Profile</h2>
    <?php if($message) echo "<p class='success'>$message</p>"; ?>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($userData['username']) ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($userData['email']) ?>" required>


        <button type="submit">Save Changes</button>
    </form>
</div>
</body>
</html>
