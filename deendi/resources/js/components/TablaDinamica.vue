<template>
	<div>
        <input type="hidden" name="numero_de_campos_tabla" :id="datos.id" v-model="num">

        <table class="table w-full m-0 p-0 border-0">
            <tbody class="w-100">
                <tr v-for="fila in filas" class="">
                    <td class="m-0 p-0" v-for="campo in fila.fila" v-html="campo.campo">
                        {{campo.campo}}
                    </td>
                </tr>
            </tbody>
        </table>

		<div class="mt-1">
			<button type="button" class="btn btn-outline-light btn-sm rounded-circle text-center" v-on:click="agregarCampos(datos.form.numero_columnas)">
                <i class="fa fa-plus-circle h5 text-primary"></i>
            </button>
			<button type="button" class="btn btn-outline-light btn-sm rounded-circle text-center" v-on:click="quitarCampo()">
                <i class="fa fa-minus-circle h5 text-muted"></i>
            </button>
		</div>

	</div>
</template>

<script>
	import Vuex from 'vuex'
    export default {
    	props:['datos'],
    	data(){
    		return {
    			pregunta: '',
    			filas:[],
    			num: 0
    		}
    	},
        created(){
            this.agregarCampos(this.datos.form.numero_columnas);

        },

        methods: {

        	agregarCampos(num){

        		var campos = [];

        		for (var i = 0; i < num; i++) {
        			campos.push({
        				campo:`<input type="text" class="form-control w-100 m-0 py-0 px-2" value="" id="tabla${this.datos.id}res${this.num}" min="1" maxlenght="188" required>`
        			})
        			this.num++;
        		}

        		this.filas.push({
        			fila: campos
        		})
        	},

        	quitarCampo(){
        		if(this.filas.length > 1){
                	this.filas.splice(this.filas.length - 1, 1);
                    this.num = this.num - this.datos.form.numero_columnas;
             	}
        	}

        }


    }
</script>
