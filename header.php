<?php
 		session_start();
 		ob_start();
 		if(isset($_SESSION["shoppingCart"])){
 		$shoppingCart = $_SESSION["shoppingCart"];

 		$total_count = $shoppingCart["summary"]["total_count"];
 		$total_price = $shoppingCart["summary"]["total_price"];
 		$shopping_products = $shoppingCart["products"];

 		}else{
 			$total_count = 0;
 			$total_price = 0.0;
 		}
 		
	 ?>
	 <?php require_once 'baglan/baglan.php'; ?>
	 <?php  
if(!empty($_SESSION['userkullanici_mail'])){
		 $kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
$kullanicisor->execute(array(
  'mail' => $_SESSION['userkullanici_mail']
  ));
$say=$kullanicisor->rowCount();
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
$kid = $kullanicicek['kullanici_id']; 
}
?>
 
<?php $header = $db->query("SELECT * from header WHERE id=1", PDO::FETCH_OBJ)->fetch(); ?>


<html>
<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Asap+Condensed&family=Montserrat:wght@500&family=Roboto+Condensed&family=Ropa+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	
	
	
	
</head>
<body>
	<div id="loading">
		<div class="loader">
		<div class="load"></div>
	</div>
	</div>
	
<div class="navbar-contanier">
		<div class="mobil-navtop" id="mobil-navtop">
			<div onclick="navClose()" class="mobil-navClose">
				<img src="img/close.png">
			</div>
			<ul>
				<li><a href="index.php">Anasayfa</a></li>
				<?php 
                if (!isset($_SESSION['userkullanici_mail'])) {?>
				<li><a href="indexler/giris.php">Oturum Ac</a></li>
				<li><a href="sepet.php">Sepetim</a></li>
				
				<?php } else { ?>
					<li><a href=""><?php echo $kullanicicek['kullanici_mail'] ?></a></li>
				<li><a href="bilgilerim.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>">Kullanıcı Bilgileri</a></li>
				<li><a href="siparislerim.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>">Siparişlerim</a></li>
				<li><a href="logout.php">Güvenli Çıkış</a></li>
					<?php } ?>
				
				<li><a href="#footer">Yardım</a></li>
				
			</ul>
		</div>
		<div onclick="navOpen()" id="mobil-navbottom">
			<span class="navbottom-left"><h1><img src="img/menu-open.svg"> Menü</h1></span><a href="sepet.php"><span class="navbottom-right"><img src="img/mobil-basket.svg"><span class="mobil-sepet"><p class="sepet-say"><?php echo $total_count; ?></p></span></span></a>
		</div>
	</div>
<div class="navbar-top">
	<span>
	<h1>DESTEK-</h1>
	<h1><u><?php echo $header->destek_mail ?></u></h1>
</span>
	<span class="icons">
		<a href="<?php echo $header->facebook_url ?>"><img src="img/facebook.svg"></a>
		<a href="<?php echo $header->twiter_url ?>"><img src="img/twitter.svg"></a>
		<a href="<?php echo $header->instagram_url ?>"><img src="img/instagram.svg"></a>
	</span>
</div>
<div class="navbar-mid">
	
		<a href="index"><?php echo '<img alt="LOGO" src="data:image;base64,'.base64_encode($header->logo).'" >'; ?></a>
		<span class="search-content">
			<form action="arama.php" method="post" role="form">
			<input class="search" name="search" placeholder="Ne Arıyorsunuz?"><button class="search-btn" type="submit"><img src="img/loupe.svg"></button>
		</form>
		</span>
			
		
	    <span class="user">
	    	<span class="sepet"><a href="sepet.php"><img src="img/basket.svg"><p class="sepet-say"><b><?php echo $total_count; ?></b></p></a></span>
	    	<?php 
if (!isset($_SESSION['userkullanici_mail'])) {?>

             <a href="indexler/giris.php"><h1><img src="img/user.svg">Giriş Yap</h1></a>

             <?php } else { ?>
             <div class="account" id="account">
              <div class="account-top">
              	<p>Hesabım</p>
              </div>
             <div class="account-bottom">
             	<ul>
             		<li><a href=""><u><?php echo $kullanicicek['kullanici_mail'] ?></u></a></li>
             		<li><a href=""><?php echo $kullanicicek['kullanici_adsoyad'] ?></a></li>
             		<li><a href="siparislerim.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>"><img src="img/siparis.svg">Siparişlerim</a></li>
             		<li><a href="bilgilerim.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>"><img src="img/user2.svg">Kullanıcı Bilgilerim</a></li>
             		<li><a href="logout.php"><img src="img/exit.png">Güvenli Çıkış</a></li>
             	</ul>
              </div>
             </div>
             <?php } ?>
	    	
	    </span>
</div>
<div class="navbar-bottom">
	<span class="menu">
	<ul>
		<li><a href="index.php"><b>Anasayfa</b></a></li>
		<li><a href="index.php"><b>Ürünlerimiz</b></a></li>
		<li><a href="#footer"><b>Hakkımızda</b></a></li>
		<li><a href="#footer"><b>İletişim</b></a></li>
	<ul>
		<span>
</div>

<script src="js/jquery-3.6.0.min.js"></script>

<script src="js/script.js"></script>
<script src="js/custom.js"></script>
