<?php get_header();?>

<div class="container">
    <div class="top-bottom-margins">
        <h3 class="subpage-header">My Recipes</h3>
        <div id="app">
            <get-myrecipes v-slot="{ myallRecipes }">
                <div v-for="recipe in myallRecipes">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img :src="recipe.recipe_img" class="myrecipe-image" />
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h4>{{ recipe.recipe_name }}</h4>
                            <p>{{ recipe.recipe_description }}</p>
                            <a :href="recipe.recipe_link" class="recipe-link">Read more</a>
                        </div>
                    </div>
                </div>
            </get-myrecipes>
        </div>
    </div>
</div>


<?php wp_footer(); ?>
<?php get_footer(); ?>