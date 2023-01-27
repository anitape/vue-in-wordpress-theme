<?php get_header();?>

<div class="container">
    <div class="top-bottom-margins">
        <h3 class="subpage-header">My Drinks</h3>
        <div id="app">
            <handle-mydrinks v-slot="{ myallDrinks, deleteMydrink }">
                <div v-for="drink in myallDrinks">
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-md-4 col-sm-4">
                            <img :src="drink.drink_img" class="myrecipe-image" />
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h4>{{ drink.drink_name }}</h4>
                            <div class="row">
                                <div class="col-md-10 col-sm-10">
                                    <p>{{ drink.drink_description }}</p>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <i v-on:click="deleteMydrink(drink.drink_id)" class="fa fa-trash fa-lg" aria-hidden="true" style="display: flex; justify-content: center;"></i>
                                </div>  
                            </div>  
                            <a :href="drink.drink_link" class="recipe-link">Read more</a>
                        </div>                          
                    </div>
                </div>
            </handle-mydrinks>
        </div>

    </div>
</div>


<?php wp_footer(); ?>
<?php get_footer(); ?>