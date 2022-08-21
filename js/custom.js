$(document).ready(function(){
 $(window).scroll(function(){
      $('.lazyi').each(function(){
          if( $(this).offset().top < ($(window).scrollTop() + $(window).height() + 100) )
          {                
              $(this).attr('src', $(this).attr('data-src'));
          }
      });
  })




 $(".btnsepet").click(function () {

  /* -- hostinge atarken  var url = "https://anket54.000webhostapp.com/baglan/islem.php"; yazmayı unutma Not!!
var url = "https://webyazilim.online/baglan/islem.php";
   */
 	//buradaki islem php adresini hostinge atarken unutma!!!!!
 var url = "http://localhost/Eticaret/baglan/islem.php";
 var data = {
 	p : "addToCart",
 	product_id : $(this).attr("product-id")
 }
 $.post(url, data, function (response){
$(".sepet-say").text(response);

 })


setTimeout(function(){$('.basket-alert').fadeIn();
setTimeout(function(){$('.basket-alert').fadeOut();},3000)
},500);
 
 })


 $(".btnremove").click(function () {
    //buradaki islem php adresini hostinge atarken unutma!!!!!
 var url = "http://localhost/Eticaret/baglan/islem.php";
 var data = {
    p : "removeFromCart",
    product_id : $(this).attr("product-id")
 }
 $.post(url, data, function (response){
window.location.reload();
 })
 })

 $(".img-zoom-lens").css("display", "none");
  $(".img-zoom-result").css("display", "none");

$(".swiper-wrapper").mouseover(function(){
  $(".img-zoom-lens").css("display", "block");
  $(".img-zoom-result").css("display", "block");
});

$(".swiper-wrapper").mouseout(function(){
   
  $(".img-zoom-lens").css("display", "none");
  $(".img-zoom-result").css("display", "none");
});


    $('#loading').hide();
  




$(".account").mouseover(function(){
  $(".account-bottom").css("display", "block");
  
});

$(".account").mouseout(function(){
   
  $(".account-bottom").css("display", "none");
  
});



 


})


