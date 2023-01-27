import { createApp } from 'vue/dist/vue.esm-bundler';
import CategoryDropdown from './components/CategoryDropdown.vue';
import DynamicSlider from './components/DynamicSlider.vue';
import HandleMyrecipes from './components/HandleMyrecipes.vue';
import HandleMydrinks from './components/HandleMydrinks.vue';
import DynamicTabs from './components/DynamicTabs.vue';
import { store } from './store/index';

document.querySelectorAll('#app').forEach((el) => {
  createApp({
    components: 
       { CategoryDropdown, DynamicSlider, HandleMyrecipes, HandleMydrinks, DynamicTabs, }
  }).use(store).mount(el);
});

