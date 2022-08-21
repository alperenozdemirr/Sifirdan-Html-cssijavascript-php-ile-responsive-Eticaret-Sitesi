<?php 
 		session_start();

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
<?php
if(empty($_SESSION['userkullanici_mail'])){
	Header("Location:indexler/giris.php?durum=uyesiz");}
 include'header.php'; ?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/odeme.css">
	<meta charset="utf-8">
	<title>Ödeme Sayfam</title>
</head>
<body>
	<form action="baglan/islem.php" method="POST" role="form">
		<?php foreach ($shopping_products as $product) { ?>
			<input type="hidden" name="urun_id[]" value="<?php echo $product->id ?>">
			<input type="hidden" name="urun_adet[]" value="<?php echo $product->count; ?>">
			<input type="hidden" name="urun_fiyat[]" value="<?php echo $product->urun_fiyati ?>">
		<?php } ?>
		<input type="hidden" name="urun_toplam_adet" value="<?php echo $total_count; ?>">
		<input type="hidden" name="urun_toplam" value="<?php echo $total_price; ?>">
		<input  name="kullanici_id" type="hidden" value="<?php echo $kullanicicek['kullanici_id'] ?>" >
		
		<button class="btnokey" type="submit" name="sipariskaydet">
	Ödemeyi kabul et ve siparis eklensin
</button>
	</form>

</body>
</html>