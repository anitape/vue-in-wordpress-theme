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


/* CREATE, READ and DELETE operations*/

/* My Recipes */

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

function add_to_my_recipes_route() {
    register_rest_route( 'vuewithbundler/v1', '/myrecipes', array(
      'methods' => 'POST',
      'callback' => 'add_to_my_recipes',
    ) );
}

function get_my_recipes_num() {
    global $wpdb;
    $wpdb->get_results(" SELECT * FROM " . $wpdb->prefix . "myrecipes");
    return $wpdb->num_rows;
}

function get_my_recipes_num_route() {
    register_rest_route( 'vuewithbundler/v1', '/myrecipesare', array(
      'methods' => 'GET',
      'callback' => 'get_my_recipes_num',
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

function delete_my_recipe(WP_REST_Request $request_data) {
    global $wpdb;
    $id = $request_data['recipeId'];
    $table_name = $wpdb->prefix . "myrecipes";
    $wpdb->delete($table_name, ['recipe_id' => $id]);
    //$wpdb->get_results(" DELETE FROM "  . $wpdb->prefix . " WHERE `wp_myrecipes`.`recipe_id` = " . $id);
    echo "Id is " . $id;
}

function delete_my_recipe_route() {
    register_rest_route( 'vuewithbundler/v1', '/myrecipe', array(
      'methods' => 'POST',
      'callback' => 'delete_my_recipe',
    ) );
}

add_action( 'rest_api_init',  'add_to_my_recipes_route');
add_action( 'rest_api_init',  'get_my_recipes_num_route');
add_action( 'rest_api_init',  'get_my_food_recipes_route');
add_action( 'rest_api_init',  'delete_my_recipe_route');

/* My Drinks */
function add_to_my_drinks(WP_REST_Request $request_data) {
    $drink_id = $request_data['drinkId'];
    $drink_name = $request_data['drinkName'];
    $drink_link = $request_data['drinkLink'];
    $drink_description = $request_data['drinkDescription'];
    $drink_img = $request_data['drinkImg'];    
    global $wpdb;
    $table_name = $wpdb->prefix . "mydrinks";
    $wpdb->insert($table_name, array('drink_id' => $drink_id, 'drink_name' => $drink_name, 'drink_link' => $drink_link, 
    'drink_description' => $drink_description, 'drink_img' => $drink_img ) );
}

function add_to_my_drinks_route() {
    register_rest_route( 'vuewithbundler/v1', '/mydrinks', array(
      'methods' => 'POST',
      'callback' => 'add_to_my_drinks',
    ) );
}

function get_my_drinks_num() {
    global $wpdb;
    $wpdb->get_results(" SELECT * FROM " . $wpdb->prefix . "mydrinks");
    return $wpdb->num_rows;
}

function get_my_drinks_num_route() {
    register_rest_route( 'vuewithbundler/v1', '/mydrinksare', array(
      'methods' => 'GET',
      'callback' => 'get_my_drinks_num',
    ) );
}

function get_my_drink_recipes() {
    global $wpdb;
    $mydrinks = $wpdb->get_results(" SELECT * FROM " . $wpdb->prefix . "mydrinks");
    return $mydrinks;
}

function get_my_drink_recipes_route() {
    register_rest_route( 'vuewithbundler/v1', '/alldrinks', array(
      'methods' => 'GET',
      'callback' => 'get_my_drink_recipes',
    ) );
}

function delete_my_drink(WP_REST_Request $request_data) {
    global $wpdb;
    $id = $request_data['drinkId'];
    $table_name = $wpdb->prefix . "mydrinks";
    $wpdb->delete($table_name, ['drink_id' => $id]);
    //$wpdb->get_results(" DELETE FROM "  . $wpdb->prefix . " WHERE `wp_myrecipes`.`recipe_id` = " . $id);
    echo "Id is " . $id;
}

function delete_my_drink_route() {
    register_rest_route( 'vuewithbundler/v1', '/mydrink', array(
      'methods' => 'POST',
      'callback' => 'delete_my_drink',
    ) );
}

add_action( 'rest_api_init',  'add_to_my_drinks_route');
add_action( 'rest_api_init',  'get_my_drinks_num_route');
add_action( 'rest_api_init',  'get_my_drink_recipes_route');
add_action( 'rest_api_init',  'delete_my_drink_route');

function get_terms_by_custom_post_type( $post_type, $taxonomy ){
    $args = array( 'post_type' => $post_type);
    $loop = new WP_Query( $args );
    $postids = array();
    // build an array of post IDs
    while ( $loop->have_posts() ) : $loop->the_post();
      array_push($postids, get_the_ID());
    endwhile;
    // get taxonomy values based on array of IDs
    $regions = wp_get_object_terms( $postids,  $taxonomy );
    return $regions;
  }

function get_terms_by_post_ids($postids) {
    // get taxonomy values based on array of IDs
    $tags_by_id = wp_get_object_terms( $postids,  'post_tag' );
    return $tags_by_id;
  }

?>