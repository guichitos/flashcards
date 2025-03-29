import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
import CardsPage from './webpages/CardsPage.vue';
import StudyPage from './webpages/StudyPage.vue'; // ✅ Importamos la nueva página
import ConfigPage from './webpages/ConfigPage.vue';


const routes = [
  { path: '/cards', component: CardsPage },
{ path: '/cards/study', component: StudyPage },
{ path: '/cards/config', component: ConfigPage },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

const app = createApp(App);
app.use(router);
console.log("✅ Vue se está ejecutando correctamente"); // Debug
app.mount('#app');
