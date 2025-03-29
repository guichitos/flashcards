<template>
  <div v-if="card" class="flex flex-col items-center">
    <div class="relative w-80 h-48" @click="flipCard">
      <div :class="['card', { 'flipped': isFlipped }]">
        <div class="card-front flex items-center justify-center p-4"> <!-- ✅ Margen interno -->
          <p class="text-lg font-bold text-center">{{ card.question }}</p>
        </div>
        <div class="card-back flex items-center justify-center p-4"> <!-- ✅ Margen interno -->
          <p class="text-lg font-bold text-center">{{ card.answer }}</p>
        </div>
      </div>
      
    </div>

    <!-- ✅ Agregamos botones para "Anterior" e "Inicio" -->
    <div class="mt-4 flex gap-4">
      <button @click="previousCard" class="bg-blue-500 text-white px-4 py-2 rounded">
        Anterior
      </button>
      <button @click="restartStudy" class="bg-blue-500 text-white px-4 py-2 rounded">
        Inicio
      </button>
      <button @click="nextCard" class="bg-blue-500 text-white px-4 py-2 rounded">
        Siguiente
      </button>
    </div>

  </div>

  <p v-else class="text-gray-500">Cargando tarjeta...</p>
</template>

<script>
export default {
  props: {
    card: Object, // Recibe una tarjeta
    nextCard: Function, // Función para siguiente tarjeta
    previousCard: Function, // ✅ Nueva función para anterior tarjeta
    restartStudy: Function // ✅ Nueva función para reiniciar desde la primera tarjeta
  },
  data() {
    return {
      isFlipped: false
    };
  },
  methods: {
    flipCard() {
      this.isFlipped = !this.isFlipped;
    }
  }
};
</script>

<style scoped>
.card {
  width: 100%;
  height: 100%;
  position: absolute;
  transform-style: preserve-3d;
  transition: transform 0.6s;
}

.card.flipped {
  transform: rotateY(180deg);
}

.card-front, .card-back {
  width: 100%;
  height: 100%;
  position: absolute;
  backface-visibility: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  background: white;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  padding: 16px; /* ✅ Agregamos margen interno */
}

.card-back {
  transform: rotateY(180deg);
}


.card-front {
  background: #fffffb; /* amarillo claro para pregunta */
  color: #4b5563; /* gris oscuro */
  font-size: 1.25rem;
}

.card-back {
  background: #e5f1f8; /* azul claro para respuesta */
  color: #1e3a8a; /* azul fuerte */
  font-style: italic;
  font-size: 1.1rem;
}

</style>
