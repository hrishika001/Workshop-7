<?php
session_start();
include 'db.php';

$errors = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = trim($_POST['student_id'] ?? '');
    $name       = trim($_POST['name'] ?? '');
    $password   = $_POST['password'] ?? '';

    if ($student_id === '' || $name === '' || $password === '') {
        $errors = 'All fields are required.';
    } else {
        $hashed = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO students (student_id, name, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $student_id, $name, $hashed);

        if ($stmt->execute()) {
            header('Location: login.php');
            exit;
        } else {
            $errors = 'Error: ' . $stmt->error;
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<h2>Student Register</h2>

<?php if ($errors): ?>
<p style="color:red;"><?php echo htmlspecialchars($errors); ?></p>
<?php endif; ?>

<form method="post" action="">
    <label>Student ID:</label><br>
    <input type="text" name="student_id"><br><br>

    <label>Name:</label><br>
    <input type="text" name="name"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Register</button>
</form>

<p>Already registered? <a href="login.php">Login here</a></p>
</body>
</html>
