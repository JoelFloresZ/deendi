<template>
    <div class="sticky-top" id="menu-de-preguntas">
		<div class=" card shadow">
			<ul class="list-group border-0">
			  <li class="list-group-item d-flex justify-content-between align-items-center bg-primary text-white">
			    Formularios
			  </li>
			  <li class="list-group-item d-flex justify-content-between align-items-center">
			    <button class="btn btn-outline-light btn-sm btn-block text-dark" data-toggle="modal" data-target="#exampleModalCenter">
			    <i class="fa fa-bars mr-1 h5 float-left"></i>Abierta</button>
			    
			  </li>
			  <li class="list-group-item d-flex justify-content-between align-items-center">
			   <button class="btn btn-outline-light btn-sm btn-block text-dark" data-toggle="modal" data-target="#form-simple">
			   <i class="fa fa-list-ul mr-1 h5 float-left"></i>Selección simple</button>
			  </li>

			  <li class="list-group-item d-flex justify-content-between align-items-center">
			   <button class="btn btn-outline-light btn-sm btn-block text-dark" data-toggle="modal" data-target="#form-multiple">
			   <i class="fa fa-list mr-1 h5 float-left"></i>Selección múltiple</button>
			  </li>

			  <li class="list-group-item d-flex justify-content-between align-items-center">
			   <button class="btn btn-outline-light btn-sm btn-block text-dark" data-toggle="modal" data-target="#form-desplegable">
			   	<i class="fa  fa-list-ul mr-1 h5 float-left"></i>Desplegable</button>
			  </li>

			  <li class="list-group-item d-flex justify-content-between align-items-center">
			   <button class="btn btn-outline-light btn-sm btn-block text-dark" data-toggle="modal" data-target="#form-escala">
			   	<i class="fa fa-sliders-h mr-1 h5 float-left"></i>Escala</button>
			  </li>

			  <li class="list-group-item d-flex justify-content-between align-items-center">
			   <button class="btn btn-outline-light btn-sm btn-block text-dark" data-toggle="modal" data-target="#form-archivo">
			   	<i class="fa fa-file-image mr-1 h5 float-left"></i>Archivo</button>
			    
			  </li>

			  <li class="list-group-item d-flex justify-content-between align-items-center">
			   <button class="btn btn-outline-light btn-sm btn-block text-dark" data-toggle="modal" data-target="#form-tabla">
			   	<i class="fa fa-table mr-1 h5 float-left"></i>Tabla</button>
			  </li>

			  <li class="list-group-item d-flex justify-content-between align-items-center">
			   <button class="btn btn-outline-light btn-sm btn-block text-dark" data-toggle="modal" data-target="#form-nota">
			   	<i class="fa fa-sticky-note mr-1 h5 float-left"></i>Nota</button>
			  </li>
			</ul>
		</div>
	</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>








