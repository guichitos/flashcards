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
            <button @click="startEditing(card)" class="border border-blue-500 text-blue-500 rounded-full p-2 hover:bg-blue-500 hover:text-white transition w-8 h-8">✏️</button>
            <button @click="deleteCard(card.id)" class="border border-gray-500 text-gray-500 rounded-full p-2 hover:bg-gray-500 hover:text-white transition w-8 h-8">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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
    startEditing: Function 
  },

  data() {
    return {
      newQuestion: "",
      newAnswer: ""
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
    }

    
  }
};
</script>

