<template>
	<div class="p-5 border border-light shadow rounded mx-auto d-flex flex-column justify-content-around align-items-center bg-light  my-5" style=" max-width: 70%">
		<h2 class="text-uppercase my-5">Hacer una pregunta</h2>
		<form name="preguntaNueva" class="w-75" method="post">
			<div class="form-group mb-4">
				<label for="email" class="font-weight-bold">Correo:</label>
				<input type="email"  id="email" name="email" placeholder="nombre@correo.com" class="form-control" required>
			</div>
			<div class="form-group mb-4">
				<label for="pregunta" class="font-weight-bold">Escriba su pregunta:</label>
				<textarea type="text"  id="pregunta" name="pregunta" placeholder="Escriba aqui su pregunta" class="form-control" required> </textarea>
			</div>
			<b-button to="/Pregunta-hecha" type="submit" class="btn btn-primary" style="font-size: 20px" minlength="10">Hacer Pregunta</b-button>
		</form>
	</div>	
</template>

<script>
	import titulo from "../components/Titulo.vue"

	export default{
		components:{
			titulo,
		}
	}
</script>
<style type="text/css">
	input:valide, textarea:valid{
		background-color: green;
	}
	input:invalide, textarea:invalid{
		background-color: red;
	}
</style>