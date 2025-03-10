import { ref } from "vue";
import axios from "axios";

const cards = ref([]);
const currentIndex = ref(0);
const currentCard = ref(null);
const token = "Bearer 1|lHs0ThLYVs4m4UIPLitDK9wW3uYdbc4xa6v3f3LT300b61e1";

const fetchCards = async () => {
  try {
    const response = await axios.get("/api/cards", { headers: { Authorization: token } });
    cards.value = response.data.filter(card => card.visible); // Solo tarjetas visibles
    currentCard.value = cards.value.length > 0 ? cards.value[0] : { question: "No hay tarjetas", answer: "" };
  } catch (error) {
    console.error("❌ Error al obtener tarjetas:", error);
    currentCard.value = { question: "Error al cargar", answer: "Intenta nuevamente." }; // ✅ Manejo de error
  }
};


const nextCard = () => {
  if (cards.value.length > 0) {
    currentIndex.value = (currentIndex.value + 1) % cards.value.length;
    currentCard.value = cards.value[currentIndex.value];
  }
};

export default {
  cards,
  currentIndex,
  currentCard,
  fetchCards,
  nextCard
};
