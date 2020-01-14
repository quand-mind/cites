<template>
  <div>
<!-- Slider -->
	<div class="slide" style="max-width: 130vh">
		<a href="#" onclick="return false"><img src="img/slides/4.jpg" style="width: 100%">
			<div class="position-absolute bg-dark w-100 text-white h-25 rounded d-flex" style="z-index: 300; bottom:0%; opacity: 0.8">
			<p class="h4 m-auto text-center">Noticia #1 Aqui va la noticia</p>
			</div>
		</a>
		<a href="#" onclick="return false"><img src="img/slides/2.jpg" style="width: 100%">
			<div class="position-absolute bg-dark w-100 text-white h-25 rounded d-flex" style="z-index: 300; bottom:0%; opacity: 0.8">
			<p class="h4 m-auto text-center">Noticia #2 Aqui va la noticia</p>
			</div>
		</a>
		<a href="#" onclick="return false"><img src="img/slides/3.jpg" style="width: 100%">
			<div class="position-absolute bg-dark w-100 text-white h-25 rounded d-flex" style="z-index: 300; bottom:0%; opacity: 0.8">
			<p class="h4 m-auto text-center">Noticia #3 Aqui va la noticia</p>
			</div>
		</a>
		<a href="#" onclick="return false"><img src="img/slides/1.jpg" style="width: 100%">
			<div class="position-absolute bg-dark w-100 text-white h-25 rounded d-flex" style="z-index: 300; bottom:0%; opacity: 0.8">
			<p class="h4 m-auto text-center">Noticia #4 Aqui va la noticia</p>
			</div>
		</a>
	</div>
  </div>
</template>

<script>
	
export default {
  name: 'slide',
}

</script>

<style scoped>
	.slide a div:hover p{
		font-size: 30px;
		transition: all 500ms ease;
	}
</style>
				
