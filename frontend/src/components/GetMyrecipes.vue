<script>
import axios from 'axios';

    export default {
        data() {
            return {
                myallRecipes: [],
            }
        },
        methods: {
            getMyallrecipes() {                
                axios.get(`/vuewordpress/wp-json/vuewithbundler/v1/allmyrecipes`)
                .then((response) => {
                    this.myallRecipes = response.data;
                    console.log(this.myallRecipes);
                })
                .catch((error) => {
                    window.alert('There was an error '+ error);
                })             
            },
            // async myTest() {
            //     try {
            //         const response = await axios.get(`/vuewordpress/wp-json/vuewithbundler/v1/myrecipesare`);
            //         this.numofRecipes = response.data;
            //         console.log("getNum: " + this.numofRecipes);
            //     } catch (error) {
            //         window.alert('There was an error '+ error);
            //     }
            // }
        },
        mounted() {           
            this.getMyallrecipes();
        }
    }
</script>

<template>
    <div>
        <slot :myallRecipes="myallRecipes"></slot>
    </div>
</template>