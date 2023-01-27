<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link
        href="https://fonts.googleapis.com/css2?family=Katibeh&family=Lora:wght@600;700&family=Montserrat:wght@400;500;600;700&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body>

    <!-- MENU -->
    <div class="header-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <?php 
                        get_search_form(); 
                    ?>
                </div>
                <div class="col-md-6 align-items-center header-some">
                    <div id="app">
                        <handle-myrecipes v-slot="{ numofRecipes }">
                            <div>
                               <a class="link-no-decor" href="http://localhost/vuewordpress/myrecipes"><span class="upper-nav-headers">MY RECIPES {{ numofRecipes }}</span></a>
                            </div>
                        </handle-myrecipes>
                    </div>
                    <div class="upper-nav-headers">|</div>
                    <div id="app">
                        <handle-mydrinks v-slot="{ numofDrinks }">
                            <div>
                                <a class="link-no-decor" href="http://localhost/vuewordpress/mydrinks"><span class="upper-nav-headers">MY DRINKS {{ numofDrinks }}</span></a>                    
                            </div>
                        </handle-mydrinks>
                    </div>
                    <div class="upper-nav-headers">|</div>
                    <ul class="some justify-content-end" style="padding-left: 0";>
                        <li><a href="mailto:#"><i class="fa fa-envelope-o"></i></a></li>
                        <li><a href="tel:#"><i class="fa fa-phone"></i></a></li>                        
                        <li><a href="https://www.facebook.com/" target="_blank"><i
                                    class="fa fa-facebook"></i></a></li>
                        <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm header-title text-center">
                    <!-- lOGO TEXT HERE -->
                    <h1 class="mb-5 pb-2">Aliette.</h1>
                    <h2 class="secondary">A food blog with tasty recipes</h6>
                </div>
            </div>

            <!-- MENU LINKS -->
            <div class="row">
                <div class="col-sm">
                    <?php wp_nav_menu(array('container' => 'nav', 'theme_location' => 'primary', 'menu_class' => 'nav justify-content-center'));?>                    
                </div>
            </div>
        </div>
    </div>    