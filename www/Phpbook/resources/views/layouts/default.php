<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=cbcecf24-ba04-47d7-92cf-6f737ae4e559&lang=ru_RU" type="text/javascript"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg" id="mainNav">
    <?php if (isset($_SESSION['access_admin'])) : ?>
    <div class="container"><?php require 'resources/views/layouts/nav_admin.php';?></div>
    <?php else : ?>
    <div class="container"><?php require 'resources/views/layouts/nav.php';?></div>
    <?php endif; ?>
</nav>
<br />
<div class="container"><?php echo $content; ?></div>
<hr>
<footer>
    <div class="container"><?php require 'resources/views/layouts/footer.php';?></div>
</footer>
</body>
</html>
