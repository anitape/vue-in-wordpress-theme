<!-- FOOTER -->
<footer class="footer-margins">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 d-flex flex-column align-items-center">
                <ul class="d-flex flex-row footer-some">
                    <li><a href="mailto:#"><i class="fa fa-envelope-o fa-2x"></i></a></li>
                    <li><a href="tel:#"><i class="fa fa-phone fa-2x"></i></a></li>                    
                    <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></li>
                    <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram fa-2x"></i></a></li>
                </ul>
                <div class="d-flex flex-row footer-menu">
                    <?php wp_nav_menu(array('container' => 'nav', 'theme_location' => 'primary', 'menu_class' => 'footer-nav'));?>
                </div>
                <div class="copyright-text">
                    <p>Copyright &copy; 2022 Aliette. Food blog</p>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>

</html>