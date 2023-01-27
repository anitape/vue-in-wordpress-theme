<script>
import { store } from '../store/index';
import axios from 'axios';

    export default {
        data() {
            return {
              //  myallRecipes: [],
            }
        },
        methods: {
            getNumofMyrecipes() {                
                axios.get(`/vuewordpress/wp-json/vuewithbundler/v1/myrecipesare`)
                .then((response) => {
                    store.state.numofRecipes = response.data;
                    //console.log(response);
                })
                .catch((error) => {
                    console.log('There was an error '+ error);
                })             
            },
            getMyallrecipes() {                
                axios.get(`/vuewordpress/wp-json/vuewithbundler/v1/allmyrecipes`)
                .then((response) => {
                    store.state.myallRecipes = response.data;
                    //console.log(this.myallRecipes);
                })
                .catch((error) => {
                    console.log('There was an error '+ error);
                })             
            },
            addMyrecipes(rid, rname, rlink, rdescription, rtype, rimg) {
                const data = `recipeId=${rid}&recipeName=${rname}&recipeLink=${rlink}&recipeDescription=${rdescription}&recipeType=${rtype}&recipeImg=${rimg}`;
                axios.post(`/vuewordpress/wp-json/vuewithbundler/v1/myrecipes`, data)
                    .catch((error) => {
                        console.log('There was an error '+ error);
                    })
                    .finally(() => {
                        this.getMyallrecipes();                      
                        this.getNumofMyrecipes();
                    })                    
            },
            deleteMyrecipe(rid) {
                const data = `recipeId=${rid}`;
                axios.post(`/vuewordpress/wp-json/vuewithbundler/v1/myrecipe`, data)
                .catch((error) => {
                    console.log('There was an error '+ error);
                })
                .finally(() => {
                    this.getMyallrecipes();
                    this.getNumofMyrecipes();
                })
            },
        },
        mounted() {           
            this.getNumofMyrecipes();
            this.getMyallrecipes();
        }
    }
</script>

<template>
    <div>
        <slot :addMyrecipes="addMyrecipes" :numofRecipes="$store.state.numofRecipes" 
        :myallRecipes="$store.state.myallRecipes" :deleteMyrecipe="deleteMyrecipe"></slot>
    </div>
</template>