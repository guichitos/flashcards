import axios from "axios";
import { ref } from "vue";

const cards = ref([]);
const loading = ref(true);
const token = "Bearer 1|lHs0ThLYVs4m4UIPLitDK9wW3uYdbc4xa6v3f3LT300b61e1";
const editingCard = ref(null); // 📌 Aseguramos que es `ref()`

const fetchCards = async () => {
  try {
    const response = await axios.get("/api/cards", {
      headers: { Authorization: token }
    });
    cards.value = response.data;
  } catch (error) {
    console.error("❌ Error al obtener tarjetas:", error);
  } finally {
    loading.value = false;
  }
};

const addCard = async (question, answer) => {
    try {
      await axios.post("/api/cards", { question, answer }, { headers: { Authorization: token } });
  
      console.log("✅ Tarjeta agregada. Recargando tarjetas...");
      
      await fetchCards(); // 🔄 Vuelve a cargar la lista de tarjetas
  
    } catch (error) {
      console.error("❌ Error al agregar tarjeta:", error);
    }
  };
    

const deleteCard = async (id) => {
  try {
    await axios.delete(`/api/cards/${id}`, { headers: { Authorization: token } });
    await fetchCards();
  } catch (error) {
    console.error("❌ Error al eliminar tarjeta:", error);
  }
};

const editedQuestion = ref("");
const editedAnswer = ref("");

const startEditing = (card) => {
    console.log("📌 Tarjeta seleccionada para edición:", card); // 🔍 Verificar si la tarjeta llega correctamente
    console.log("🔍 Antes de cambiar editingCard:", editingCard.value);
    editingCard.value = card.id;
    console.log("✅ Después de cambiar editingCard:", editingCard.value);

    editedQuestion.value = card.question;
    editedAnswer.value = card.answer;
  };

  const saveEdit = async (id) => {
    try {
      console.log("📤 Enviando solicitud PUT para la tarjeta con ID:", id);
      console.log("📝 Antes de actualizar - editedQuestion:", editedQuestion.value);
      console.log("📝 Antes de actualizar - editedAnswer:", editedAnswer.value);
  
      // ❗ Volvemos a obtener los valores de los inputs antes de enviarlos
      const updatedQuestion = editedQuestion.value;
      const updatedAnswer = editedAnswer.value;
  
      console.log("✅ Valores finales a enviar - Question:", updatedQuestion);
      console.log("✅ Valores finales a enviar - Answer:", updatedAnswer);
  
      await axios.put(`/api/cards/${id}`, {
        question: updatedQuestion,
        answer: updatedAnswer
      }, {
        headers: { Authorization: token }
      });
  
      console.log("✅ Tarjeta actualizada correctamente");
      await fetchCards(); // 🔄 Vuelve a cargar la lista de tarjetas actualizada
      
      editingCard.value = null; // ❗ Resetear el estado de edición
      console.log("🔄 editingCard reseteado a null");
  
    } catch (error) {
      console.error("❌ Error al actualizar la tarjeta:", error);
    }
  
  };

const cancelEdit = () => {
  editingCard.value = null;
};

export default {
  cards,
  loading,
  fetchCards,
  addCard,
  deleteCard,
  startEditing,
  editingCard,
  editedQuestion,
  editedAnswer,
  saveEdit,
  cancelEdit
};
