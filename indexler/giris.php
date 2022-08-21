<?php session_start(); 


?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/giris.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Asap+Condensed&family=Montserrat:wght@500&family=Roboto+Condensed&family=Ropa+Sans&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="../js/script.js"></script>
	<title>Giriş Yap</title>
</head>
<body>
<div class="contanier">
 	<?php 
 	if(isset($_GET['hata'])){
 	if($_GET['hata']=="smtp"){ ?>
	<div id="alert-danger"><h1>!HATA KOD: Smtp</h1><br><p>Admin ile İletişime Geç</p>
		<span onclick="exit()" id="exit">&#215;</span>
	</div>
<?php }} ?>
<?php if(isset($_GET['durum'])){
if($_GET['durum']=="uyesiz"){ ?>
	<div id="alert-danger"><h1>Alışveriş'i Tamamlayabilmek için<br>ilk önce Üye ol ve Giriş Yap<br>Sonra Alışverişi Tamamla</h1>
		<span onclick="exit()" id="exit">&#215;</span>
	</div>
<?php }} ?>
	<div class="top">
		<button onclick="girisOpen()" id="btn-topgiris" class="btn-topgiris">Giriş Yap</button>
	<button onclick="uyeOpen()" id="btn-topuye" class="btn-topuye">Üye ol</button>
	</div>
<form action="../baglan/islem.php" method="POST" role="form" >
	<span id="giris" class="giris">
	<h1>Giriş Yap</h1>
	<input type="email" name="kullanici_mail" placeholder="E-Posta Giriniz">
	<input type="password" name="kullanici_password" placeholder="Şifrenizi Giriniz">
	<button type="submit" name="kullanicigiris" class="btn-okey">Giriş Yap</button>
	<a class="location" href="../index.php">Misafir Olarak Devam Et</a>
	<?php 

if(isset($_GET['durum'])){
if ($_GET['durum']=="basarisizgiris") {?>

				<h1 class="alert">
					Hata! Şifre veya E-posta Yanlış Tekrar Deneyiniz.
				</h1>
			<?php }}?>

</span>



</form>


	<form action="../baglan/islem.php" method="POST" role="form" >
		<span id="uye" class="uye">
		
		
		<h1>Uye Ol</h1>
		<input type="text" name="kullanici_adsoyad" placeholder="Adınız Soyadınız">
		<input type="email" name="kullanici_mail" placeholder="E-Posta Giriniz">
		<input type="password" name="kullanici_passwordone" placeholder="Şifrenizi Giriniz">
		<input type="password" name="kullanici_passwordtwo" placeholder="Tekrar Şifrenizi Giriniz">
		<input type="text" name="kullanici_tel" placeholder="Tel no">
		<button type="submit" name="mail_dogrula" class="btn-okey">Uye Ol</button>
		<a class="location" href="../index.php">Misafir Olarak Devam Et</a>
		<?php 
				if(isset($_GET['durum'])){
				if ($_GET['durum']=="farklisifre") {?>

				<h1 class="alert">
					Hata! Girdiğiniz şifreler eşleşmiyor.
				</h1>
					
				<?php } elseif ($_GET['durum']=="eksiksifre") {?>

				<h1 class="alert">
					Hata! Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
				</h1>
					
				<?php } elseif ($_GET['durum']=="mukerrerkayit") {?>

				<h1 class="alert">
					Hata! Bu kullanıcı daha önce kayıt edilmiş.
				</h1 class="alert">
					
				<?php } elseif ($_GET['durum']=="basarisiz") {?>

				<h1 class="alert">
					Hata! Kayıt Yapılamadı Sistem Yöneticisine Danışınız.
				</h1>
					
				<?php }}
				 ?>
		</span>

		
	</form>
</div>

</body>
</html>