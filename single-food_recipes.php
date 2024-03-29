<?php get_header(); ?>
<div class="container single-page-margin-bottom">
    <h2 class="header-margins single-title"><?php the_title(); ?></h2>
    <p class="single-intro-text"><?php the_field('intro_text'); ?></p>
    <img class="img-fluid single-recipe-image" src="<?php echo the_post_thumbnail_url(); ?>">
    <hr class="single-line">
    <div class="row">        
        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-9">
            <h3 style="margin-bottom: 30px;"><?php the_title(); ?></h3>
            <div class="recipe-info">
                <p class="heading-text text-margin-bottom">Cooking time:&nbsp;</p>
                <p class="text-margin-bottom"><?php the_field('cooking_time'); ?></p>
            </div>
            <div class="recipe-info">
                <p class="heading-text text-margin-bottom">Servings:&nbsp;</p>
                <p class="text-margin-bottom"><?php the_field('servings'); ?></p>
            </div>
        </div>
        <?php
            $intro_text = get_field('intro_text');
        ?>
        <div class="col-xl-7 col-lg-7 col-md-6 col-sm-3" id="app">
            <handle-myrecipes v-slot="{ addMyrecipes, deleteMyrecipe, myallRecipes }">
                <div class="action-heart action-heart-single"
                    v-on:click="addMyrecipes(<?php the_ID(); ?>, '<?php the_title(); ?>', '<?php the_permalink(); ?>', 
            '<?php echo $intro_text; ?>', '<?php echo get_post_type(); ?>', '<?php echo the_post_thumbnail_url(); ?>' )">
                    <svg width="48px" height="48px" viewBox="0 0 25 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                        </g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M17 16C15.8 17.3235 12.5 20.5 12.5 20.5C12.5 20.5 9.2 17.3235 8 16C5.2 12.9118 4.5 11.7059 4.5 9.5C4.5 7.29412 6.1 5.5 8.5 5.5C10.5 5.5 11.7 6.82353 12.5 8.14706C13.3 6.82353 14.5 5.5 16.5 5.5C18.9 5.5 20.5 7.29412 20.5 9.5C20.5 11.7059 19.8 12.9118 17 16Z"
                                stroke="#121923" stroke-width="1.2"></path>
                        </g>
                    </svg>
                </div>
                <span v-for="recipe in myallRecipes">
                    <span v-if="recipe.recipe_id == <?php the_ID();?>">
                        <div class="action-heart action-heart-single" v-on:click="deleteMyrecipe(recipe.recipe_id)">
                            <svg width="48px" height="48px" viewBox="0 0 25 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                    stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M17 16C15.8 17.3235 12.5 20.5 12.5 20.5C12.5 20.5 9.2 17.3235 8 16C5.2 12.9118 4.5 11.7059 4.5 9.5C4.5 7.29412 6.1 5.5 8.5 5.5C10.5 5.5 11.7 6.82353 12.5 8.14706C13.3 6.82353 14.5 5.5 16.5 5.5C18.9 5.5 20.5 7.29412 20.5 9.5C20.5 11.7059 19.8 12.9118 17 16Z"
                                        fill="#a27b20" stroke="#a27b20" stroke-width="1.2"></path>
                                </g>
                            </svg>
                        </div>
                    </span>
                </span>
            </handle-myrecipes>
        </div>
    </div>  
    <?php 
        $inc_string = get_field('ingredients');
        $inc_table = explode("\n", $inc_string);
        $instruction_string = get_field('instructions');
        $instruction_table = preg_split("/Step/", $instruction_string, -1, PREG_SPLIT_NO_EMPTY);
    ?>
    <div class="mt-5" id="app">
        <dynamic-tabs v-slot="{ tabIndex, setTabindex, setIncitable, inciTable, setCheckstat }">
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item" v-on:click.prevent="setTabindex(1)">
                    <a class="nav-link" :class="{'active': tabIndex == 1}" href="#tab-1">Ingredients</a>
                </li>
                <li class="nav-item" v-on:click.prevent="setTabindex(2)">
                    <a class="nav-link" :class="{'active': tabIndex == 2}" href="#tab-2">Instructions</a>
                </li>
                <li class="nav-item" v-on:click.prevent="setTabindex(3)">
                    <a class="nav-link" :class="{'active': tabIndex == 3}" href="#tab-3">Nutrition Facts</a>
                </li>
            </ul>
            <div class="tab-table">
                <div v-show="tabIndex == 1" id="tab-1">
                    <h4 class="tab-title">Ingredients</h4>
                    <ul>
                        <?php 
                            foreach ($inc_table as $item) {                                                    
                        ?>
                        <li>
                            <!-- <i class="fa fa-square-o fa-lg ingredient-list-icon" aria-hidden="true"></i>
                            <i class="fa fa-check-square-o fa-lg ingredient-list-icon" aria-hidden="true"></i> -->
                            <?php echo $item;?>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
                <div v-show="tabIndex == 2" id="tab-2">
                    <h4 class="tab-title">Instructions</h4>
                    <ul class="list-no-style">
                        <?php 
                            foreach ($instruction_table as $index => $value) {                                                    
                        ?>
                        <li class="instruction-step">
                            <div class="instruction-step-num"><?php echo $index+1; ?></div>
                            <div class="instruction-text">Step <?php echo $value;?></div>
                        </li>
                        <!-- <li v-bind="setIncitable(<-?php echo $key; ?>, false)">
                            <i class="fa fa-square-o fa-lg ingredient-list-icon" v-on:click.prevent="setCheckstat(<-?php echo $key; ?>, true)" aria-hidden="true"></i>
                            <i class="fa fa-check-square-o fa-lg ingredient-list-icon" v-show="inciTable[<-?php echo $key; ?>].status == true" v-on:click.prevent="setCheckstat(<-?php echo $key; ?>, false)" aria-hidden="true"></i>
                        </li> -->
                        <?php
                            }
                        ?>
                    </ul>
                </div>
                <div v-show="tabIndex == 3" id="tab-3">
                    <h4>Nutrition Facts</h4>
                    <p class="tab-title">per serving</p>
                    <?php
                        $nutrition_facts = get_field('nutrition_facts');
                    ?>
                    <div class="row" style="margin-top: 96px;">
                        <div class="col-md-3 col-sm-3">
                            <p class="text-margin-bottom"><b><?php echo $nutrition_facts['calories']; ?></b></p>
                            <p class="text-margin-bottom">Calories</p>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <p class="text-margin-bottom"><b><?php echo $nutrition_facts['fat']; ?>g</b></p>
                            <p class="text-margin-bottom">Fat</p>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <p class="text-margin-bottom"><b><?php echo $nutrition_facts['carbs']; ?>g</b></p>
                            <p class="text-margin-bottom">Carbs</p>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <p class="text-margin-bottom"><b><?php echo $nutrition_facts['protein']; ?>g</b></p>
                            <p class="text-margin-bottom">Protein</p>
                        </div>
                    </div>
                </div>
            </div>
        </dynamic-tabs>
        <h6 class="sub-title-margin-bottom">Categories</h6>
        <div class="recipe-taxonomy d-flex flex-wrap">
            <?php
                $taxonomies = get_post_taxonomies(get_the_id());
                foreach ($taxonomies as $taxonomy) {
                    if ($taxonomy != "post_tag") {
                        $terms = the_terms( get_the_id(), $taxonomy, '', '');
                        echo $terms;
                    }
                }
            ?>
        </div>
        <h6 class="sub-title-margin-bottom">Tags</h6>
        <?php $post_tags = get_the_tags(); ?>
        <div class="recipe-tags d-flex flex-wrap">
            <?php 
                if ($post_tags) { 
                     foreach ( $post_tags as $key => $tag ) { 
                        if ($key < count($post_tags)-1) {
            ?>
            <span><a href="<?php echo get_tag_link( $tag->term_id ); ?> " rel="tag"><?php echo $tag->name; ?></a>,</span>
            <?php 
                } else {
            ?>
            <span><a href="<?php echo get_tag_link( $tag->term_id ); ?> " rel="tag"><?php echo $tag->name; ?></a></span>
            <?php 
                    }
                }
            }
            ?>

        </div>
    </div>
</div>
<?php wp_footer(); ?>
<?php get_footer(); ?>