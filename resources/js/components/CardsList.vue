<template>
    <div class="max-w-3xl mx-auto p-6">
      <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Mis Tarjetas</h1>
  
      <div v-if="loading" class="text-gray-600 text-center">Cargando tarjetas...</div>
  
      <div v-else>
        <!-- 📝 Formulario para Agregar Nueva Tarjeta -->
        <form @submit.prevent="addCard" class="mb-6 bg-gray-100 p-4 rounded-lg shadow-md">
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
              <button @click="startEditing(card)" class="border border-blue-500 text-blue-500 rounded-full p-2 hover:bg-blue-500 hover:text-white transition flex items-center justify-center w-8 h-8">✏️</button>
              <button @click="deleteCard(card.id)" class="border border-gray-500 text-gray-500 rounded-full p-2 hover:bg-gray-500 hover:text-white transition flex items-center justify-center w-8 h-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
  
            <!-- 📝 Modo Edición -->
            <div v-if="editingCard === card.id">
              <input v-model="editedQuestion" placeholder="Editar pregunta" class="w-full border p-2 rounded mb-2" />
              <input v-model="editedAnswer" placeholder="Editar respuesta" class="w-full border p-2 rounded mb-2" />
              <div class="flex justify-between">
                <button @click="saveEdit(card.id)" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Guardar</button>
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
  import { ref, onMounted } from "vue";
  import axios from "axios";
  
  export default {
    setup() {
      const cards = ref([]);
      const loading = ref(true);
      const editingCard = ref(null);
      const editedQuestion = ref("");
      const editedAnswer = ref("");
      const newQuestion = ref("");
      const newAnswer = ref("");
  
      const fetchCards = async () => {
        try {
          const response = await axios.get("/api/cards", { headers: { Authorization: `Bearer 1|lHs0ThLYVs4m4UIPLitDK9wW3uYdbc4xa6v3f3LT300b61e1` } });
          cards.value = response.data;
        } catch (error) {
          console.error("❌ Error al obtener tarjetas:", error);
        } finally {
          loading.value = false;
        }
      };
      
      const startEditing = (card) => {
        editingCard.value = card.id;
        editedQuestion.value = card.question;
        editedAnswer.value = card.answer;
      };

    const saveEdit = async (id) => {
      if (!editedQuestion.value.trim() || !editedAnswer.value.trim()) {
        alert("Por favor, completa ambos campos.");
        return;
      }

      try {
        const token = "Bearer 1|lHs0ThLYVs4m4UIPLitDK9wW3uYdbc4xa6v3f3LT300b61e1";
        const response = await axios.put(`/api/cards/${id}`, {
          question: editedQuestion.value,
          answer: editedAnswer.value
        }, {
          headers: { Authorization: `Bearer ${token}` }
        });

        console.log("✅ Tarjeta actualizada:", response.data);

        const index = cards.value.findIndex(c => c.id === id);
        if (index !== -1) {
          cards.value[index].question = editedQuestion.value;
          cards.value[index].answer = editedAnswer.value;
        }

        editingCard.value = null;
        editedQuestion.value = "";
        editedAnswer.value = "";
      } catch (error) {
        console.error("❌ Error al actualizar tarjeta:", error);
      }
    };

    const cancelEdit = () => {
      editingCard.value = null;
      editedQuestion.value = "";
      editedAnswer.value = "";
    };

    const addCard = async () => {
      if (!newQuestion.value.trim() || !newAnswer.value.trim()) {
        alert("Por favor, completa ambos campos.");
        return;
      }

      try {
        const token = "Bearer 1|lHs0ThLYVs4m4UIPLitDK9wW3uYdbc4xa6v3f3LT300b61e1";
        await axios.post("/api/cards", {
          question: newQuestion.value,
          answer: newAnswer.value
        }, {
          headers: { Authorization: `Bearer ${token}` }
        });

        console.log("✅ Tarjeta agregada. Recargando lista...");

        // Vuelve a obtener las tarjetas para garantizar sincronización
        await fetchCards();

        // Limpiar los campos del formulario
        newQuestion.value = "";
        newAnswer.value = "";
      } catch (error) {
        console.error("❌ Error al agregar tarjeta:", error);
        alert("Error al agregar la tarjeta. Inténtalo más tarde.");
      }
    };


      const deleteCard = async (id) => {
        if (!confirm("¿Eliminar tarjeta?")) return;
        try {
          await axios.delete(`/api/cards/${id}`, { headers: { Authorization: `Bearer 1|lHs0ThLYVs4m4UIPLitDK9wW3uYdbc4xa6v3f3LT300b61e1` } });
          cards.value = cards.value.filter(card => card.id !== id);
        } catch (error) {
          console.error("❌ Error al eliminar tarjeta:", error);
        }
      };
  
      onMounted(fetchCards);
  
      return { cards, loading, deleteCard, editingCard, editedQuestion, editedAnswer, startEditing, saveEdit, cancelEdit, newQuestion, newAnswer, addCard };
    },
  };
  </script>
  