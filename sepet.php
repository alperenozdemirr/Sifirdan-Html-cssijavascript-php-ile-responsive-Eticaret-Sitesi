<?php 
 		
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
	 <?php include'header.php'; ?>
<head>
	<link rel="stylesheet" type="text/css" href="css/sepet.css">
	<title>Sepetim (<?php echo $total_count; ?>) </title>

</head>
<body>

	<div class="block"></div>
	<?php if($total_count > 0){?>
	<div class="contanier">
		<a href="index.php"><button class="next">Alış Verişe Devam Et</button></a>
<h1>Sepetim</h1>
<div class="content">

	<?php foreach ($shopping_products as $product) { ?>

<div class="product">

	<span>
	<div class="image">
		<?php echo '<img src="data:image;base64,'.base64_encode($product->slider_1).'" >'; ?>
	</div>
	<span class="info">
	<h1>
		<?php echo substr($product->urun_adi,0,55) ?>...
	</h1>
	<p class="green"><?php echo $product->urun_fiyati ?> TL</p>
</span>
	</span>

<span>
	<span>
	
		
	
	</span>
</span>
<span class="price">
	<span class="adet">
			
<span><a href="baglan/islem.php?p=decCount&product_id=<?php echo $product->id; ?>" class="eksi">-</a></span><p><span id="adt"><?php echo $product->count; ?></span><br> Adet</p><span><a href="baglan/islem.php?p=incCount&product_id=<?php echo $product->id; ?>" class="arti">+</a></span>
	</span>
	<button class="btnremove" product-id="<?php echo $product->id; ?>">Sil</button>
</span>
	</div>

	<?php } ?>
	




	
</div>



<div class="total">
<div class="top1">
	<h1>Sipariş Özeti</h1>
</div>	
<div class="top2"><h1>Toplam Fiyat: <?php echo $total_price ?> TL</h1></div>
<div class="top3"><h1>Toplam Ürün Sayisi : <?php echo $total_count ?> adet</h1></div>
<div class="bottom"><hr>
	<h1>Ödenecek Tutar: <span style="color: #439e4a;"><?php echo $total_price ?> TL</span></h1></div>
<div class="btn">
	
		
	<a href="siparisbilgilerim.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>"><button type="submit" class="okey">Sepeti Onayla</button></a>
	
</div>
</div>





</div>
 <?php } else { ?>
<div class="alert"><h1>Sepetinizde Hiç Ürün Bulunmamaktadır Ürün Eklemek İçin <a href="index.php">Tıklayınız!</a></h1></div>
<?php } ?>
<div class="block"></div>


</body>
</html>