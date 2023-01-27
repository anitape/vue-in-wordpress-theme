<script>
import { store } from '../store/index';
import axios from 'axios';

    export default {
        methods: {
            getNumofMydrinks() {                
                axios.get(`/vuewordpress/wp-json/vuewithbundler/v1/mydrinksare`)
                .then((response) => {
                    store.state.numofDrinks = response.data;
                    //console.log(response);
                })
                .catch((error) => {
                    console.log('There was an error '+ error);
                })             
            },
            getMyalldrinks() {                
                axios.get(`/vuewordpress/wp-json/vuewithbundler/v1/alldrinks`)
                .then((response) => {
                    store.state.myallDrinks = response.data;
                    //console.log(this.myallDrinks);
                })
                .catch((error) => {
                    console.log('There was an error '+ error);
                })             
            },
            addMydrinks(did, dname, dlink, ddescription, dimg) {
                const data = `drinkId=${did}&drinkName=${dname}&drinkLink=${dlink}&drinkDescription=${ddescription}&drinkImg=${dimg}`;
                axios.post(`/vuewordpress/wp-json/vuewithbundler/v1/mydrinks`, data)
                    .catch((error) => {
                        console.log('There was an error '+ error);
                    })
                    .finally(() => {
                        this.getMyalldrinks();                      
                        this.getNumofMydrinks();
                    })                    
            },
            deleteMydrink(did) {
                const data = `drinkId=${did}`;
                axios.post(`/vuewordpress/wp-json/vuewithbundler/v1/mydrink`, data)
                .catch((error) => {
                    console.log('There was an error '+ error);
                })
                .finally(() => {
                    this.getMyalldrinks();
                    this.getNumofMydrinks();
                })
            },
        },
        mounted() {           
            this.getNumofMydrinks();
            this.getMyalldrinks();
        }
    }
</script>

<template>
    <div>
        <slot :addMydrinks="addMydrinks" :numofDrinks="$store.state.numofDrinks" 
        :myallDrinks="$store.state.myallDrinks" :deleteMydrink="deleteMydrink"></slot>
    </div>
</template>