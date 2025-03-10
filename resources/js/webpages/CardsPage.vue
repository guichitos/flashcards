<template>
<CardsList
  :cards="cards"
  :loading="loading"
  :addCard="addCard"
  :deleteCard="deleteCard"
  :startEditing="startEditing"
  :saveEdit="saveEdit"
  :cancelEdit="cancelEdit"
  :editingCard="editingCard"
  :editedQuestion="editedQuestion"
  :editedAnswer="editedAnswer"
  :toggleVisibility="toggleVisibility"

  @update:editingCard="(newValue) => { 
    console.log('🔄 Evento recibido en CardsPage.vue - Nuevo editingCard:', newValue); 
    editingCard = newValue; 
  }"

  @update:editedQuestion="(newValue) => { 
    console.log('📝 Evento recibido en CardsPage.vue - Nuevo editedQuestion:', newValue);
    editedQuestion = newValue;
  }"

  @update:editedAnswer="(newValue) => { 
    console.log('📝 Evento recibido en CardsPage.vue - Nuevo editedAnswer:', newValue);
    editedAnswer = newValue;
  }"

  @update:saveEdit="(id) => {
    console.log('💾 Evento recibido en CardsPage.vue - Guardando tarjeta con ID:', id);
    console.log('📝 Últimos valores antes de guardar - Question:', editedQuestion);
    console.log('📝 Últimos valores antes de guardar - Answer:', editedAnswer);
    saveEdit(id);
  }"
/>

</template>

<script>
import { onMounted } from "vue";
import CardsList from "../components/CardsList.vue";
import CardService from "../services/CardService.js";

export default {
  components: { CardsList },
  setup() {
    const { cards, loading, fetchCards, addCard, deleteCard, startEditing, saveEdit, cancelEdit, editingCard, editedQuestion, editedAnswer, toggleVisibility } = CardService;


    onMounted(fetchCards);

    return { cards, loading, fetchCards, addCard, deleteCard, startEditing, saveEdit, cancelEdit, editingCard, editedQuestion, editedAnswer, toggleVisibility  };
  }
};
</script>