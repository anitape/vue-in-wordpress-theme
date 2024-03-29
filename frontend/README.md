# Setting up a Vue app inside a WordPress theme

Here you can find step-by-step instructions to set up a Vue app inside a WordPress theme. Additionally, the instruction includes information about how to use Vuex and Axios in a WordPress theme.

Splitting the code into multiple .vue files with single-file components will require the use of development tools like Webpack, Parcel, Vue CLI or Vite. This project uses <b>the Vue CLI</b> for this purpose. See <a href="https://cli.vuejs.org/config/">Configuration Reference</a>. The Vue app in this WordPress theme is build with <b>Vue 3</b>. The app uses also <b>Vuex</b> and <b>Axios</b>.

<b>Table of contents</b>

- [1. Install Node.js, Vue CLI and the Vue project](#1-install-nodejs-vue-cli-and-the-vue-project)
- [2. Vue configurations](#2-vue-configurations)
- [3. Build the Vue project](#3-build-the-vue-project)
- [4. Connect physical Vue files to your WordPress theme](#4-connect-physical-vue-files-to-your-wordpress-theme)
- [5. Informing Vue about the Mount Point in WordPress](#5-informing-vue-about-the-mount-point-in-wordpress)
- [6. Sending Vue data and functionalities from Vue components](#6-sending-vue-data-and-functionalities-from-vue-components)
- [7. Receiving data from Vue components](#7-receiving-data-from-vue-components)
- [8. Build your Vue project again](#8-build-your-vue-project-again)
- [Compiles and hot-reloads for development](#compiles-and-hot-reloads-for-development)
- [Using Vuex in your WordPress theme](#using-vuex-in-your-wordpress-theme)
- [Using Axios with the WordPress custom REST API](#using-axios-with-the-wordpress-custom-rest-api)

## 1. Install Node.js, Vue CLI and the Vue project

To use <b>the Vue CLI</b>, you will require Node.js installed on your system. Then, you need to open your system’s terminal and install <b>the Vue CLI</b> globally by running the following command.

```
npm install -g @vue/cli
```

Next step is to create the Vue project to your WordPress theme by using the command below.

```
vue create vue-project
```

## 2. Vue configurations

To make Vue work properly inside your WordPress theme, you need to add the following configurations to <b><i>vue.config.js</i></b> file. Use your Vue project app path with additional <b><i>dist</i></b> folder as ```publicPath```. This <b><i>dist</i></b> folder will be created automatically when you build your Vue app.

```
const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  filenameHashing: false,
  publicPath: '/wp-content/themes/your-wptheme/vue-project/dist',
  chainWebpack: config => {
    config.plugins.delete('html');
    config.plugins.delete('preload');
    config.plugins.delete('prefetch');
  },
  devServer: {
    devMiddleware: {
      writeToDisk: true,
    },
    hot: false,
  },
  css: {
    extract: true,
  },
  runtimeCompiler: true
})
```

## 3. Build the Vue project

To generate physical build files that you have to connect to your WordPress theme, you need to run the command below. By running this command, Vue generates inside the Vue project <b><i>dist</i></b> folder that will include the physical files.

```
npm run build
```

## 4. Connect physical Vue files to your WordPress theme

To let WordPress know about the Vue project, you have to enqueue the Vue bundle in WordPress. Add physical files generated by Vue to <b><i>functions.php</i></b> file according the instruction below. The physical files are <b><i>app.css</i></b>, <b><i>chunk-vendors.js</i></b> and <b><i>app.js</i></b> and they can be found from <b><i>dist</i></b> folder in the Vue project.

```
function essential_scripts() {
    wp_enqueue_style(
            'vue-cli-css',
            get_template_directory_uri() . '/vue-project/dist/css/app.css',
            [],
            '0.1.0'
        );

        wp_enqueue_script(
            'vue-cli-vendors',
            get_template_directory_uri() . '/vue-project/dist/js/chunk-vendors.js',
            [],
            '0.1.0',
            true
        );
        
        wp_enqueue_script(
            'vue-cli-app',
            get_template_directory_uri() . '/vue-project/dist/js/app.js',
            [],
            '0.1.0',
            true
        );
}

add_action('wp_enqueue_scripts', 'essential_scripts');
```

## 5. Informing Vue about the Mount Point in WordPress

Finally, to load the Vue project in WordPress, you need to tell Vue where to mount itself. This can be done by specifying the WordPress DOM element in <b><i>main.js</b></i> file of your Vue project. The following example allows to use reusable Vue components in DOM elements whose id is ```app```.

```
import { createApp } from 'vue/dist/vue.esm-bundler';
import VueComponent1 from './components/VueComponent1.vue';
import VueComponent2 from './components/VueComponent2.vue';
import VueComponent3 from './components/VueComponent3.vue';

document.querySelectorAll('#app').forEach((el) => {
  createApp({
    components: 
       { VueComponent1, VueComponent2, VueComponent3 }
  }).mount(el);
});
```

## 6. Sending Vue data and functionalities from Vue components
If you are using <b>Vue 3</b>, you have to use <a href="https://vuejs.org/guide/components/slots.html#scoped-slots">Scoped Slots</a> to send data from Vue components to WordPress. The example below shows how to send data to WordPress via Vue component template by using <b>Scoped Slots</b>.


```
<script>
    export default {
        data() {
            return {
                dataState: 0,
            }
        },
        methods: {
            increaseFunc() {
                this.dataState++;
            }
        },
    };
</script>

<template>
    <div>
        <slot :dataState="dataState" :increaseFunc="increaseFunc"></slot>
    </div>
</template>
```
## 7. Receiving data from Vue components
To receive data from a Vue component, you need to define the mounting DOM element by adding ```app``` id. Inside that element you will need to use kebab-case and explicit closing tags for Vue components. To pass slot props, use ```v-slot``` directive directly on the Vue component tag. Put all data you want to receive from the Vue component to ```v-slot``` directive.

```
<div id="app">
    <vue-component1 v-slot="{ dataState, increaseFunc }">
        <h1> {{dataState}} </h1>
        <button v-on:click="increaseFunc"></button>
    </vue-component1>
</div>
```

## 8. Build your Vue project again 
Everytime you create or delete Vue components or make new configurations to your Vue project, you have to built your Vue project again by running the command below.

```
npm run build
```
## Compiles and hot-reloads for development
You can always run the following command in your Vue project to check if the Vue project is running properly.
```
npm run serve
```

## Using Vuex in your WordPress theme
To install <b>Vuex</b>, run the command below in your Vue project.
```
npm install vuex@next --save
```
Then, add store to <i><b>main.js</b></i> file according to the following example.

```
import { createApp } from 'vue/dist/vue.esm-bundler';
import { store } from './store/index';
import VueComponent1 from './components/VueComponent1.vue';
import VueComponent2 from './components/VueComponent2.vue';
import VueComponent3 from './components/VueComponent3.vue';

document.querySelectorAll('#app').forEach((el) => {
  createApp({
    components: 
       { VueComponent1, VueComponent2, VueComponent3 }
  }).use(store).mount(el);
});
```
<b>Vuex</b> generates to <i><b>src</b></i> folder a new folder, the name of which is <i><b>store</b></i>, with <i><b>index.js</b></i> file. Then, you can create a store to <i><b>index.js</b></i> file with ```createStore``` method as showed in the example presented below.

```
import { createStore } from "vuex";

export const store = createStore({
    state() {
      return {
        dataState1: 0,
        dataState2: false,
      }
    }
  });
```
When using Vuex store data in a Vue component, you need to put ```store``` in front of the store data variable. It's possible to pass the store data to WordPress using Scoped Slots. Then, you need to use ```$store``` with the passing store data in ```slot``` element.

```
<script>
import { store } from '../store/index';
export default {
    methods: {
        increaseFunc() {
            store.state.dataState1++;
        },
        booleanFunc() {
            if(store.state.dataState2 == false) {
                store.state.dataState2 == true;
            } else {
                store.state.dataState2 == false;
            }
        }
    },
};
</script>

<template>
    <div>
        <slot :dataState1="$store.state.dataState1" :increaseFunc="increaseFunc" :dataState2="$store.state.dataState2" :booleanFunc="booleanFunc"></slot>
    </div>
</template>
```


## Using Axios with the WordPress custom REST API
Install axios by using the following command.
```
npm install --save axios vue-axios
```

When using axios in a Vue component, use <a href="https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/">WordPress custom REST API endpoints</a> with axios methods. The following example illustrates ```get``` method that uses a WordPress custom REST API endpoint.

```
<script>
import axios from 'axios';

export default {
    methods: {
        getAllitems() {                
                axios.get(`/wordpress/wp-json/wptheme/v1/customendpoint`)
                .then((response) => {
                    // Do something with response.data
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log('There was an error '+ error);
                })             
            },
    }
}
</script>
```
Create a WordPress custom REST API endpoint to <b><i>functions.php</i></b> file. The example presented below shows how to create a custom route with its own endpoint. The created endpoint has ```GET``` method that returns all data from a selected WordPress data table.

```
<?php
function get_all_items() {
    global $wpdb;
    $allitems = $wpdb->get_results(" SELECT * FROM " . $wpdb->prefix . "wptable");
    return $allitems;
}

function get_all_items_route() {
    register_rest_route( 'wptheme/v1', '/customendpoint', array(
      'methods' => 'GET',
      'callback' => 'get_all_items',
    ) );
}

add_action( 'rest_api_init',  'get_all_items_route');
?>
```








