<?php
session_start();
include 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = trim($_POST['student_id'] ?? '');
    $password   = $_POST['password'] ?? '';

    if ($student_id === '' || $password === '') {
        $error = 'Student ID and password are required.';
    } else {
        $stmt = $conn->prepare("SELECT id, name, password FROM students WHERE student_id = ?");
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();
        $stmt->close();

        if ($student && password_verify($password, $student['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['student_id'] = $student_id;
            $_SESSION['name'] = $student['name'];

            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Invalid credentials.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<h2>Student Login</h2>

<?php if ($error): ?>
<p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="post" action="">
    <label>Student ID:</label><br>
    <input type="text" name="student_id"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Login</button>
</form>

<p>No account? <a href="register.php">Register</a></p>
</body>
</html>
