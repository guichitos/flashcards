<template>
    <div>
      <p>{{ message }}</p>
      <button @click="updateMessage">Actualizar Mensaje</button>
    </div>
  </template>
  
  <script>
  import { ref } from "vue";
  
  export default {
    setup() {
      const message = ref("Hola Vue 3!");
  
      const updateMessage = () => {
        message.value = "¡Mensaje actualizado!";
      };
  
      return { message, updateMessage };
    }
  };
  </script>
  