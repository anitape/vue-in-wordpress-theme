<?php get_header();?>

<div class="team-container">
    <div class="row">
        <div class="col-xl-8 col-lg-7 col-md-7 col-sm-12">            
                <?php 
                    $s=get_search_query();
                    $args = array(
                                    's' =>$s
                                );
                        // The Query
                    $the_query = new WP_Query( $args );
                    if ( $the_query->have_posts() ) {
                            _e("<h3 class='subpage-header'>Search Results for: ".get_query_var('s')."</h3>");
                ?>
                <div class="row">
                    <?php
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                            $intro_text = get_field('intro_text');
                            if (get_post_type( get_the_ID() ) == 'food_recipes') {
                    ?>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-5" id="app">
                            <handle-myrecipes v-slot="{ addMyrecipes, deleteMyrecipe, myallRecipes }">
                                <div class="action-heart"
                                    v-on:click="addMyrecipes(<?php the_ID(); ?>, '<?php the_title(); ?>', '<?php the_permalink(); ?>', 
                                        '<?php echo $intro_text; ?>', '<?php echo get_post_type(); ?>', '<?php echo the_post_thumbnail_url(); ?>' )">
                                    <svg width="48px" height="48px" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M17 16C15.8 17.3235 12.5 20.5 12.5 20.5C12.5 20.5 9.2 17.3235 8 16C5.2 12.9118 4.5 11.7059 4.5 9.5C4.5 7.29412 6.1 5.5 8.5 5.5C10.5 5.5 11.7 6.82353 12.5 8.14706C13.3 6.82353 14.5 5.5 16.5 5.5C18.9 5.5 20.5 7.29412 20.5 9.5C20.5 11.7059 19.8 12.9118 17 16Z"
                                                stroke="#121923" stroke-width="1.2"></path>
                                        </g>
                                    </svg>
                                </div>
                                <span v-for="recipe in myallRecipes">
                                    <span v-if="recipe.recipe_id == <?php the_ID();?>">
                                        <div class="action-heart" v-on:click="deleteMyrecipe(recipe.recipe_id)">
                                            <svg width="48px" height="48px" viewBox="0 0 25 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                                </g>
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

                            <a href="<?php the_permalink(); ?>" class="recipe-card">
                                <img class="img-fluid recipe-image" src="<?php echo the_post_thumbnail_url(); ?>">

                                <p class="highlight-text mt-3"><?php the_field('recipe_label'); ?>
                                    <span class="line-separator"></span><?php echo get_the_date( 'F j, Y' ); ?>
                                </p>
                                <h4><?php the_title(); ?></h4>
                            </a>
                        </div>
                        <?php
                            } else {
                        ?>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-5" id="app">
                            <handle-mydrinks v-slot="{ addMydrinks, deleteMydrink, myallDrinks }">
                                <div class="action-heart" v-on:click="addMydrinks(<?php the_ID(); ?>, '<?php the_title(); ?>', '<?php the_permalink(); ?>', 
                                        '<?php echo $intro_text; ?>', '<?php echo the_post_thumbnail_url(); ?>' )">
                                    <svg fill="#000000" width="48px" height="48px" viewBox="0 0 24 24" id="wine-glass"
                                        data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path id="primary"
                                                d="M12,14v7M9,21h6m-3-7h0A5,5,0,0,1,7,9V4A1,1,0,0,1,8,3h8a1,1,0,0,1,1,1V9A5,5,0,0,1,12,14Z"
                                                style="fill: none; stroke: #000000; stroke-linecap: round; stroke-linejoin: round; stroke-width:1.08;">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                                <span v-for="drink in myallDrinks">
                                    <span v-if="drink.drink_id == <?php the_ID();?>">
                                        <div class="action-heart" v-on:click="deleteMydrink(drink.drink_id)">
                                            <svg fill="#000000" width="48px" height="48px" viewBox="0 0 24 24" id="wine-glass"
                                                data-name="Flat Color" xmlns="http://www.w3.org/2000/svg"
                                                class="icon flat-color">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path id="secondary"
                                                        d="M12,22a1,1,0,0,1-1-1V14a1,1,0,0,1,2,0v7A1,1,0,0,1,12,22Z"
                                                        style="fill: #a27b20;"></path>
                                                    <path id="primary"
                                                        d="M15,22H9a1,1,0,0,1,0-2h6a1,1,0,0,1,0,2ZM16,2H8A2,2,0,0,0,6,4V9A6,6,0,0,0,18,9V4A2,2,0,0,0,16,2Z"
                                                        style="fill: #a27b20;"></path>
                                                </g>
                                            </svg>
                                        </div>
                                    </span>
                                </span>
                            </handle-mydrinks>
                            <a href="<?php the_permalink(); ?>" class="recipe-card">
                                <img class="img-fluid recipe-image" src="<?php echo the_post_thumbnail_url(); ?>">

                                <p class="highlight-text mt-3"><?php the_field('recipe_label'); ?>
                                    <span class="line-separator"></span><?php echo get_the_date( 'F j, Y' ); ?>
                                </p>
                                <h4><?php the_title(); ?></h4>
                            </a>
                        </div>
                    <?php
                                }
                            }
                        } else {
                    ?>
                        <h3 class="subpage-header">Nothing Found</h3>
                        <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
                <?php 
                    } 
                ?>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
<?php get_footer(); ?>