
<?php 

include "db.php";

$result = mysqli_query($connect, "SELECT * FROM `catalogs`");
while ($catalogs = mysqli_fetch_assoc($result)) 
{
	$catalog[] = $catalogs;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="main.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Главная страница</title>
</head>
<body>

	<header>
		<h1><a href="main.php" title="На главную">Интерактивный каталог елементов электрических схем систем Arduino</a></h1>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="main-head">
						<div id="carouselExampleIndicator" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-tardet="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
								<li data-tardet="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
								<li data-tardet="#carouselExampleIndicators" data-slide-to="2" class="active"></li>	
							</ol>
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img src="arduino_top1.png" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="arduino_top2.png" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="arduino_top3.png" class="d-block w-100" alt="...">
								</div>
							</div>
							<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Предыдущее</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Следующее</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="main-menu">
						<div class="title">
							<h3>Ручной поиск</h3>
							<div class="text">
								<form action="main.php?go" method="POST" id="searchform">
									<div class="mb-3">
										<label for="exampleInputPassword1" class="form-label">Поиск по названию</label>
										<input type="text" name="name">
									</div>                              
									<button type="submit" name="submit" class="btn btn-danger btn-block">Поиск</button>
								</form>
							</div>
						</div>
					</div> 
					<div class="main-menu">
						<div class="title">
							<h3>Поиск по списку</h3>
						</div>
						<div class="text">
							<nav><ul><div class="string-top"></div><?php foreach($catalog as $catal) { ?>
								<li><a href="#"><?php echo $catal['title'] ?></a></li><?php }?>
								<div class="string-bot"></div></ul>
							</nav>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<?php  if (isset($_POST['submit'])) 
                {
                    $name = $_POST['name'];
                    $poisk = " SELECT * FROM `catalogs` WHERE `title` LIKE '%" . $name . "%' OR `info` LIKE '%" . $name . "%'";
                    $pattern = mysqli_query($connect, $poisk);
 
                    while ($patt = mysqli_fetch_array($pattern)) 
                    {
                        $title = $patt['title'];
                        $info = $patt['info'];
                        $image = $patt['image'];
                        $text = $patt['text'];                 
                    ?><div class="main"><div class="title"><h3><?php echo $title; ?></h3></div><div class="info"><p><?php echo $info; ?></p></div><div class="mesage"><div class="row"><div class="col-md-5"><div class="image"><img src="<?php echo $image; ?>" alt=""></div></div><div class="col-md-7"><div class="text"><p><?php echo $text; ?></p></div>
					</div></div></div></div><?php
                     }                   
                  } else  {
						foreach($catalog as $catalogs) {
								?>

								<div class="main"><div class="title"><h3><?php echo $catalogs['title']; ?></h3></div><div class="info">
								<p><?php echo $catalogs['info']; ?></p></div><div class="mesage"><div class="row"><div class="col-md-5">
								<div class="image"><img src="<?php echo $catalogs['image']; ?>" alt=""></div></div><div class="col-md-7">
								<div class="text"><p><?php echo $catalogs['text']; ?></p></div></div></div></div></div><?php }}
							?>	
								</div>
							</div>
						</div>
					</section>
				</body>
				</html>
