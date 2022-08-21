<?php 
session_start();
if(empty($_SESSION['userkullanici_mail'])){
	Header("Location:indexler/giris.php?durum=uyesiz");}
include'header.php'; ?>
<?php $siparisler = $db->query("SELECT * from siparis_detay WHERE siparis_id={$_GET['siparis_id']}", PDO::FETCH_OBJ)->fetchAll();
?>
<?php $siparisdurumu = $db->query("SELECT * from siparisler WHERE kullanici_id=$kid", PDO::FETCH_OBJ)->fetch(); ?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/siparisdetay.css">
	<meta charset="utf-8">
	<title>Sipariş Detayım</title>
</head>
<body>
<div class="contanier">
	<div class="user-info">
		<div class="top">
			<h1>Teslimat Bilgileri</h1>
		</div>
		<div class="mid">
			<h1><u>Teslim Edilen Kişi:</u> <?php echo $kullanicicek['kullanici_adsoyad'] ?><br></h1>
			<h1><u>İletişim:</u> <?php echo $kullanicicek['kullanici_mail'] ?><br></h1>
			<h1><u>Teslim Edilen Adres:</u> <?php echo $kullanicicek['kullanici_adres'] ?><br></h1>
			<h2><a href="bilgilerim.php">Siparis Adresimi Güncelle</a></h2>
		</div>
	</div>
	<div class="user-info">
		<div class="top">
			<h1>Ödeme Bilgileri</h1>
		</div>
		<div class="mid">
			<h1><u>Teslim Edilen Kişi:</u> <?php echo $kullanicicek['kullanici_adsoyad'] ?><br></h1>
			<h1><u>İletişim:</u> <?php echo $kullanicicek['kullanici_mail'] ?><br></h1>
			<h1><u>Teslim Edilen Adres:</u> <?php echo $kullanicicek['kullanici_adres'] ?><br></h1>
		</div>
	</div>
<?php foreach($siparisler as $siparis) { ?>
		<?php  $sid = $siparis->urun_id ?>
		<?php 
		$urunsor=$db->prepare("SELECT * FROM urunler WHERE id=:id");
	$urunsor->execute(array(
		'id' => $sid
	));
	$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
	// php echo $uruncek['urun_adi']; 
		 ?>
	<div class="order">
		 	<div class="image">
		<?php echo '<img src="data:image;base64,'.base64_encode($uruncek['slider_1']).'" >'; ?>
				</div>
			<span class="info">
				<h1><?php echo $uruncek['urun_adi'] ?></h1><br>
				<p class="green" style="font-size:15px;"><?php echo $uruncek['urun_fiyati'] ?> TL</p>
			</span>
		<span>
			<h1>Adeti: <?php echo $siparis->urun_adet ?> adet</h1>
		</span>
			
	</div>
	
<?php } ?>
<div class="siparis-info"><h1><img src="img/siparis.svg">Sipariş Durumu<br></h1>
<?php if($siparisdurumu->siparis_durum == 1){ ?>
			<div style="background-color:#e4a914;" class="siparis-durum">
		<h2>Tedarik Ediliyor...</h2>
		</div>
        <?php }elseif($siparisdurumu->siparis_durum == 2){ ?>
        	<div style="background-color:#396ae0;" class="siparis-durum">
        	<h2>Kargoda</h2>
        	</div>
 		<?php }else{ ?>
 			<div style="background-color:#439e4a;" class="siparis-durum">
 			<h2>Teslim Edildi</h2>
 			</div>
 			 <?php } ?>
 		<h2><u>Ödenen Tutar:</u> <?php echo $siparisdurumu->urun_toplam ?> TL<br> </h2>
 		<h2><u>Sipariş Özeti:</u> <?php echo $siparisdurumu->urun_toplam_adet ?> Adet Ürün<br> </h2>
 		<h2><u>Alıcı:</u> <?php echo $kullanicicek['kullanici_adsoyad'] ?><br></h2>
</div>
</div>

<div class="block"></div>
</body>
</html>