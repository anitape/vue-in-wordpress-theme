<?php get_header();?>

<div class="team-container">
    <div class="row">
        <div class="col-sm-8">
            <?php
            $cat_name = get_queried_object()->name;                    
            ?>
            <h3 class="subpage-header">All food recipes</h3>

            <div class="row">

                <?php
                    $current_category = get_queried_object(); ////getting current category
                    $args = array(
                            'post_type' => 'food_recipes', // your post type,
                            'orderby' => 'post_date',
                            'order' => 'DESC'
                    );
                    $the_query = new WP_Query($args);

                    if($the_query->have_posts()):
                        while($the_query->have_posts()): $the_query->the_post();
                            $intro_text = get_field('intro_text');
                            
                 ?> 

                <div class="col-md-4 col-sm-4">
                    <img class="img-fluid recipe-image" src="<?php echo the_post_thumbnail_url(); ?>">
                    <div class="margin-class" id="app">
                        <p class="highlight-text"><?php the_field('recipe_label'); ?>
                        <span class="line-separator"></span><?php echo get_the_date( 'F j, Y' ); ?></p>
                        <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                        <add-myrecipes v-slot="{ addMyrecipes }">
                                <button v-on:click="addMyrecipes(<?php the_ID(); ?>, '<?php the_title(); ?>', '<?php the_permalink(); ?>', 
                                '<?php echo $intro_text; ?>', '<?php echo get_post_type(); ?>', '<?php echo the_post_thumbnail_url(); ?>' )">Add to My Recipes</button>
                        </add-myrecipes>
                    </div>
                </div>

                <?php
                    endwhile;
                    endif;
                ?>
            </div>
        </div>
        <div class="col-sm-4" id="app">
            <category-dropdown class="menu-dropdown" v-slot="{ makeVisible, isVisible }">
                <div class="dropdown">
                    <button type="button" class="btn-category" v-on:click="makeVisible">
                        <span>Select Category</span> <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </button>
                    <div class="food-dropdown-menu" :style="{ 'visibility': isVisible}">
                        <?php 
                        $taxonomies = get_object_taxonomies( 'food_recipes', 'objects' );

                        foreach( $taxonomies as $taxonomy ){
                            echo $taxonomy->name;
                        
                            $terms = get_terms(array(
                                'taxonomy' => $taxonomy->name,
                                'hide_empty' => false,
                            ));
                        
                            foreach( $terms as $term ){
                                $term_link = get_term_link( $term );
                                echo "<a class='dropdown-item' href='{$term_link}'>{$term->name}</a>";
                            }
                        }
                    ?>
                    </div>
                </div>
            </category-dropdown>
        </div>
    </div>
</div>


    <?php wp_footer(); ?>
    <?php get_footer(); ?>