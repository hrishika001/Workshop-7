<?php
session_start();

if (empty($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit;
}

// when form submitted, save cookie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme'])) {
    $value = $_POST['theme'] === 'dark' ? 'dark' : 'light';
    setcookie('theme', $value, time() + 86400 * 30, '/');
    $_COOKIE['theme'] = $value; // so current page also updates
}

// read theme from cookie (default light)
$theme = $_COOKIE['theme'] ?? 'light';
$bg    = $theme === 'dark' ? '#222' : '#fff';
$color = $theme === 'dark' ? '#fff' : '#000';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Preferences</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php echo $theme === 'dark' ? 'dark' : ''; ?>"
      style="background-color: <?php echo $bg; ?>; color: <?php echo $color; ?>;">

<div class="container">
    <h2>Theme Preference</h2>

    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="preference.php">Preferences</a> |
        <a href="logout.php">Logout</a>
    </nav>

    <form method="post" action="">
        <label>Select Theme:</label><br>

        <label>
            <input type="radio" name="theme" value="light"
                <?php echo $theme === 'light' ? 'checked' : ''; ?>>
            Light mode
        </label><br>

        <label>
            <input type="radio" name="theme" value="dark"
                <?php echo $theme === 'dark' ? 'checked' : ''; ?>>
            Dark mode
        </label><br><br>

        <button type="submit">Save</button>
    </form>

    <p>Current theme: <?php echo htmlspecialchars($theme); ?></p>
</div>

</body>
</html>
