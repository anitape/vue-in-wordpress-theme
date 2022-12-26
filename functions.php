<?php

/* Hiding admin bar*/

add_filter('show_admin_bar', '__return_false');

/* Enabling menu editor in WP admin panel*/

function register_wpmenu(){
    register_nav_menu('primary', 'Main menu');
}

add_action('init', 'register_wpmenu');

/* Adding featured image to posts*/
add_theme_support('post-thumbnails');


/* Adding essential styles and scripts*/
function essential_scripts() {

    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css',
        [],
        '4.5.3'
    );
  

    wp_enqueue_style(
        'essential-style',
        get_template_directory_uri() . '/style.css',
        [],
        '0.1.0'
    );

    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
        [],
        '4.7.0'
    );

    // load css and js files with bundlers

    wp_enqueue_style(
        'vue-cli-css',
        get_template_directory_uri() . '/frontend/dist/css/app.css',
        [],
        '0.1.0'
    );

    wp_enqueue_script(
        'vue-cli-vendors',
        get_template_directory_uri() . '/frontend/dist/js/chunk-vendors.js',
        [],
        '0.1.0',
        true
    );
    
    wp_enqueue_script(
        'vue-cli-app',
        get_template_directory_uri() . '/frontend/dist/js/app.js',
        [],
        '0.1.0',
        true
    );

    // wp_enqueue_script(
    //     'vue-test',
    //     get_template_directory_uri() . '/js/test.js',
    //     ['vue'],
    //     '0.1.0',
    //     true
    // );

    // wp_enqueue_script(
    //     'slider',
    //     get_template_directory_uri() . '/js/slider.js',
    //     ['vue'],
    //     '0.1.0',
    //     true
    // );

    // wp_enqueue_script(
    //     'dropdowns',
    //     get_template_directory_uri() . '/js/dropdowns.js',
    //     ['vue'],
    //     '0.1.0',
    //     true
    // );

    // wp_enqueue_script(
    //     'dropdown',
    //     get_template_directory_uri() . '/js/dropdown.js',
    //     ['vue'],
    //     '0.1.0',
    //     true
    // );

    // wp_enqueue_script(
    //     'slider2',
    //     get_template_directory_uri() . '/js/slider2.js',
    //     ['vue'],
    //     '0.1.0',
    //     true
    // );

    // wp_enqueue_script(
    //     'tabs',
    //     get_template_directory_uri() . '/js/tabs.js',
    //     ['vue'],
    //     '0.1.0',
    //     true
    // );

}

add_action('wp_enqueue_scripts', 'essential_scripts');

add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
    if ( 20 === $item->ID || 21 === $item->ID ) { // change 1161 to the ID of your menu item.
        $atts['@click'] = 'makeVisible';
    }

    return $atts;
}, 10, 3 );

function add_to_my_recipes(WP_REST_Request $request_data) {
    $recipe_id = $request_data['recipeId'];
    $recipe_name = $request_data['recipeName'];
    $recipe_link = $request_data['recipeLink'];
    $recipe_description = $request_data['recipeDescription'];
    $recipe_type = $request_data['recipeType'];
    $recipe_img = $request_data['recipeImg'];    
    global $wpdb;
    $table_name = $wpdb->prefix . "myrecipes";
    $wpdb->insert($table_name, array('recipe_id' => $recipe_id, 'recipe_name' => $recipe_name, 'recipe_link' => $recipe_link, 
    'recipe_description' => $recipe_description, 'recipe_type' => $recipe_type, 'recipe_img' => $recipe_img ) );
}

function create_route() {
    register_rest_route( 'vuewithbundler/v1', '/myrecipes', array(
      'methods' => 'POST',
      'callback' => 'add_to_my_recipes',
    ) );
}

function get_my_recipes() {
    global $wpdb;
    $wpdb->get_results(" SELECT * FROM " . $wpdb->prefix . "myrecipes");
    return $wpdb->num_rows;
}

function get_my_recipes_route() {
    register_rest_route( 'vuewithbundler/v1', '/myrecipesare', array(
      'methods' => 'GET',
      'callback' => 'get_my_recipes',
    ) );
}

function get_my_food_recipes() {
    global $wpdb;
    $myrecipes = $wpdb->get_results(" SELECT * FROM " . $wpdb->prefix . "myrecipes");
    return $myrecipes;
}

function get_my_food_recipes_route() {
    register_rest_route( 'vuewithbundler/v1', '/allmyrecipes', array(
      'methods' => 'GET',
      'callback' => 'get_my_food_recipes',
    ) );
}

function delete_my_recipes() {

}

add_action( 'rest_api_init',  'create_route');
add_action( 'rest_api_init',  'get_my_recipes_route');
add_action( 'rest_api_init',  'get_my_food_recipes_route');

?>