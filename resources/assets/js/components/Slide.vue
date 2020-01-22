<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Módulo

Donde se usa:
	Home.vue (vista)

Descripción:
	Slide con noticias 
 -->

 <template>
  <div>
<!-- Slider -->
	<div class="slide">
	  <img src="/images/slides/1.jpg" alt="">
	  <img src="/images/slides/2.jpg" alt="">
	  <img src="/images/slides/3.jpg" alt="">
	  <img src="/images/slides/4.jpg" alt="">
	</div>
  </div>
</template>

<script>
import "slick-carousel/slick/slick.min.js";

$(document).ready(function(){
				$('.slide').slick({
					// dots: true,
					infinite: true,
					autoplay:true,
					autoplaySpeed: 2000,
					arrows: false,
					speed: 1000,
					fade: true,
					slidesToShow: 1,
					slidesToScroll: 1,
				});
			});

export default {
  name: 'slide',
}


</script>

<style scoped>
	@import url("/slick-carousel/slick/slick.css");


	
</style>
				
