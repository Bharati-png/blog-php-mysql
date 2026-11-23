<?php
require 'init.php';
require_login();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($title === '' || $content === '') {
        $error = 'Title and content are required.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
        $stmt->execute([$title, $content]);
        header('Location: index.php');
        exit;
    }
}
include 'header.php';
?>
<h1>New Post</h1>
<?php if ($error): ?><p class="error"><?= h($error) ?></p><?php endif; ?>

<form method="post" class="card">
    <label>Title</label>
    <input type="text" name="title" value="<?= h($_POST['title'] ?? '') ?>">
    <label>Content</label>
    <textarea name="content" rows="7"><?= h($_POST['content'] ?? '') ?></textarea>
    <button class="btn">Publish</button>
</form>

<?php include 'footer.php'; ?>