<template>
    <div class="flex flex-col items-center">
      <h2 class="text-2xl font-bold mb-4">Modo Estudio</h2>
  
      <CardViewer 
        :card="currentCard" 
        :nextCard="nextCard" 
      />
  
      <p class="mt-4 text-gray-600">Tarjeta {{ currentIndex + 1 }} de {{ cards.length }}</p>
    </div>
  </template>
  
  <script>
  import { onMounted } from "vue";
  import CardViewer from "../components/CardViewer.vue";
  import StudyService from "../services/StudyService.js";
  
  export default {
    components: { CardViewer },
    setup() {
      const { cards, currentCard, nextCard, currentIndex, fetchCards } = StudyService;
  
      onMounted(fetchCards);
  
      return { cards, currentCard, nextCard, currentIndex };
    }
  };
  </script>
  