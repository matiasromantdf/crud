<template>
  <div>
    
    <RouterLink to="/nueva" class="btn btn-success">Nueva Inscripcion</RouterLink>
    <br>
  </div>
  <div class="listado">
    <table class="table">
      <th>Nombre</th>
      <th>Edad</th>
      <th>Fecha de Nacimiento</th>
      <th>Fecha de Inscripcion</th>
      <th>Costo</th>
      <th>Acciones</th>  
      <tr v-for="inscripcion in inscripciones" :key="inscripcion.id">
        <td hidden>{{inscripcion.ID}}</td>
        <td>{{inscripcion.NOMBRE}}</td>
        <td>{{inscripcion.EDAD}}</td>
        <td>{{inscripcion.FECHA_NACIMIENTO}}</td>
        <td>{{inscripcion.FECHA_INSCRIPCION}}</td>
        <td>{{inscripcion.COSTO}}</td>
        <td>
          <RouterLink :to="{name:'editar', params:{id:inscripcion.ID}}" class="btn btn-warning">Editar</RouterLink>
          <div class="btn btn-danger" @click="eliminar(inscripcion.ID)">Eliminar</div>
        </td>  
        </tr> 

    </table>

  </div>
</template>

<script>
import axios from 'axios'
export default {
  setup () {
    

    return {}
  },
  data () {
    return {
      inscripciones: []
    }
  },
  methods: {
    cargarInscripciones() {
      axios.get('http://localhost/crud/api.php?accion=todos')
      .then(response => {
        this.inscripciones = response.data
        console.log(response.data)
      })
      .catch(error => {
        console.log(error)
      })
    },
    eliminar(id) {
      axios.delete('http://localhost/crud/api.php?id='+id)
      .then(response => {
        this.cargarInscripciones()
      })
      .catch(error => {
        console.log(error)
      })
    }
  },
  mounted () {
    this.cargarInscripciones()
  }
}
</script>

<style scoped>


</style>