<!DOCTYPE html>
<html lang="ru">
<head>
    <base href="<?=BASE_URL?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="css/bootstrap.min.css">  
       <script src="js/jquery-2.0.3.min.js"></script>
       <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Главная</title>
</head>
<body>

<div class="navbar navbar-fixed-top mynavbar" role="navigation">
    <div class="container mynavbar-item">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?=BASE_URL?>">
                <img src="images/phpfinansist_logo_plain.svg">
                phpfinansist</a>
        </div>
    </div>
</div>


<div class="container"> 			<!--  HEADER-->
    <div class="row">
        <div class="col-md-12 text-center page-header">
            <h1></h1>
        </div>
    </div>
</div>


<div class="col-md-6 col-md-offset-3 text-center content">		<!-- CONTENT-->
    <?php include BASE_PATH . 'application/views/'.$content_view; ?>
</div>

<div id="footer">				<!-- FOOTER-->
    <div class="container">
        <p class="text-muted">Подвальчик</p>
    </div>
</div>
</body>
</html>
