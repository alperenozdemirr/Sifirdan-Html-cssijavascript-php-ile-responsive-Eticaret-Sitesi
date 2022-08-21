<?php 

include'header.php';
if(empty($_SESSION['userkullanici_mail'])){
	Header("Location:indexler/giris.php?durum=uyesiz");}
 ?>
<html>
<head>
	<meta charset="utf-8">
	<title>Kullanıcı Bilgilerimi Güncelleme</title>
	<link rel="stylesheet" type="text/css" href="css/bilgilerim.css">
</head>
<body>
	<div class="contanier">
		<div class="content">
			<div class="baslik">
<h1>Kullanıcı Bilgilerim</h1></div>
<form action="baglan/islem.php" method="POST" role="form">
	
	<h1>Adınız Soyadınız</h1><br><input name="bilgilerim_adsoyad" type="text" value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>" >
	<h1>Telefon Numaranız</h1><br><input name="bilgilerim_tel" type="text" value="<?php echo $kullanicicek['kullanici_tel'] ?>" >
	<h1>Teslimat Adresiniz</h1><br><textarea name="bilgilerim_adres"><?php echo $kullanicicek['kullanici_adres'] ?></textarea>
	<input  name="kullanici_id" type="hidden" value="<?php echo $kullanicicek['kullanici_id'] ?>" >
	<button class="update" name="bilgiUpdate" type="submit" >Bilgilerimi Güncelle</button>
</form>
</div>
</div>
<div class="block"></div>
</body>
</html>