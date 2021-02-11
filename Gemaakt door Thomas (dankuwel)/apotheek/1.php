<!DOCTYPE html>
<html>
<head>
<style>
.slides {
display: grid;
grid-template-columns: 1fr 1fr;
margin:0;
padding:0;
}
.slides__left {
height: 400px
}
.slides__right {
height: 400px
}
</style>
</head>
<body>

<center>
<div class="slides">
<div class="slides__left">
<div class="w3-content w3-display-container">
  <img class="mySlides" src="afbeeldingen\1.jpg" style="width:75%">
  <img class="mySlides" src="afbeeldingen\2.jpg" style="width:68%">
  <img class="mySlides" src="afbeeldingen\3.jpg" style="width:81%">
  <img class="mySlides" src="afbeeldingen\4.jpg" style="width:68%">

  <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>
</div>
<div class="slides__right">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d38609.78875127587!2d4.7527649128926495!3d52.78429215780645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5e52e7aa9ebf1%3A0x6d5ad67ab2b77a18!2sSchagen!5e0!3m2!1snl!2snl!4v1611839710178!5m2!1snl!2snl" style="border:0;height:400px;"></iframe>

</div>
</div>

</center>	


<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>
</body>
</html>