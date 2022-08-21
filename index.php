<?php include 'header.php'; ?>
<?php require_once 'baglan/baglan.php'; ?>
<?php $siSay = $db->query("SELECT * from urunler order by id DESC", PDO::FETCH_OBJ)->fetchAll(); 
if(isset($_GET['s'])){
	$sayfa = $_GET['s'];
}

if (empty($sayfa) || !is_numeric($sayfa)){
  $sayfa =1;
}
$kacar =12;
$ksayisi = count($siSay);
$ssayisi = ceil($ksayisi/$kacar);
$nereden = ($sayfa*$kacar)-$kacar;
$urun = $db->query("SELECT * from urunler order by id DESC Limit $nereden,$kacar", PDO::FETCH_OBJ)->fetchAll();
?>

<head>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<title>Anasayfa</title>
	<style>
		.pagination{
	width:100%;
	height:50px;
	background-color:white;
	float: left;
	display: flex;
	justify-content: center;
	align-items: center;
padding-bottom:50px;
}
.pagination ul a{
	float: left;
	list-style-type: none;
	width:30px;
	line-height:35px;
	border:1px solid #c3bcb4;
display: flex;
align-items: center;
justify-content: center;
transition:0.5s;
cursor: pointer;
}

.pagination ul a{
	text-decoration: none;
	color: black;

font-size:;
}
.pagination ul a:hover{
	background-color:c3bcb4 ;
}
	</style>
</head>
<body>
	<div class="basket-alert"><h1>Ürün Sepete Eklendi</h1></div>
<div id="contanier" class="contanier">
	<?php foreach ($urun as $urunler) {?>
		<div class="product">
			<a href="detay?id=<?php echo $urunler->id; ?>">
			<div class="top">
				<?php echo '<img class="lazy" src="data:image;base64,'.base64_encode($urunler->slider_1).'" >'; ?>
			</div>
		</a>
			<div class="bottom-1">
				<h1><?php echo substr($urunler->urun_adi,0,32) ?>...
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
<div class="pagination">
	<ul>
		<?php for ($i=1; $i<=$ssayisi; $i++) { ?> 
<a href="index.php?s=<?php echo $i ?>"><?php echo $i ?></a>
         

    <?php } ?>
		
	</ul>
</div>
<?php include'footer.php'; ?> 