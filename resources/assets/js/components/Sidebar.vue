<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Módulo

Donde se usa:
	Home.blade.php (layout)

Descripción:
	aside con algunas noticias y logos asociados
 -->

 <template>
	<!-- SideBar -->
			<aside class="d-flex flex-column justify-content-between align-items-center " style="background-color: #dadada; flex-shrink: 2; min-width: 300px" >
					<!-- Enlaces de interes -->
				<div class=" d-flex justify-content-around w-90 flex-wrap">
					<b-card
					img-src="/images/caja1.jpg"
					img-top
					class="m-2 bg-transparent shadow"
					style="max-width: 250px"
					>
					<h3 class="uppercase text-center font-bold text-xl">Link #1</h3>
					<small class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</small>
					<b-button href="#" class="bg-transparent my-3 mx-5  rounded-pill text-dark">Leer Más</b-button>
					</b-card>
					<b-card
					img-src="/images/caja2.jpg"
					img-top
					class="m-2 bg-transparent shadow"
					style="max-width: 250px"
					>
					<h3 class="uppercase text-center font-bold text-xl">Link #1</h3>
					<small class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</small>
					<b-button href="#" class="bg-transparent my-3 mx-5  rounded-pill text-dark">Leer Más</b-button>
					</b-card>
					<b-card
					img-src="/images/caja3.jpg"
					img-top
					class="m-2 bg-transparent shadow"
					style="max-width: 250px"
					>
					<h3 class="uppercase text-center font-bold text-xl">Link #1</h3>
					<small class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</small>
					<b-button href="#" class="bg-transparent my-3 mx-5 rounded-pill text-dark">Leer Más</b-button>
					</b-card>					
				</div>
				<!-- Logos del Aside -->
				<div class="w-100 d-flex align-items-center justify-content-around my-5" style="max-width: 400px">
					<a href="#" class="w-25" onclick="return false">
						<img class="w-100" src="/images/logos/logo-gef.png">
					</a>
					<a href="#" class="w-25" onclick="return false">
						<img  class="w-100" src="/images/logos/logo-pnud.png">
					</a>
					<a href="#" class="w-25" onclick="return false">
						<img  class="w-100" src="/images/logos/logo-unep.png">
					</a>
				</div>


			</aside>
</template>

<script>
export default {
  name: 'sidebar'
}
</script>

