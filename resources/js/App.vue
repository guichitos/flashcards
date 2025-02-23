<template>
  <div>
    <h1>Mis Tarjetas</h1>
    <div v-if="loading">Cargando tarjetas...</div>
    <ul v-else>
      <li v-for="card in cards" :key="card.id">
        {{ card.question }} - {{ card.answer }}
      </li>
    </ul>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";

export default {
  setup() {
    const cards = ref([]);
    const loading = ref(true);

    const fetchCards = async () => {
      try {
        const response = await axios.get("/api/cards", {
          headers: {
            Authorization: `Bearer 1|lHs0ThLYVs4m4UIPLitDK9wW3uYdbc4xa6v3f3LT300b61e1` // Reemplaza con tu token real
          }
        });
        cards.value = response.data;
      } catch (error) {
        console.error("Error al obtener tarjetas:", error);
      } finally {
        loading.value = false;
      }
    };

    onMounted(fetchCards);

    return { cards, loading };
  },
};
</script>