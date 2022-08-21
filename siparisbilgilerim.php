<?php 
include'header.php'; 
if(empty($_SESSION['userkullanici_mail'])){
	Header("Location:indexler/giris.php?durum=uyesiz");
}


	
	

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/siparisbilgilerim.css">
	<meta charset="utf-8">
	<title>Sipariş Bilgilerim</title>
</head>
<body>
	<div class="block"></div>
<div class="contanier">
	<?php if($total_count > 0) {?>
		<h1>Sipariş Teslimat Bilgileri</h1>

		<form action="baglan/islem.php" method="POST" role="form">
			

			<h2>Siparis Adresiniz</h2>
			<textarea name="kullanici_adres"><?php echo $kullanicicek['kullanici_adres'] ?></textarea>
			
			<h2>Posta Kodunuz</h2>
			<input type="number" value="<?php echo $kullanicicek['kullanici_posta_kodu'] ?>" name="kullanici_posta_kodu">

			<h2>Şehriniz</h2>
			<input type="text" value="<?php echo $kullanicicek['kullanici_sehir'] ?>"  name="kullanici_sehir">

			<h2>Telefon Numaranız</h2>
			<input type="text" value="<?php echo $kullanicicek['kullanici_tel'] ?>"  name="kullanici_tel">

			<input  name="kullanici_id" type="hidden" value="<?php echo $kullanicicek['kullanici_id'] ?>" >

			<button  type="submit" class="btnOnay" name="siparisbilgilerim">Ödeme ile Devam Et</button>
		</form>







	<?php } else {?>
	<div class="alert-info"><img src="img/basket.svg"><h1>Hiç Siparişiniz bulunmamaktadır</h1></div>
</div>
<?php }?>
<div class="block"></div>
<div class="block"></div>
</body>
</html>