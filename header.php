<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=Montserrat:wght@600&family=Oleo+Script:wght@700&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body>

    <!-- MENU -->
    <div class="header-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm header-some">
                    <ul class="some justify-content-end">
                        <li><a href="tel:#"><i class="fa fa-phone"></i></a></li>
                        <li><a href="mailto:#"><i class="fa fa-envelope"></i></a></li>
                        <li><a href="https://www.facebook.com/" target="_blank"><i
                                    class="fa fa-facebook-square"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm header-title text-center">
                    <!-- lOGO TEXT HERE -->
                    <h1>Aliette.</h1>
                    <h2 class="secondary">A food blog with tasty recipes</h6>
                </div>
            </div>

            <!-- MENU LINKS -->
            <div class="row">
                <div class="col-sm">
                    <?php wp_nav_menu(array('container' => 'nav', 'theme_location' => 'primary', 'menu_class' => 'nav justify-content-center'));?>
                    <div id="app">
                        <add-myrecipes v-slot="{ numofRecipes }">
                            <div>
                               <a class="link-no-decor" href="http://localhost/vuewordpress/myrecipes"><span>MY RECIPES {{ numofRecipes }}</span></a>
                            </div>
                        </add-myrecipes>
                    </div>
                </div>
            </div>
        </div>
    </div>