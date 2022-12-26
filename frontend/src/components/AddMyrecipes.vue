<script>
import { store } from '../store/index';
import axios from 'axios';

    export default {
        data() {
            return {
                recipeData: null,
                // recipeId: null,
                // recipeName: null,
                // recipeLink: null,
                // recipeDescription: '',
                // recipeType: null,
                // recipeImg: null,
            }
        },
        methods: {
            addMyrecipes(rid, rname, rlink, rdescription, rtype, rimg) {
                // this.recipeId = rid;
                // this.recipeName = rname;
                // this.recipeLink = rlink;
                // this.recipeDescription = rdescription;
                // this.recipeType = rtype;
                // this.recipeImg = rimg;
                //const data = `recipeId=${rid}&a=1&b=2`;
                const data = `recipeId=${rid}&recipeName=${rname}&recipeLink=${rlink}&recipeDescription=${rdescription}&recipeType=${rtype}&recipeImg=${rimg}`;
                axios.post(`/vuewordpress/wp-json/vuewithbundler/v1/myrecipes`, data)
                    .then((response) => {
                        this.recipeData = response.data.myrecipes;
                        console.log(data);
                    })
                    .catch((error) => {
                        window.alert('There was an error '+ error);
                    })
                    .finally(() => {                        
                        this.getMyrecipes(); 
                    })                    
            },
            getMyrecipes() {                
                axios.get(`/vuewordpress/wp-json/vuewithbundler/v1/myrecipesare`)
                .then((response) => {
                    store.state.numofRecipes = response.data;
                    console.log(response);
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
            this.getMyrecipes();
        }
    }
</script>

<template>
    <div>
        <slot :addMyrecipes="addMyrecipes" :numofRecipes="$store.state.numofRecipes"></slot>
    </div>
</template>