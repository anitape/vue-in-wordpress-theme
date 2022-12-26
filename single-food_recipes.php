<?php get_header(); ?>
<div class="container">
    <img class="img-fluid recipe-image" src="<?php echo the_post_thumbnail_url(); ?>">
    <div id="tab-component">
        
        
            <p>tabIndex is: {{ tabIndex }}</p>
            <ul class="nav nav-tabs">
                <li :class="{'active': tabIndex == 1}">
                    <a href="#tab-1" v-on:click.prevent="tabIndex = 1">Menu 1</a>
                </li>
                <li :class="{'active': tabIndex == 2}">
                    <a href="#tab-2" v-on:click.prevent="tabIndex = 2">Menu 2</a>
                </li>
                <li :class="{'active': tabIndex == 3}">
                    <a href="#tab-3" v-on:click.prevent="tabIndex = 3">Menu 3</a>
                </li>
            </ul>
            <div>
                <div v-show="tabIndex == 1" id="tab-1">
                    1. Lorem Ipsum
                </div>
                <div v-show="tabIndex == 2" id="tab-2">
                    2. Lorem Ipsum
                </div>
                <div v-show="tabIndex == 3" id="tab-3">
                    3. Lorem Ipsum
                </div>
            </div>
        
        
    </div>
</div>
<?php wp_footer(); ?>
<?php get_footer(); ?>