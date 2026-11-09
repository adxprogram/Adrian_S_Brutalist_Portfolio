<?php
/**
 * Brutalist Portfolio - Experience Record (One-Page Redirect)
 * Adrian Santiago Portfolio // 2026 Archive
 */
header('Location: index.php#experience', true, 302);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url=index.php#experience">
    <title>Redirecting to Experience // Adrian Santiago</title>
    <script>window.location.replace("index.php#experience");</script>
</head>
<body style="background:#A6A6A6;font-family:sans-serif;padding:2rem;">
    <p>Redirecting to <a href="index.php#experience">index.php#experience</a>...</p>
</body>
</html>
<?php exit; ?>
