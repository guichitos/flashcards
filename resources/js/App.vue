<template>
  <div class="max-w-3xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Mis Tarjetas</h1>

    <div v-if="loading" class="text-gray-600 text-center">Cargando tarjetas...</div>

    <div v-else>
      <div v-if="cards.length > 0" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div v-for="card in cards" :key="card.id" class="bg-white shadow-lg rounded-lg p-6 border relative flex flex-col justify-between">
          <div class="absolute top-2 right-2 flex gap-2">
              <!-- Botón de editar -->
              <button @click="startEditing(card)" 
                      class="border border-blue-500 text-blue-500 rounded-full p-2 hover:bg-blue-500 hover:text-white transition flex items-center justify-center w-8 h-8">
                  ✏️
              </button>
            <!-- Botón de eliminar -->
            <button @click="deleteCard(card.id)" 
                    class="border border-gray-500 text-gray-500 rounded-full p-2 hover:bg-gray-500 hover:text-white transition flex items-center justify-center w-8 h-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
          </div>
          <p class="text-lg font-semibold text-gray-900 mt-6">{{ card.question }}</p>
          <p class="text-gray-700 mt-2">{{ card.answer }}</p>
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

    // 🔹 Función para obtener las tarjetas
    const fetchCards = async () => {
      try {
        const token = "1|lHs0ThLYVs4m4UIPLitDK9wW3uYdbc4xa6v3f3LT300b61e1"; // 🔐 Token Fijo

        console.log("📡 Token enviado:", token);

        const response = await axios.get("/api/cards", {
          headers: { Authorization: `Bearer ${token}` }
        });

        console.log("✅ Datos recibidos:", response.data);
        cards.value = response.data;
      } catch (error) {
        console.error("❌ Error al obtener tarjetas:", error);
      } finally {
        loading.value = false;
      }
    };

    // 🗑️ Función para eliminar tarjetas
    const deleteCard = async (id) => {
      if (!confirm("¿Estás seguro de que quieres eliminar esta tarjeta?")) return;

      try {
        const token = "1|lHs0ThLYVs4m4UIPLitDK9wW3uYdbc4xa6v3f3LT300b61e1"; // 🔐 Token Fijo

        await axios.delete(`/api/cards/${id}`, {
          headers: { Authorization: `Bearer ${token}` }
        });

        // 🟢 Actualizar la lista eliminando la tarjeta sin recargar la página
        cards.value = cards.value.filter(card => card.id !== id);
      } catch (error) {
        console.error("❌ Error al eliminar tarjeta:", error);
      }
    };

    onMounted(fetchCards);
    return { cards, loading, deleteCard };
  },
};
</script>
