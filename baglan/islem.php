<?php
ob_start();
session_start();
include'baglan.php';

function islemkontrol () {
if(empty($_SESSION['userkullanici_mail'])){
	Header("Location:../?durum=izinyok");
	exit;
}
	
}

function adminkontrol () {
if(empty($_SESSION['admin_mail'])){
	Header("Location:../../?durum=admindegilsin");
	exit;
}
}


function addToCart($product_item){

if(isset($_SESSION["shoppingCart"])){

	$shoppingCart = $_SESSION["shoppingCart"];
	$products = $shoppingCart["products"];

} else {
	$products = array();
}
 //adet kontolu

if(array_key_exists($product_item->id, $products)){
	$products[$product_item->id]->count++;
} else {
	$products[$product_item->id] = $product_item;
	 //print_r($products);
}

//  TODO
//sepet hesaplama
$total_price = 0.0;
$total_count = 0;

foreach ($products as $product){

$product->total_price = $product->count * $product->urun_fiyati;
	$total_price = $total_price + $product->total_price;
	$total_count += $product->count;
}

//echo $total_count . " => " . $total_price;


$summary["total_price"] = $total_price;
$summary["total_count"] = $total_count;

$_SESSION["shoppingCart"]["products"] = $products;
$_SESSION["shoppingCart"]["summary"] = $summary;

return $total_count;

}

//$_SESSION["shoppingCart"]["products"] = $products;





function removeFromCart($product_id){

	if(isset($_SESSION["shoppingCart"])){

	$shoppingCart = $_SESSION["shoppingCart"];
	$products = $shoppingCart["products"];

     //ürünü listeden çıkar
	if(array_key_exists($product_id, $products)){
		unset($products[$product_id]);
	}

	$total_price = 0.0;
$total_count = 0;

foreach ($products as $product){

$product->total_price = $product->count * $product->urun_fiyati;
	$total_price = $total_price + $product->total_price;
	$total_count += $product->count;
}

//echo $total_count . " => " . $total_price;


$summary["total_price"] = $total_price;
$summary["total_count"] = $total_count;

$_SESSION["shoppingCart"]["products"] = $products;
$_SESSION["shoppingCart"]["summary"] = $summary;
return true;
} 
	
}



function incCount($product_id){
	if(isset($_SESSION["shoppingCart"])){

	$shoppingCart = $_SESSION["shoppingCart"];
	$products = $shoppingCart["products"];
//adet kontolu

if(array_key_exists($product_id, $products)){
	$products[$product_id]->count++;
} 

//  TODO
//sepet hesaplama
$total_price = 0.0;
$total_count = 0;

foreach ($products as $product){

$product->total_price = $product->count * $product->urun_fiyati;
	$total_price = $total_price + $product->total_price;
	$total_count += $product->count;
}

//echo $total_count . " => " . $total_price;


$summary["total_price"] = $total_price;
$summary["total_count"] = $total_count;

$_SESSION["shoppingCart"]["products"] = $products;
$_SESSION["shoppingCart"]["summary"] = $summary;

return true;
} 
 
}
function decCount($product_id){
	if(isset($_SESSION["shoppingCart"])){

	$shoppingCart = $_SESSION["shoppingCart"];
	$products = $shoppingCart["products"];
//adet kontolu

 if(array_key_exists($product_id, $products)) {
   $products[$product_id]->count--;

   if(!$products[$product_id]->count > '0'){
   unset($products[$product_id]);
   }
  }

//  TODO
//sepet hesaplama
$total_price = 0.0;
$total_count = 0;

foreach ($products as $product){

$product->total_price = $product->count * $product->urun_fiyati;
	$total_price = $total_price + $product->total_price;
	$total_count += $product->count;
}

//echo $total_count . " => " . $total_price;


$summary["total_price"] = $total_price;
$summary["total_count"] = $total_count;

$_SESSION["shoppingCart"]["products"] = $products;
$_SESSION["shoppingCart"]["summary"] = $summary;

return true;
}
}

if(isset($_POST["p"])){

	$islem = $_POST["p"];

	if($islem == "addToCart"){

		$id = $_POST["product_id"];
		
        
        $product = $db->query("SELECT * FROM urunler WHERE id={$id}", PDO::FETCH_OBJ)->fetch();
       $product->count = 1;

       echo addToCart($product);
       

		
	} else if($islem == "removeFromCart"){
      $id = $_POST["product_id"];

      echo removeFromCart($id);
	}
}

if(isset($_GET["p"])){

	$islem = $_GET["p"];

	if($islem == "incCount"){

		$id = $_GET["product_id"];

       if(incCount($id)){
       	header("Location:../sepet.php");
       }
	
	} else if($islem == "decCount"){
      $id = $_GET["product_id"];

    if(decCount($id)){
       	header("Location:../sepet.php");
       }
	}
}






/*  giriş yap üye ol işlemleri -----------*/
if(isset($_POST['mail_dogrula'])){

	unset($_SESSION["kullanici_adsoyad"]);
	unset($_SESSION["kullanici_mail"]);
	unset($_SESSION["kullanici_passwordone"]);
	unset($_SESSION["kullanici_passwordtwo"]);
	unset($_SESSION["kullanici_tel"]);

$kullanici_adsoyad=htmlspecialchars($_POST['kullanici_adsoyad']); 
$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);

$kullanici_passwordone=trim($_POST['kullanici_passwordone']); 
$kullanici_passwordtwo=trim($_POST['kullanici_passwordtwo']); 
$kullanici_tel=trim($_POST['kullanici_tel']);


if($kullanici_passwordone==$kullanici_passwordtwo) {
		if(strlen($kullanici_passwordone)>=6) {
	if($kullanici_adsoyad =="" || $kullanici_mail =="" || $kullanici_passwordone =="" || $kullanici_passwordtwo =="" || $kullanici_tel ==""){
header("Location:../indexler/giris.php?durum=eksikbilgi");
	}else{
		 $_SESSION['kullanici_adsoyad']=$kullanici_adsoyad; 
$_SESSION['kullanici_mail']=$kullanici_mail;
$_SESSION['kullanici_passwordone']=$kullanici_passwordone; 
$_SESSION['kullanici_passwordtwo']=$kullanici_passwordtwo; 
$_SESSION['kullanici_tel']=$kullanici_tel;
header("Location:../indexler/mail-onay.php");
	
}
		}else{


			header("Location:../indexler/giris.php?durum=eksiksifre");


		}

	}else{



		header("Location:../indexler/giris.php?durum=farklisifre");
	}

}



 
 /*if(isset($_POST['kullanicikaydet'])) {
 	//isaret
 $kullanici_adsoyad = $_SESSION['kullanici_adsoyad']; 
$kullanici_mail = $_SESSION['kullanici_mail'];

$kullanici_passwordone = $_SESSION['kullanici_passwordone']; 
$kullanici_passwordtwo = $_SESSION['kullanici_passwordtwo']; 
$kullanici_tel = $_SESSION['kullanici_tel']; 

	if($kullanici_passwordone==$kullanici_passwordtwo) {


		if(strlen($kullanici_passwordone)>=6) {


			

			


// Başlangıç

			$kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail");
			$kullanicisor->execute(array(
				'mail' => $kullanici_mail
				));

			//dönen satır sayısını belirtir
			$say=$kullanicisor->rowCount();



			if($say==0) {

				//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$password=md5($kullanici_passwordone);

				$kullanici_yetki=1;


			//Kullanıcı kayıt işlemi yapılıyor...
				$kullanicikaydet=$db->prepare("INSERT INTO kullanici SET
					kullanici_adsoyad=:kullanici_adsoyad,
					kullanici_mail=:kullanici_mail,
					kullanici_password=:kullanici_password,
					kullanici_tel=:kullanici_tel,
					kullanici_yetki=:kullanici_yetki
					");
				$insert=$kullanicikaydet->execute(array(
					'kullanici_adsoyad' => $kullanici_adsoyad,
					'kullanici_mail' => $kullanici_mail,
					'kullanici_password' => $password,
					'kullanici_tel' => $kullanici_tel,
					'kullanici_yetki' => $kullanici_yetki
					));
								
				if($insert) {


					header("Location:../index.php?durum=loginbasarili");


				

				}else{


					header("Location:../indexler/giris.php?durum=basarisiz");
				}

			}else{

				header("Location:../indexler/giris.php?durum=mukerrerkayit");



			}




		// Bitiş



		}else{


			header("Location:../indexler/giris.php?durum=eksiksifre");


		}



	}else{



		header("Location:../indexler/giris.php?durum=farklisifre");
	}
	
 }*/




 /* kullanici giriş */

 if(isset($_POST['kullanicigiris'])) {


	
$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']); 
$kullanici_password=md5($_POST['kullanici_password']); 



	$kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail and kullanici_yetki=:yetki and kullanici_password=:password");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'yetki' => 1,
		'password' => $kullanici_password
		));


	$say=$kullanicisor->rowCount();



	if($say==1) {

	 $_SESSION['userkullanici_mail']=$kullanici_mail;

		header("Location:../index.php?durum=basariligiris");
		exit;
		




	}else{


		header("Location:../indexler/giris.php?durum=basarisizgiris");

	}


}
/* site giriş yap üye ol işlemleri son ---------- */





if(isset($_POST['bilgiUpdate'])){
	islemkontrol();
$bilgilerKaydet=$db->prepare("UPDATE kullanici SET
  					kullanici_adsoyad=:kullanici_adsoyad,
					kullanici_tel=:kullanici_tel,
					kullanici_adres=:kullanici_adres
					WHERE kullanici_id={$_POST['kullanici_id']}
	");

	$bilgiUpdate=$bilgilerKaydet->execute(array(
					'kullanici_adsoyad' => htmlspecialchars($_POST['bilgilerim_adsoyad']),
					'kullanici_tel' => htmlspecialchars($_POST['bilgilerim_tel']),
					'kullanici_adres' => htmlspecialchars($_POST['bilgilerim_adres'])
					));

	if ($bilgiUpdate) {
    	header("Location:../bilgilerim.php?durum=ok");
        exit;

    } else {
    	header("Location:../bilgilerim.php?durum=no");
        exit;
    }
}
/* siparis böolümünün adres bilgi lerini giriş işlemleri */

if(isset($_POST['siparisbilgilerim'])){
	if(empty($_SESSION['userkullanici_mail'])){
	Header("Location:../indexler/giris.php?durum=uyesiz");
	exit;
}else{
	if($_POST['kullanici_posta_kodu'] == "" || $_POST['kullanici_sehir'] == "" 
	|| $_POST['kullanici_tel'] == "" || $_POST['kullanici_adres'] == ""){
		header("Location:../siparisbilgilerim.php?durum=no");
        exit;
	}else{
		
		$siparisbilgileriKaydet=$db->prepare("UPDATE kullanici SET
  					kullanici_posta_kodu=:kullanici_posta_kodu,
					kullanici_sehir=:kullanici_sehir,
					kullanici_tel=:kullanici_tel,
					kullanici_adres=:kullanici_adres
					WHERE kullanici_id={$_POST['kullanici_id']}
	");

	$siparisbilgiUpdate=$siparisbilgileriKaydet->execute(array(
					'kullanici_posta_kodu' => htmlspecialchars($_POST['kullanici_posta_kodu']),
					'kullanici_sehir' => htmlspecialchars($_POST['kullanici_sehir']),
					'kullanici_tel' => htmlspecialchars($_POST['kullanici_tel']),
					'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres'])
					));

	if ($siparisbilgiUpdate) {
    	header("Location:../odeme.php?durum=ok");
        exit;

    } else {
    	header("Location:../siparislerim.php?durum=no");
        exit;
    }
}//burası 
}
	}

$adetsay = 0;
$fiyatsay = 0;
/* sipariş okeyleme işlemi */
 if(isset($_POST['sipariskaydet'])){
 	islemkontrol();
 	$siparis_durum =1;
$siparisKaydet=$db->prepare("INSERT into siparisler SET
  					urun_toplam_adet=:urun_toplam_adet,
  					urun_toplam=:urun_toplam,
  					urun_id=:urun_id,
  					kullanici_id=:kullanici_id,
  					siparis_durum=:siparis_durum
					
	");

	$siparisyaz=$siparisKaydet->execute(array(
					'kullanici_id' => $_POST['kullanici_id'],
					'urun_toplam' => $_POST['urun_toplam'],
					'urun_id' => $_POST['urun_id'],
					'urun_toplam_adet' => $_POST['urun_toplam_adet'],
					'siparis_durum' => $siparis_durum
					));

 		if($siparisyaz){
 			//header("Location:../odeme.php?durum=ok");

 			echo $siparis_id = $db->lastInsertId();
 			echo "<hr>";

 			$urunler = $_POST['urun_id'];
 			$fiyatlar = $_POST['urun_fiyat'];
 			$adetler = $_POST['urun_adet'];
 			
 			$kullanici_yetki =1;
 			
 			
 			

 			foreach($urunler as $urun){

 				$siparisKaydet=$db->prepare("INSERT into siparis_detay SET
  					siparis_id=:siparis_id,
  					urun_id=:urun_id,
  					urun_fiyat=:urun_fiyat,
  					urun_adet=:urun_adet
  									
	");

	$siparisyaz=$siparisKaydet->execute(array(
					'siparis_id' => $siparis_id,
					'urun_id' => $urun,
					'urun_fiyat' => $fiyatlar[$fiyatsay],
					'urun_adet' => $adetler[$adetsay]
					
					));
$adetsay++;
$fiyatsay++;


 			}
             //sepet sıfırlama işlemi
 			//header("Location:indexler/sepetunset.php");
 			//urunler doldurulduktan sonra eksik kalan adet doldurma işlemi
if ($siparisyaz) {
    	header("Location:../indexler/sepetunset.php");
        exit;

    } else {
    	
    	
    	
        exit;
    }
    
        exit;

    } else {
    	header("Location:../odeme.php?durum=no");
        exit;
    }
 }

//$_SESSION['userkullanici_mail']
if(isset($_POST['admin_giris'])){
	$admin_mail=htmlspecialchars($_POST['admin_mail']);
	$admin_password=md5($_POST['admin_password']);

	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_password=:password and kullanici_yetki=:yetki");
$kullanicisor->execute(array(
  'mail' => $admin_mail,
  'password' => $admin_password,
  'yetki' => 5
  ));
echo $say=$kullanicisor->rowCount();

if($say==1){
	$_SESSION['admin_mail']=$admin_mail;
	header("Location:../admin/production/index.php?durum=basariligiris");
	exit;
}else{
header("Location:../admin/production/login.php?durum=no");
exit;
}

}

//Siparis durumu Güncelleme İşlemi

if(isset($_POST['siparis_durumu'])){
	adminkontrol();
	$siparis_durum_no=$_POST['s_durum'];
	$siparisID=$_POST['siparisID'];

$siparis_durum_update=$db->prepare("UPDATE siparisler SET
  					siparis_durum=:siparis_durum
					WHERE siparis_id=$siparisID
	");

	$siparisDurumUpdate=$siparis_durum_update->execute(array(
					'siparis_durum' => $siparis_durum_no
					));

	if ($siparisDurumUpdate) {
    	header("Location:../admin/production/siparisler.php?durum=ok");
        exit;

    } else {
    	header("Location:../admin/production/siparisler.php?durum=no");
        exit;
    }
}
//admin paneli kullanici silme işlemi
if(isset($_POST['kullanici_delete'])){
	adminkontrol();
	$kullanici_ID = $_POST['kullanici_ID'];

	
	$sil=$db->prepare("DELETE from kullanici where kullanici_id=:kullanici_id");
	$kontrol=$sil->execute(array(
		'kullanici_id' => $kullanici_ID
		));
	if ($kontrol) {

		Header("Location:../admin/production/kullanici.php?durum=ok");
		exit;

	} else {

		Header("Location:../admin/production/kullanici.php?durum=no");
		exit;
	}

}

if(isset($_POST['urun_ekle'])){
	adminkontrol();
		$slider1 = file_get_contents($_FILES["slider_1"]["tmp_name"]);
	    $slider2 = file_get_contents($_FILES["slider_2"]["tmp_name"]);
		$slider3 = file_get_contents($_FILES["slider_3"]["tmp_name"]);
		$slider4 = file_get_contents($_FILES["slider_4"]["tmp_name"]);
$urunkaydet=$db->prepare("INSERT INTO urunler SET
		urun_adi=:urun_adi,
		urun_aciklamasi=:urun_aciklamasi,
		urun_fiyati=:urun_fiyati,
		slider_1=:slider_1,
		slider_2=:slider_2,
		slider_3=:slider_3,
		slider_4=:slider_4
		");
	$inserturun=$urunkaydet->execute(array(
		'urun_adi' => htmlspecialchars($_POST['urun_adi']),
		'urun_aciklamasi' => htmlspecialchars($_POST['urun_aciklamasi']),
		'urun_fiyati' => htmlspecialchars($_POST['urun_fiyati']),
		'slider_1' => $slider1,
		'slider_2' => $slider2,
		'slider_3' => $slider3,
		'slider_4' => $slider4

		));

	if ($inserturun) {

		Header("Location:../admin/production/urunler.php?durum=ok");
		exit;
		

	} else {

		Header("Location:../admin/production/urunler.php?durum=no");
	exit;
	}
}
	
	


if(isset($_POST['urun_delete'])){
	adminkontrol();
	$urunsil=$db->prepare("DELETE from urunler where id=:id");
	$urunDelete=$urunsil->execute(array(
		'id' => $_POST['urun_id']
		));
	if ($urunDelete){
		Header("Location:../admin/production/urunler.php?durum=ok");
		exit;
	}else{
		Header("Location:../admin/production/urunler.php?durum=no");
		exit;
	}
}

if(isset($_POST['urun_update'])){
	adminkontrol();
	$slider_1 = file_get_contents($_FILES["slider_1"]["tmp_name"]);
	    $slider_2 = file_get_contents($_FILES["slider_2"]["tmp_name"]);
		$slider_3 = file_get_contents($_FILES["slider_3"]["tmp_name"]);
		$slider_4 = file_get_contents($_FILES["slider_4"]["tmp_name"]);
	$urunUpdate=$db->prepare("UPDATE urunler SET
urun_adi=:urun_adi,
		urun_aciklamasi=:urun_aciklamasi,
		urun_fiyati=:urun_fiyati,
		slider_1=:slider_1,
		slider_2=:slider_2,
		slider_3=:slider_3,
		slider_4=:slider_4
		WHERE id={$_POST['urun_id']}
		");
	$updateurun=$urunUpdate->execute(array(
		'urun_adi' => htmlspecialchars($_POST['urun_adi']),
		'urun_aciklamasi' => htmlspecialchars($_POST['urun_aciklamasi']),
		'urun_fiyati' => htmlspecialchars($_POST['urun_fiyati']),
		'slider_1' => $slider_1,
		'slider_2' => $slider_2,
		'slider_3' => $slider_3,
		'slider_4' => $slider_4

		));
if ($updateurun){
		Header("Location:../admin/production/urunler.php?durum=ok");
		exit;
	}else{
		Header("Location:../admin/production/urunler.php?durum=no");
		exit;
	}
}

if(isset($_POST['header_duzenle'])){
	$header_logo = file_get_contents($_FILES["header_logo"]["tmp_name"]);
	$headerUpdate=$db->prepare("UPDATE header SET
		destek_mail=:destek_mail,
		facebook_url=:facebook_url,
		instagram_url=:instagram_url,
		twiter_url=:twiter_url,
		logo=:logo
		WHERE id=1
		");
	$header_up=$headerUpdate->execute(array(
		'destek_mail' => htmlspecialchars($_POST['destek_mail']),
		'facebook_url' => htmlspecialchars($_POST['facebook_url']),
		'instagram_url' => htmlspecialchars($_POST['instagram_url']),
		'twiter_url' => htmlspecialchars($_POST['twiter_url']),
		'logo' => $header_logo
	));
	if ($header_up){
		Header("Location:../admin/production/settingheader.php?durum=ok");
		exit;
	}else{
		Header("Location:../admin/production/settingheader.php?durum=no");
		exit;
	}
}

if(isset($_POST['smtp_update'])){
	$smtpUpdate = $db->prepare("UPDATE smtp SET
		host=:host,
		username=:username,
		password=:password,
		port=:port,
		smtp_secure=:smtp_secure,
		smtp_debug=:smtp_debug,
		mail_name=:mail_name
		WHERE id = 1
		");
	$smtp_Update=$smtpUpdate->execute(array(
		'host' => htmlspecialchars($_POST['host']),
		'username' => htmlspecialchars($_POST['username']),
		'password' => htmlspecialchars($_POST['password']),
		'port' => trim($_POST['port']),
		'smtp_secure' => htmlspecialchars($_POST['smtp_secure']),
		'smtp_debug' => trim($_POST['smtp_debug']),
		'mail_name' => htmlspecialchars($_POST['mail_name'])

	));

	if($smtp_Update){
		Header("Location:../admin/production/smtp-ayar.php?durum=ok");
		exit;
	}else{
		Header("Location:../admin/production/smtp-ayar.php?durum=no");
		exit;
	}
}
?>