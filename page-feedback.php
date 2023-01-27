<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h3 class="my-5" style="font-size: 42px;"><?php the_title(); ?></h3>
            <div class="my-5 py-5">
                <?php

                    if (comments_open()){
                        comments_template();
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
<?php get_footer(); ?>