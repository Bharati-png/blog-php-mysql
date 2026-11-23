<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Blog</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f8; margin: 0; color: #222; }
        nav { background: #1f6f64; padding: 14px 24px; display: flex; gap: 18px; align-items: center; }
        nav a { color: #fff; text-decoration: none; font-weight: bold; }
        nav .right { margin-left: auto; color: #fff; }
        .container { max-width: 800px; margin: 24px auto; padding: 0 16px; }
        .card { background: #fff; padding: 16px 20px; margin-bottom: 16px; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
        form label { display: block; margin: 12px 0 4px; font-weight: bold; }
        input[type=text], input[type=password], textarea { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #bbb; border-radius: 6px; }
        .btn { display: inline-block; background: #1f6f64; color: #fff; border: 0; padding: 8px 16px; border-radius: 6px; text-decoration: none; cursor: pointer; font-size: 14px; margin-top: 10px; }
        .btn.danger { background: #c0392b; }
        .error { background: #fdecea; color: #b71c1c; padding: 10px; border-radius: 6px; }
        .success { background: #e8f5e9; color: #1b5e20; padding: 10px; border-radius: 6px; }
        small { color: #666; }
    </style>
</head>
<body>
<nav>
    <a href="index.php">Home</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="create.php">New Post</a>
        <span class="right">Hello, <?= h($_SESSION['username']) ?> | <a href="logout.php">Logout</a></span>
    <?php else: ?>
        <span class="right"><a href="login.php">Login</a> | <a href="register.php">Register</a></span>
    <?php endif; ?>
</nav>
<div class="container">