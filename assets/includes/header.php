<div class="hero">
    <div class="hero__left">
    <div id="swd-slideshow">
      <div style="background-image: url('./assets/img/1.jpg')"></div>
      <div style="background-image: url('./assets/img/2.jpg')"></div>
      <div style="background-image: url('./assets/img/3.jpg')"></div>
      <div style="background-image: url('./assets/img/4.jpg')"></div>
    </div>
    </div>
    <div class="hero__right">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d38609.78875127733!2d4.752764914292036!3d52.7842921578048!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5e52e7aa9ebf1%3A0x6d5ad67ab2b77a18!2sSchagen!5e0!3m2!1snl!2snl!4v1616242314800!5m2!1snl!2snl" loading="lazy"></iframe>
    </div>
</div>
<script>
  let settings={slide_interval:5000,transition_duration:750,autoplay:true,};document.addEventListener("DOMContentLoaded",function(event){let counter=0;let slideInterval;const slideshow=document.querySelector("#swd-slideshow");let leftArrowElement='<span class="arrow-left arrow">&#10092;</span>';let rightArrowElement='<span class="arrow-right arrow">&#10093;</span>';slideshow.innerHTML+=leftArrowElement;slideshow.innerHTML+=rightArrowElement;const slides=document.querySelectorAll("#swd-slideshow > div");const arrowLeft=document.querySelector("#swd-slideshow .arrow-left");const arrowRight=document.querySelector("#swd-slideshow .arrow-right");slides.forEach((slide)=>{slide.style.transitionDuration=settings.transition_duration+"ms";});arrowRight.addEventListener("click",function(){nextSlide();});arrowLeft.addEventListener("click",function(){prevSlide();});startSlider();arrowLeft.addEventListener("mouseover",function(){clearInterval(slideInterval);});arrowRight.addEventListener("mouseover",function(){clearInterval(slideInterval);});arrowLeft.addEventListener("mouseleave",function(){if(settings.autoplay){startAutoplay();}});arrowRight.addEventListener("mouseleave",function(){if(settings.autoplay){startAutoplay();}});function reset(){counter=0;showSlide(counter);}
function nextSlide(){hideSlide(counter);if(++counter===slides.length){counter=0;}
showSlide(counter);}
function prevSlide(){hideSlide(counter);if(--counter===-1){counter=slides.length-1;}
showSlide(counter);}
function hideSlide(counter){slides[counter].style.opacity=0;}
function showSlide(counter){slides[counter].style.opacity=1;}
function startAutoplay(){slideInterval=setInterval(nextSlide,settings.slide_interval);}
function startSlider(){reset();if(settings.autoplay){startAutoplay();}}});
</script>