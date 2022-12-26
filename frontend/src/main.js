import { createApp } from 'vue/dist/vue.esm-bundler';
import CategoryDropdown from './components/CategoryDropdown.vue';
import DynamicSlider from './components/DynamicSlider.vue';
import AddMyrecipes from './components/AddMyrecipes.vue';
import NumofMyrecipes from './components/NumofMyrecipes.vue';
import GetMyrecipes from './components/GetMyrecipes.vue';
import { store } from './store/index';

document.querySelectorAll('#app').forEach((el) => {
  createApp({
    components: 
       { CategoryDropdown, DynamicSlider, AddMyrecipes, NumofMyrecipes, GetMyrecipes }
  }).use(store).mount(el);
});

