<?php include'header.php'; ?>
<?php include'baglan/baglan.php'; ?>
<?php $urunler = $db->prepare("SELECT * from urunler where id=:id ");
$urunler->execute(array(
'id'=>$_GET['id']
));
$urunlercek=$urunler->fetch(PDO::FETCH_ASSOC)
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/detay.css">
  <link rel="stylesheet" href="swiper/swiper-bundle.min.css" />

<script src="swiper/swiper-bundle.min.js"></script>
	 
    <script src="js/detay.js"></script>

    <title> İncele</title>
</head>
<body>

  <div class="basket-alert"><p>Ürün Sepete Eklendi</p></div>
	<div class="block"></div>

<div class="contanier">
  <?php  {?>
	   <div class="swiper-container mySwiper">
      <div class="swiper-wrapper">
        <div  class="swiper-slide"><?php echo '<img  src="data:image;base64,'.base64_encode($urunlercek['slider_1']).'" >'; ?></div>
        <div id="myimage" class="swiper-slide"><?php echo '<img   src="data:image;base64,'.base64_encode($urunlercek['slider_2']).'" >'; ?></div>
        <div id="myimage" class="swiper-slide"><?php echo '<img  src="data:image;base64,'.base64_encode($urunlercek['slider_3']).'" >'; ?></div>
        <div id="myimage" class="swiper-slide"><?php echo '<img   src="data:image;base64,'.base64_encode($urunlercek['slider_4']).'" >'; ?></div>
        
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div style="bottom:0px;" class="swiper-pagination"></div>

    </div>
<div class="info">
  
	<div class="top">
		<h1><?php echo $urunlercek['urun_adi'] ?></h1>
	</div>
	
	<div class="bottom"><h2>
		<i><?php echo $urunlercek['urun_fiyati'] ?>Tl</i>
	</h2>

	
</div>
<div class="btn">
 

<button product-id="<?php echo $urunlercek['id'] ?>" class="btnsepet">
		<img src="img/basket.svg">Sepete Ekle
			</button> 
			    </div>
</div>

<div class="aciklama">
	<h1>Açıklama</h1><br>
	<p><?php echo $urunlercek['urun_aciklamasi'] ?></p>
</div>
<?php  }?>
</div>
    <script type="text/javascript">
    	var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>
   
<?php include'footer.php'; ?>