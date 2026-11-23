<?php
require 'init.php';
$posts = $pdo->query("SELECT id, title, content, created_at FROM posts ORDER BY created_at DESC")->fetchAll();
include 'header.php';
?>
<h1>All Posts</h1>

<?php if (!$posts): ?>
    <p>No posts yet.</p>
<?php endif; ?>

<?php foreach ($posts as $p): ?>
    <div class="card">
        <h2><?= h($p['title']) ?></h2>
        <small>Posted on <?= h($p['created_at']) ?></small>
        <p><?= nl2br(h($p['content'])) ?></p>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a class="btn" href="edit.php?id=<?= (int)$p['id'] ?>">Edit</a>
            <form method="post" action="delete.php" style="display:inline"
                  onsubmit="return confirm('Delete this post?');">
                <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                <button class="btn danger">Delete</button>
            </form>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php include 'footer.php'; ?>