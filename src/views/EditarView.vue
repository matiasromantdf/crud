<template>
  <h3>Editar Inscripcion {{$route.params.id}}</h3>
  <div class="form-group">
    <form id="formulario">
        <input type="hidden" class="form-control" id="id" placeholder="Id" value="update" name="accion">
        <input type="hidden" class="form-control" id="id" placeholder="Id" :value="id" name="id">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" placeholder="Nombre" :value="nombre" name="nombre">
        <label for="edad">Edad</label>
        <input type="text" class="form-control" id="edad" placeholder="Edad" :value="edad" name="edad">
        <label for="fechaNacimiento">Fecha de Nacimiento</label>
        <input type="date" class="form-control" id="fechaNacimiento" placeholder="Fecha de Nacimiento" :value="fechaNacimiento" name="fecha_nac">
        <label for="fechaInscripcion">Fecha de Inscripcion</label>
        <input type="date" class="form-control" id="fechaInscripcion" placeholder="Fecha de Inscripcion" :value="fechaInscripcion" name="fecha_insc">
        <label for="costo">Costo</label>
        <input type="text" class="form-control" id="costo" placeholder="Costo" :value="costo" name="costo">
        <br>
        <button @click.prevent="enviar" class="btn btn-primary" @click="actualizar">Actualizar Datos</button>

        
    </form>
  </div>


</template>

<script>
import axios from 'axios'
export default {
    name: 'Editar',
    data() {
        return {
            nombre: '',
            edad: '',
            fechaNacimiento: '',
            fechaInscripcion: '',
            costo: '',
            id: ''
        }
    },
    methods: {

        actualizar() {
        
            var formulario = new FormData(document.getElementById('formulario'))
           

                axios.post('http://localhost/crud/api.php', formulario)
                .then(response => {
                    console.log(response)
                })
                .catch(error => {
                    console.log(error)
                })
          
        },
        validarFechas() {
            if (this.fechaInscripcion < this.fechaNacimiento) {
                alert('La fecha de inscripcion no puede ser menor a la fecha de nacimiento')
                return false
            } else {
                return true
            }
        },
        validardEdad() {
            if (this.edad < 18) {
                alert('La edad debe ser mayor a 18')
                return false
            } else {
                return true
            }
        },
        calcularEdad(){
            let fechaNacimiento = new Date(this.fechaNacimiento)
            let fechaActual = new Date()
            let edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear()
            if (fechaActual.getMonth() < fechaNacimiento.getMonth()) {
                edad--
            } else if (fechaActual.getMonth() == fechaNacimiento.getMonth() && fechaActual.getDate() < fechaNacimiento.getDate()) {
                edad--
            }
            return edad
        },
        comprobarEdad(){
            if (this.calcularEdad() =! this.edad) {
                alert('La edad no coincide con la fecha de nacimiento')
                return false
            } else {
                return true
            }
        },
        validarCosto(){
            let fechaHoy = new Date() 
            let antiguedad = fechaHoy.getFullYear() - this.fechaInscripcion.getFullYear()
            if(this.costo/antiguedad != 0){
                alert('El costo no corresponde con la antiguedad')
                return false
            } else {
                return true
            } 
        },
        validarNombreyApellido(){
            let hayespacios = this.nombre.indexOf(' ')
            if(hayespacios == -1){
                alert('Ingrese nombre y apellido')
                return false
            } else {
                return true
            }
        },
        validarLongitudNombres(){
            if(this.validarNombreyApellido){
                let nombre = this.nombre.split(' ')
                if(nombre[0].length != 4 || nombre[1].length != 4){
                    alert('El nombre y apellido deben tener 4 caracteres')
                    return false
                } else {
                    return true
                }
            }
        }
    
    },
    mounted() {
        this.id = this.$route.params.id
        axios.get('http://localhost/crud/api.php?accion=uno&id=' + this.id)
            .then(response => {
                
                this.nombre = response.data.NOMBRE
                this.edad = response.data.EDAD
                this.fechaNacimiento = response.data.FECHA_NACIMIENTO
                this.fechaInscripcion = response.data.FECHA_INSCRIPCION
                this.costo = response.data.COSTO
            })
            .catch(error => {
                console.log(error)
            })
    }

}
</script>

<style>

</style>