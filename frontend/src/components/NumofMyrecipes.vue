<script>
import axios from 'axios';

    export default {
        data() {
            return {
                numofRecipes2: 0,
            }
        },
        methods: {
            count() {
                this.numofRecipes++;
            },
        },
        mounted() {
                axios.get(`/vuewordpress/wp-json/vuewithbundler/v1/myrecipesare`)
                    .then((response) => {
                        this.numofRecipes2 = response.data;
                        console.log(response);
                    })
                    .catch((error) => {
                        window.alert('There was an error '+ error);
                    })
                    console.log(this.numofRecipes2);
                }, 
    }
</script>

<template>
    <div>
        <slot :numofRecipes="numofRecipes2" :count="count"></slot>
    </div>
</template>