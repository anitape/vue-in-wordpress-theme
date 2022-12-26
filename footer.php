<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row footer-margin">

            <div class="col-md-5 col-sm-12">
                <div class="footer-thumb footer-info">
                    <h6>WP Solutions</h6>
                    <p>WP Solutions on keittiöremontteihin erikoistunut remonttiyritys, joka toimii pääkaupunkiseudulla.
                    </p>
                </div>
            </div>

            <div class="col-md-2 col-sm-4">
                <div class="footer-thumb">
                    <h6>Menu</h6>
                    <?php wp_nav_menu(array('container' => 'nav', 'theme_location' => 'primary', 'menu_class' => 'footer-nav'));?>
                </div>
            </div>

            <div class="col-md-2 col-sm-4">
                <div class="footer-thumb">
                    <h6>Palvelut</h6>
                    <ul class="footer-link">
                        <li><a href="/~anitape/oma_wpsivu/palvelut/#keittioasennukset">Keittiöasennukset</a></li>
                        <li><a href="/~anitape/oma_wpsivu/palvelut/#laatoitus">Laatoitus</a></li>
                        <li><a href="/~anitape/oma_wpsivu/palvelut/#lattioiden-asennus">Lattioiden asennus</a></li>
                        <li><a href="/~anitape/oma_wpsivu/palvelut/#pohja-tasoite-ja-pintatyot">Pohja-, Tasoite- Ja
                                Pintatyöt</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-4">
                <div class="footer-thumb">
                    <h6>Yhteystiedot</h6>
                    <p>Mannerheimintie 10, 00100 Helsinki <br> wpsolutions@gmail.com</p>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="footer-bottom">
                    <div class="col-md-6 col-sm-5">
                        <div class="copyright-text">
                            <p>Copyright &copy; 2022 WP Solutions</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <div class="phone-contact">
                            <p>Soita <span>(+358) 040 123 45 67</span></p>
                        </div>
                        <ul class="social-icon">
                            <li><a href="tel:#"><i class="fa fa-phone"></i></a></li>
                            <li><a href="mailto:#"><i class="fa fa-envelope"></i></a></li>
                            <li><a href="https://www.facebook.com/" target="_blank"><i
                                        class="fa fa-facebook-square"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>
</body>

</html>