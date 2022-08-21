<?php

 include'header.php';
if(empty($_SESSION['userkullanici_mail'])){
	Header("Location:indexler/giris.php?durum=uyesiz");}
 ?>
<?php $siparisler = $db->query("SELECT * from siparisler WHERE kullanici_id=$kid and siparis_durum =1 order by siparis_id DESC", PDO::FETCH_OBJ)->fetchAll(); 

	$siparislerK = $db->query("SELECT * from siparisler WHERE kullanici_id=$kid and siparis_durum =2 order by siparis_id DESC", PDO::FETCH_OBJ)->fetchAll();

	$siparislerT = $db->query("SELECT * from siparisler WHERE kullanici_id=$kid and siparis_durum =3 order by siparis_id DESC", PDO::FETCH_OBJ)->fetchAll();
?>

<?php
 $siparisSay = count($siparisler);
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/siparislerim.css">
	<meta charset="utf-8">
	<title>Siparişlerim</title>
</head>
<body>

	<div class="block"></div>
<div class="contanier">
	<?php if($siparisSay > 0) {?>
		<div class="head"><h1>Siparislerim</h1></div>
		<div class="block"></div>
		<div class="head" style="background-color:#ebd190;"><h1 style="color:white;">Tedarik Edilen Ürünler</h1></div>
<?php foreach($siparisler as $siparis){ ?>
		
<div class="order">
	
		<?php if($siparis->siparis_durum == 1){ ?>
			<div style="background-color:#e4a914;" class="siparis-info">
		<h1>Tedarik Ediliyor...</h1>
		</div>
        <?php }elseif($siparis->siparis_durum == 2){ ?>
        	<div style="background-color:#396ae0;" class="siparis-info">
        	<h1>Kargoda</h1>
        	</div>
 		<?php }else{ ?>
 			<div style="background-color:#439e4a;" class="siparis-info">
 			<h1>Teslim Edildi</h1>
 			</div>
 			 <?php } ?>
	



	<span><p><b>Sipariş Tarihi</b><br><?php echo $siparis->siparis_zaman ?></p></span>
	<span><p><b>Sipariş Özeti</b><br><?php echo $siparis->urun_toplam_adet ?> adet ürün</p></span>
	<span><p><b>Alıcı</b><br><?php echo $kullanicicek['kullanici_adsoyad'] ?></p></span>
	<span><p>Toplam Tutar<br><?php echo $siparis->urun_toplam ?></p></span>
	<span><a href="siparisdetay.php?siparis_id=<?php echo $siparis->siparis_id ?>"><button class="btnDetail"><b>Siparis Detayı</b></button></a></span>
</div>

<?php } ?>
<div class="head" style="background-color:#8ea9ea;"><h1 style="color:white;">Kargodaki Ürünler</h1></div>
<?php foreach($siparislerK as $siparis){ ?>
		
<div class="order">
	
		<?php if($siparis->siparis_durum == 1){ ?>
			<div style="background-color:#e4a914;" class="siparis-info">
		<h1>Tedarik Ediliyor...</h1>
		</div>
        <?php }elseif($siparis->siparis_durum == 2){ ?>
        	<div style="background-color:#396ae0;" class="siparis-info">
        	<h1>Kargoda</h1>
        	</div>
 		<?php }else{ ?>
 			<div style="background-color:#439e4a;" class="siparis-info">
 			<h1>Teslim Edildi</h1>
 			</div>
 			 <?php } ?>
	



	<span><p><b>Sipariş Tarihi</b><br><?php echo $siparis->siparis_zaman ?></p></span>
	<span><p><b>Sipariş Özeti</b><br><?php echo $siparis->urun_toplam_adet ?> adet ürün</p></span>
	<span><p><b>Alıcı</b><br><?php echo $kullanicicek['kullanici_adsoyad'] ?></p></span>
	<span><p>Toplam Tutar<br><?php echo $siparis->urun_toplam ?></p></span>
	<span><a href="siparisdetay.php?siparis_id=<?php echo $siparis->siparis_id ?>"><button class="btnDetail"><b>Siparis Detayı</b></button></a></span>
</div>

<?php } ?>


<div class="head" style="background-color:#74f97e;"><h1 style="color:white;">Teslim Edilenler</h1></div>
<?php foreach($siparislerT as $siparis){ ?>
		
<div class="order">
	
		<?php if($siparis->siparis_durum == 1){ ?>
			<div style="background-color:#e4a914;" class="siparis-info">
		<h1>Tedarik Ediliyor...</h1>
		</div>
        <?php }elseif($siparis->siparis_durum == 2){ ?>
        	<div style="background-color:#396ae0;" class="siparis-info">
        	<h1>Kargoda</h1>
        	</div>
 		<?php }else{ ?>
 			<div style="background-color:#439e4a;" class="siparis-info">
 			<h1>Teslim Edildi</h1>
 			</div>
 			 <?php } ?>
	



	<span><p><b>Sipariş Tarihi</b><br><?php echo $siparis->siparis_zaman ?></p></span>
	<span><p><b>Sipariş Özeti</b><br><?php echo $siparis->urun_toplam_adet ?> adet ürün</p></span>
	<span><p><b>Alıcı</b><br><?php echo $kullanicicek['kullanici_adsoyad'] ?></p></span>
	<span><p>Toplam Tutar<br><?php echo $siparis->urun_toplam ?></p></span>
	<span><a href="siparisdetay.php?siparis_id=<?php echo $siparis->siparis_id ?>"><button class="btnDetail"><b>Siparis Detayı</b></button></a></span>
</div>

<?php } ?>

	<?php } else {?>
	<div class="alert-info"><img src="img/basket.svg"><h1>Hiç Siparişiniz bulunmamaktadır</h1></div>
	<?php }?>
</div>
<div class="block"></div>
<div class="block"></div>

</body>
</html>