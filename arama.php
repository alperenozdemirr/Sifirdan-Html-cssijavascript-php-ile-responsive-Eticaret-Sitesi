<?php include'header.php';
$arama = htmlspecialchars($_POST['search']);
if(empty($arama)){
	Header("Location: index.php");
}
$urun = $db->query("SELECT * from urunler WHERE urun_adi like '%$arama%' ", PDO::FETCH_OBJ)->fetchAll();
$sonucSay = count($urun);
// SELECT * FROM `haber` WHERE baslik like '%arama%';
 ?>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<title>Sonuçlar(<?php echo $sonucSay ?>)</title>
	<style>
		.info-serach{
			width:90%;
			padding-bottom:15px;
			padding-top:15px;
			background-color:#d3d2b4;
			display:flex;
			justify-content: center;
			align-items: center;
			float: left;
			margin-top:40px;
			padding-left:5%;
			padding-right:5%;
		}
		.info-serach h1{
			font-size:18px;
			color: white;
		}
		.info-serach img{
			width:30px;
			height: auto;
			margin-right:10px;
		}
	</style>
</head>
<body>
	<div class="basket-alert"><h1>Ürün Sepete Eklendi</h1></div>
<div id="contanier" class="contanier">
	<div class="info-serach"><img src="img/loupe.svg"><h1>Ürünler İçerisinde <span style="color:black"><u>"<?php echo $arama; ?>"</u></span> Cümlesi Bulunan <span style="color:black">(<?php echo $sonucSay ?>)</span> Adet Ürün Bulundu
	</h1>

	</div>
	<?php foreach ($urun as $urunler) {?>
		<div class="product">
			<a href="detay.php?id=<?php echo $urunler->id; ?>">
			<div class="top">
				<?php echo '<img class="lazy" src="data:image;base64,'.base64_encode($urunler->slider_1).'" >'; ?>
			</div>
		</a>
			<div class="bottom-1">
				<h1><?php echo substr($urunler->urun_adi,0,40) ?>...
					<br>
				</h1>
				<h2><i><?php echo $urunler->urun_fiyati ?> TL</i></h2>
			</div>
			<div class="bottom-2">
				<button product-id="<?php echo $urunler->id ?>" class="btnsepet">
					<img src="img/basket.svg"><b>Sepete Ekle</b>
				</button> 
			    <a href="detay.php?id=<?php echo $urunler->id; ?>" class="btndetay">
			    	<img src="img/detay.svg"><b>Ürünü İncele</b>
			    </a>
			</div>
	</div>
	<?php }?>
	
</div>

</body>
</html>