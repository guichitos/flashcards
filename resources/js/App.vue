<template>
  <div>
    <nav class="p-4 bg-gray-200 flex justify-around">
      <router-link to="/cards" class="text-blue-500 font-semibold">📜 Mis Tarjetas</router-link>
    </nav>

    <router-view></router-view> <!-- 🔹 Aquí Vue Router mostrará las páginas -->
  </div>
</template>

<script>
export default {
  name: "App"
};
</script>
