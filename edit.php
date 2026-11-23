<?php
require 'init.php';
require_login();

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $post['title'] = $title;
    $post['content'] = $content;

    if ($title === '' || $content === '') {
        $error = 'Title and content are required.';
    } else {
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $content, $id]);
        header('Location: index.php');
        exit;
    }
}
include 'header.php';
?>
<h1>Edit Post</h1>
<?php if ($error): ?><p class="error"><?= h($error) ?></p><?php endif; ?>

<form method="post" class="card">
    <label>Title</label>
    <input type="text" name="title" value="<?= h($post['title']) ?>">
    <label>Content</label>
    <textarea name="content" rows="7"><?= h($post['content']) ?></textarea>
    <button class="btn">Save Changes</button>
</form>

<?php include 'footer.php'; ?>