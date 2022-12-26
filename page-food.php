<?php get_header();?>

<div class="team-container">
    <div class="row">
        <div class="col-sm-8">
            <?php
            $cat_name = get_queried_object()->name;                    
            ?>
            <h3 class="subpage-header">All food recipes <?php echo $cat_name; ?></h3>

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
                 ?>

                <div class="col-md-4 col-sm-4">
                    <img class="img-fluid recipe-image" src="<?php echo the_post_thumbnail_url(); ?>">
                    <div class="margin-class">
                        <p class="highlight-text"><?php the_field('recipe_label'); ?>
                        <span class="line-separator"></span><?php echo get_the_date( 'F j, Y' ); ?></p>
                        <h4><?php the_title(); ?></h4>
                    </div>
                    
                </div>

                <?php
                    endwhile;
                    endif;
                ?>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="menu-dropdown">
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
            </div>
        </div>
    </div>
</div>


    <?php wp_footer(); ?>
    <?php get_footer(); ?>