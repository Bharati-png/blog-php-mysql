<?php
require 'init.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if (strlen($username) < 3 || strlen($username) > 50) {
        $error = 'Username must be 3 to 50 characters.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $error = 'That username is already taken.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hash]);
            header('Location: login.php?registered=1');
            exit;
        }
    }
}
include 'header.php';
?>
<h1>Register</h1>
<?php if ($error): ?><p class="error"><?= h($error) ?></p><?php endif; ?>

<form method="post" class="card">
    <label>Username</label>
    <input type="text" name="username" value="<?= h($_POST['username'] ?? '') ?>">
    <label>Password</label>
    <input type="password" name="password">
    <label>Confirm Password</label>
    <input type="password" name="confirm">
    <button class="btn">Create Account</button>
</form>

<?php include 'footer.php'; ?>