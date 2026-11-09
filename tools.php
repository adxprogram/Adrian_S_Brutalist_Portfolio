<?php
/**
 * Brutalist Portfolio - Arsenal & Tools (One-Page Redirect)
 * Adrian Santiago Portfolio // 2026 Archive
 */
header('Location: index.php#tools', true, 302);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url=index.php#tools">
    <title>Redirecting to Tools // Adrian Santiago</title>
    <script>window.location.replace("index.php#tools");</script>
</head>
<body style="background:#A6A6A6;font-family:sans-serif;padding:2rem;">
    <p>Redirecting to <a href="index.php#tools">index.php#tools</a>...</p>
</body>
</html>
<?php exit; ?>
