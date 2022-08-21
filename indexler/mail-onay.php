<?php session_start(); ?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/mail-onay.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Asap+Condensed&family=Montserrat:wght@500&family=Roboto+Condensed&family=Ropa+Sans&display=swap" rel="stylesheet">
	<meta charset="utf-8">
	<title>Onaylama Kodu</title>
</head>
<body>
<div class="contanier">
	<div class="content">
		<form action="../baglan/mail/sendmail.php" method="POST" role="form">
		<h1>
			İlk Önce Kodu Gönder'e Tıkla<br>E-postana Gelen<br>6 Haneli<br>Onay Kodunu Gir</h1>
		<input name="dogrulama_kodu" type="number" minlength="6" maxlength="6">
		<button name="sendmail" class="btnokey">Kodu Gönder</button>
		<button name="onaykodu" class="btnokey">Onayla</button>
		<a href="../index.php">Misafir Olarak Devam Et</a>
		</form>
	</div>
</div>
</body>
</html>