<template>
  <div class="max-w-3xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Mis Tarjetas</h1>

    <div v-if="loading" class="text-gray-600 text-center">Cargando tarjetas...</div>

    <div v-else>
      <!-- 📝 Formulario para Agregar Nueva Tarjeta -->
      <form @submit.prevent="handleAddCard" class="mb-6 bg-gray-100 p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-2 text-gray-700">Nueva Tarjeta</h2>
        <input v-model="newQuestion" placeholder="Pregunta" class="w-full border p-2 rounded mb-2" />
        <input v-model="newAnswer" placeholder="Respuesta" class="w-full border p-2 rounded mb-2" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
          Agregar Tarjeta
        </button>
      </form>

      <div v-if="cards.length > 0" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div v-for="card in cards" :key="card.id" class="bg-white shadow-lg rounded-lg p-6 border relative flex flex-col justify-between">
          
          <div class="absolute top-2 right-2 flex gap-2">

            <!-- Checkbox para modificar 'visible' -->
            <label>
              <input type="checkbox" :checked="card.visible" @change="toggleVisibility(card)">
              Visible
            </label>

            <button 
              @click="startEditing(card)" 
              class="border border-gray-500 text-gray-500 rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-500 hover:text-white transition p-0">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-4.036a2.5 2.5 0 013.536 3.536l-8.5 8.5A2 2 0 0110 17H7.5a1 1 0 01-1-1v-2.5a2 2 0 01.586-1.414l8.5-8.5z" />
              </svg>
            </button>



            <button 
              @click="deleteCard(card.id)" 
              class="border border-gray-500 text-gray-500 rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-500 hover:text-white transition p-0"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m2 0v14a2 2 0 01-2 2H8a2 2 0 01-2-2V6h12z" />
              </svg>
            </button>


          </div>

          <!-- Modo Edición -->
          <div v-if="editingCard === card.id">
            <input 
              :value="editedQuestion || card.question" 
              @input="
                console.log('📤 Emitiendo update:editedQuestion:', $event.target.value);
                $emit('update:editedQuestion', $event.target.value);
              " 
              placeholder="Editar pregunta" 
              class="w-full border p-2 rounded mb-2" 
            />


            <input 
              :value="editedAnswer || card.answer" 
              @input="
                console.log('📤 Emitiendo update:editedAnswer:', $event.target.value);
                $emit('update:editedAnswer', $event.target.value);
              " 
              placeholder="Editar respuesta" 
              class="w-full border p-2 rounded mb-2" 
            />

            <div class="flex justify-between">
              <button @click="emitSaveEdit(card.id)" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
  Guardar
</button>

             <button @click="cancelEdit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Cancelar</button>
            </div>
          </div>

          <!-- 📌 Vista Normal -->
          <div v-else>
            <p class="text-lg font-semibold text-gray-900 mt-6">{{ card.question }}</p>
            <p class="text-gray-700 mt-2">{{ card.answer }}</p>
          </div>
        </div>
      </div>
      <p v-else class="text-red-500 text-center">No hay tarjetas disponibles.</p>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: {
    cards: Array,
    loading: Boolean,
    addCard: Function,
    deleteCard: Function,
    saveEdit: Function,
    cancelEdit: Function,
    editingCard: Number,
    editedQuestion: String,
    editedAnswer: String, 
    startEditing: Function, 
    toggleVisibility: Function 
  },

  data() {
    return {
      newQuestion: "",
      newAnswer: "",
      token: "Bearer 1|lHs0ThLYVs4m4UIPLitDK9wW3uYdbc4xa6v3f3LT300b61e1" // Agregamos el token aquí
    };
  },

  methods: {
    handleAddCard() {
      if (!this.newQuestion.trim() || !this.newAnswer.trim()) {
        alert("Por favor, completa ambos campos.");
        return;
      }
      this.addCard(this.newQuestion, this.newAnswer);
      this.newQuestion = "";
      this.newAnswer = "";
    },

    emitSaveEdit(id) {
      console.log("🚀 Evento emitido desde CardsList.vue - ID:", id);
      this.$emit("update:saveEdit", id);
    },
  }
};
</script>
