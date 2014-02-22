<!DOCTYPE html>
<html lang="ru">
<head>
    <base href="<?=BASE_URL?>">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">   
    <script src="//code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css"> 
    <title>Главная</title>
</head>
<body>
     <!--<div class="blog-masthead">	<!-- TOP NAVBAR-->
   <!--   <div class="container">
        <nav class="blog-nav text-right">
          <a class="blog-nav-item" href="user/profile">Профиль</a>
          <a class="blog-nav-item" href="user/logout">Выход</a>
        </nav>
      </div>
    </div> -->

	<div class="navbar navbar-fixed-top mynavbar" role="navigation">
		<div class="container mynavbar-item">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?=BASE_URL?>">phpfinansist</a>
			</div>
			<div class="navbar-collapse collapse navbar-right">
				<? if(isset($_SESSION['user_id'])): ?>
				<p class="navbar-text">
					<a href="user/profile" class="navbar-link mynavbar-item">Профиль</a>
				</p>
				<p class="navbar-text">
					<a href="user/logout" class="navbar-link mynavbar-item">Выход</a>
				</p>
				<? endif; ?>
			</div><!--/.navbar-collapse -->
		</div>
	</div>


	<div class="container"> 			<!--  HEADER-->
		<div class="row">
			<div class="col-md-12 text-center page-header">
				<h1></h1>
			</div>
		</div>
	</div>

 	<div class="row">				<!-- LEFT NAVBAR-->
		<div class="col-md-1 col-md-offset-2 left-menu">
			<ul class="nav nav-list">
				<? if(isset($_SESSION['user_id'])): ?>
    			<li><a href="<?=BASE_URL?>">Домой</a></li>
    			<li><a href="user">Операции</a></li>
    			<li><a href="operation/report">Отчет</a></li>
    			<li><a href="category">Категории</a></li>
				<? endif; ?>
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
