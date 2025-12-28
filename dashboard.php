<?php
session_start();

if (empty($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

$name  = $_SESSION['name'] ?? 'Student';

// read theme cookie (default light)
$theme = $_COOKIE['theme'] ?? 'light';
$bg    = $theme === 'dark' ? '#222' : '#fff';
$color = $theme === 'dark' ? '#fff' : '#000';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php echo $theme === 'dark' ? 'dark' : ''; ?>"
      style="background-color: <?php echo $bg; ?>; color: <?php echo $color; ?>;">

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($name); ?></h2>

    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="preference.php">Preferences</a> |
        <a href="logout.php">Logout</a>
    </nav>

    <p>This is your student grade portal dashboard.</p>
</div>

</body>
</html>
