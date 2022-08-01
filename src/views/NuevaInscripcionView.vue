<template>
  <h3>Nueva Inscripcion</h3>
  <div class="form-group">
    <form id="formulario">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" placeholder="Nombre" v-model ="nombre" name="nombre">
        <label for="edad">Edad</label>
        <input type="text" class="form-control" id="edad" placeholder="Edad" v-model="edad" name="edad">
        <label for="fechaNacimiento">Fecha de Nacimiento</label>
        <input type="date" class="form-control" id="fechaNacimiento" placeholder="Fecha de Nacimiento" v-model="fechaNacimiento" name="fecha_nac">
        <label for="fechaInscripcion">Fecha de Inscripcion</label>
        <input type="date" class="form-control" id="fechaInscripcion" placeholder="Fecha de Inscripcion" v-model="fechaInscripcion" name="fecha_insc">
        <label for="costo">Costo</label>
        <input type="text" class="form-control" id="costo" placeholder="Costo" v-model="costo" name="costo">
        <br>
        <button @click.prevent="realizarValidaciones()" class="btn btn-primary">Enviar</button>

        
    </form>
  </div>


</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            nombre: '',
            edad: 0,
            fechaNacimiento://establecer fecha actual 
            new Date(Date.now()).toISOString().substring(0, 10),
            fechaInscripcion: new Date(Date.now()).toISOString().substring(0, 10),
            costo: ''
        }
    },
    methods: {
        enviar() {

            //hacer las validaciones


            var formulario = new FormData(document.getElementById('formulario'))

                axios.post('http://localhost/crud/api.php', formulario)
                .then(response => {
                    console.log(response)
                    alert('Inscripcion realizada. el Id es: '+ response.data)
                })
                .catch(error => {
                    console.log(error)
                })
          
        },
        realizarValidaciones(){
            
            if( this.validarFechas()
                && this.validardEdad()
                && this.comprobarEdad()
                && this.validarLongitudNombres()
                && this.validarCosto()){
                this.enviar()
            }
        }
        ,
        validarFechas() {
            let ins = document.getElementById('fechaInscripcion').value
            let nac = document.getElementById('fechaNacimiento').value
            let insDate = new Date(ins)
            let nacDate = new Date(nac)

            if (ins <= nac) {
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
            let calculada = this.calcularEdad()
            if (calculada != this.edad) {
                alert('La edad no coincide con la fecha de nacimiento')
                return false
            } else {
                return true
            }
        },
        validarCosto(){
            let fechaHoy = new Date(Date.now()) 
            let anioHoy = fechaHoy.getFullYear()
            let fechaIns = new Date(this.fechaInscripcion)
            let anioIns = fechaIns.getFullYear()
            let costo = this.costo
            let diferencia = anioHoy - anioIns
            alert(diferencia)
            alert(costo)

          
            if((costo /100) - diferencia != 0){
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
    
    }

}
</script>

<style>

</style>