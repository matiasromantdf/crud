<script setup>
import { RouterLink, RouterView } from 'vue-router'

</script>

<template>
   <div class="container">
    <nav>
        <RouterLink to="/">Inscripciones</RouterLink>
     
    </nav>
   
      <RouterView />
  </div>
      
  


</template>

<style scoped>
nav{
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 20px;
  margin-bottom: 20px;
  margin-top: 20px;
  background-color: #f5f5f5;
}
</style>
