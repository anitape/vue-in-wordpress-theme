<?php get_header(); ?>

<div id="app">
    <dynamic-slider v-slot="{ setTotalImages, activeImage, nextSlide, prevSlide, setActiveImage }">
        <div class="carousel slide">
            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li :class="{'active': activeImage == 0}" v-on:click="setActiveImage(0)"></li>
                <li :class="{'active': activeImage == 1}" v-on:click="setActiveImage(1)"></li>
                <li :class="{'active': activeImage == 2}" v-on:click="setActiveImage(2)"></li>
            </ul>
            <div v-bind="setTotalImages(<?php echo count(get_field('slider_images'));?>)">
                <?php                
                    $slider = get_field('slider_images');
                    $index = 0;
        
                    for($i = 0; $i < count($slider); $i++) {
                ?>
                <figure v-show="activeImage == <?php echo $index++; ?>" class="slide">
                    <img src="<?php echo $slider['image_slide_' . $i+1]['image_'. $i+1]; ?>" alt="" class="sliderImage">
                    <h3 class="slide-text"><?php echo $slider['image_slide_' . $i+1]['image_'. $i+1 . '_text']; ?></h3>
                </figure>
                <?php } ?>
            </div>
            <div class="carousel-control-prev">
                <div class="carousel-control-button-prev" v-on:click="prevSlide">
                    <span class="carousel-control-prev-icon"></span>
                </div>
            </div>
            <div class="carousel-control-next">
                <div class="carousel-control-button-next" v-on:click="nextSlide">
                    <span class="carousel-control-next-icon"></span>
                </div>
            </div>
        </div>
    </dynamic-slider>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="mb-5 mt-4"><?php the_title(); ?></h2>
           <?php echo get_field('description_text'); ?>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
<?php get_footer(); ?>