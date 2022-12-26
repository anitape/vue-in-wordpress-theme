    <?php get_header();?>
  
                        
    <div id="app">
        <category-dropdown class="dropdown" v-slot="{ makeVisible, isVisible }">
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
        </category-dropdown>

        <dynamic-slider v-slot="{ setTotalImages, activeImage }">
            <div v-bind="setTotalImages(<?php echo count(get_field('slider_images'));?>)">
                <?php 
                    $slider = get_field('slider_images');
                    $index = 0;
        
                    foreach ($slider as $i => $image) : 
                ?>
                <figure v-show="activeImage == <?php echo $index++; ?>" class="slide">
                    <img src="<?php echo $image ?>" alt="" class="sliderImage">
                </figure>
                <?php endforeach ?>
            </div>
        </dynamic-slider>
    </div>


    <div class="container">
        <div class="row">
            <?php 
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 5,
                    'category_name' => 'Ruoka',
                    'orderby' => 'date',
                    'order'   => 'ASC'
                );

                $post_query = new WP_Query($args);

                if ( $post_query->have_posts() ) {

                    while ( $post_query->have_posts() ) {
                        $post_query->the_post();
                        $post_slug = $post->post_name;?>

            <div class="col-md-6 col-sm-6">
                <img class="service-info-image" src="<?php echo the_post_thumbnail_url(); ?>">
                <h3><?php the_title(); ?></h3>
                <p><?php the_field('cooking_time'); ?></p>
            </div>
            <?php    }
                } else {
                        echo 'nothing here';
                }
            ?>
        </div>
    </div>

    <?php wp_footer(); ?>
    <?php get_footer(); ?>