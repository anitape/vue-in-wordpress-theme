<?php get_header();?>

<div class="team-container">
    <div class="row">
        <div class="col-xl-8 col-lg-7 col-md-7 col-sm-12">
            <h3 class="subpage-header">All food recipes</h3>
            <div class="row">

                <?php
                    $current_category = get_queried_object(); ////getting current category
                    $paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
                    $args = array(
                            'post_type' => 'food_recipes', // your post type,
                            'posts_per_page' => 9,
                            'paged' => $paged,
                            'orderby' => 'post_date',
                            'order' => 'DESC'
                    );
                    $the_query = new WP_Query($args);

                    if($the_query->have_posts()):
                        while($the_query->have_posts()): $the_query->the_post();
                            $intro_text = get_field('intro_text');
                            
                 ?>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-5" id="app">
                    <handle-myrecipes v-slot="{ addMyrecipes, deleteMyrecipe, myallRecipes }">
                            <div class="action-heart" v-on:click="addMyrecipes(<?php the_ID(); ?>, '<?php the_title(); ?>', '<?php the_permalink(); ?>', 
                                '<?php echo $intro_text; ?>', '<?php echo get_post_type(); ?>', '<?php echo the_post_thumbnail_url(); ?>' )">
                                <svg width="48px" height="48px" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M17 16C15.8 17.3235 12.5 20.5 12.5 20.5C12.5 20.5 9.2 17.3235 8 16C5.2 12.9118 4.5 11.7059 4.5 9.5C4.5 7.29412 6.1 5.5 8.5 5.5C10.5 5.5 11.7 6.82353 12.5 8.14706C13.3 6.82353 14.5 5.5 16.5 5.5C18.9 5.5 20.5 7.29412 20.5 9.5C20.5 11.7059 19.8 12.9118 17 16Z" stroke="#121923" stroke-width="1.2"></path> </g></svg>
                            </div>                     
                            <span v-for="recipe in myallRecipes">
                                <span v-if="recipe.recipe_id == <?php the_ID();?>">
                                    <div class="action-heart" v-on:click="deleteMyrecipe(recipe.recipe_id)">
                                        <svg width="48px" height="48px" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M17 16C15.8 17.3235 12.5 20.5 12.5 20.5C12.5 20.5 9.2 17.3235 8 16C5.2 12.9118 4.5 11.7059 4.5 9.5C4.5 7.29412 6.1 5.5 8.5 5.5C10.5 5.5 11.7 6.82353 12.5 8.14706C13.3 6.82353 14.5 5.5 16.5 5.5C18.9 5.5 20.5 7.29412 20.5 9.5C20.5 11.7059 19.8 12.9118 17 16Z" fill="#a27b20" stroke="#a27b20" stroke-width="1.2"></path> </g></svg>
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
                    endwhile;
                    endif;                   
                ?>
            </div>
            <?php
                the_posts_pagination();
            ?>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-5 col-sm-12" id="app">
            <category-dropdown class="menu-dropdown" v-slot="{ makeVisible, isVisible }">
                <div class="dropdown">
                    <button type="button" class="btn-category" v-on:click="makeVisible">
                        <span>Select Category</span> <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </button>
                    <div class="food-dropdown-menu" :style="{ 'visibility': isVisible }">
                        <?php 
                            $taxonomies = get_object_taxonomies( 'food_recipes', 'objects' );

                            foreach( $taxonomies as $taxonomy ) {
                                if ($taxonomy->name != "post_tag") {                                
                                    echo $taxonomy->name;
                                
                                    $terms = get_terms(array(
                                        'taxonomy' => $taxonomy->name,
                                        'hide_empty' => false,
                                    ));
                                    
                                    foreach( $terms as $term ) {
                                        $term_link = get_term_link( $term );
                                        echo "<a class='dropdown-item' href='{$term_link}'>{$term->name}</a>";
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </category-dropdown>
            <div style="margin: 50px;">
                <h6 class="sub-title-margin-bottom">Tags</h6>
                <div class="recipe-tags">
                    <?php
                        $terms = get_terms_by_custom_post_type('food_recipes','post_tag');
                        foreach( $terms as $term ) {
                            $term_link = get_term_link( $term );
                    ?>
                    <span><a href="<?php echo $term_link; ?>" rel="tag"
                            class="archive-tag"><?php echo $term->name; ?></a></span>
                    <?php     
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
<?php get_footer(); ?>