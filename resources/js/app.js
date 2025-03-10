import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
import CardsPage from './webpages/CardsPage.vue';
import StudyPage from './webpages/StudyPage.vue'; // ✅ Importamos la nueva página


const routes = [
  { path: '/cards', component: CardsPage },
{ path: '/cards/study', component: StudyPage } // ✅ Agregamos la nueva ruta
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

const app = createApp(App);
app.use(router);
console.log("✅ Vue se está ejecutando correctamente"); // Debug
app.mount('#app');
