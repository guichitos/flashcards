<template>
    <div class="max-w-md mx-auto p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">⚙️ Configuración</h2>
  
      <div class="mb-6">
        <p class="mb-2 text-gray-700 font-medium">Modo de estudio</p>
  
        <label class="flex items-center mb-2">
          <input
            type="radio"
            value="normal"
            v-model="modoEstudio"
            @change="guardarConfiguracion"
            class="mr-2"
          />
          Pregunta ➜ Respuesta
        </label>
  
        <label class="flex items-center mb-2">
          <input
            type="radio"
            value="reverso"
            v-model="modoEstudio"
            @change="guardarConfiguracion"
            class="mr-2"
          />
          Respuesta ➜ Pregunta
        </label>
  
        <label class="flex items-center">
          <input
            type="radio"
            value="aleatorio"
            v-model="modoEstudio"
            @change="guardarConfiguracion"
            class="mr-2"
          />
          Aleatorio
        </label>
      </div>
  
      <router-link
        to="/cards"
        class="inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition"
      >
        ← Volver a Tarjetas
      </router-link>
    </div>
  </template>
  
  
  <script>
  export default {
    data() {
      return {
        modoEstudio: localStorage.getItem("modoEstudio") || "normal", // 🔁 Valor por defecto
      };
    },
    methods: {
      guardarConfiguracion() {
        localStorage.setItem("modoEstudio", this.modoEstudio);
      },
    },
  };
  </script>
  