<?php
/**
 * Brutalist Portfolio - Initiate Contact (One-Page Redirect)
 * Adrian Santiago Portfolio // 2026 Archive
 */
header('Location: index.php#contact', true, 302);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url=index.php#contact">
    <title>Redirecting to Contact // Adrian Santiago</title>
    <script>window.location.replace("index.php#contact");</script>
</head>
<body style="background:#A6A6A6;font-family:sans-serif;padding:2rem;">
    <p>Redirecting to <a href="index.php#contact">index.php#contact</a>...</p>
</body>
</html>
<?php exit; ?>
