<?php
require 'init.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit;
    }
    $error = 'Invalid username or password.';
}
include 'header.php';
?>
<h1>Login</h1>
<?php if (isset($_GET['registered'])): ?><p class="success">Account created. Please log in.</p><?php endif; ?>
<?php if ($error): ?><p class="error"><?= h($error) ?></p><?php endif; ?>

<form method="post" class="card">
    <label>Username</label>
    <input type="text" name="username" value="<?= h($_POST['username'] ?? '') ?>">
    <label>Password</label>
    <input type="password" name="password">
    <button class="btn">Login</button>
</form>

<?php include 'footer.php'; ?>