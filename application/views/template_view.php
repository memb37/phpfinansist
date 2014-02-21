<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">   
    <script src="//code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?=MAINPAGE?>/css/style.css"> 
    <title>Главная</title>
</head>
<body>
     <div class="blog-masthead">	<!-- TOP NAVBAR-->
      <div class="container">
        <nav class="blog-nav text-right">
          <a class="blog-nav-item" href="<?=MAINPAGE?>/user/profile">Профиль</a>
          <a class="blog-nav-item" href="<?=MAINPAGE?>/user/logout">Выход</a>
        </nav>
      </div>
    </div>


	<div class="container"> 			<!--  HEADER-->
		<div class="row">
			<div class="col-md-12 text-center page-header">
				<h1>phpfinansist</h1>
			</div>
		</div>
	</div>

 	<div class="row">				<!-- LEFT NAVBAR-->
		<div class="col-md-1 col-md-offset-2 left-menu">
			<ul class="nav nav-list">
    			<li><a href="<?=MAINPAGE?>">Домой</a></li>
    			<li><a href="<?=MAINPAGE?>/user">Операции</a></li>
    			<li><a href="<?=MAINPAGE?>/operation/report">Отчет</a></li>
    			<li><a href="<?=MAINPAGE?>/category">Категории</a></li>
			</ul>
		</div>
		<div class="col-md-6  text-center content">		<!-- CONTENT-->
			<?php include 'application/views/'.$content_view; ?>
		</div>
	</div>


    <div id="footer">				<!-- FOOTER-->
      <div class="container">
        <p class="text-muted">Подвальчик</p>
      </div>
    </div>
</body>
</html>
