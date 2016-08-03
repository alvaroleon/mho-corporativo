<?php
$contactos = get_field('datos', 18);
?>
<footer>
    <div class="container">
        <div class="container-footer"><!-- container-footer -->
            <div class="six columns">
                <div class="contact-form"><!-- contact-form -->
                    <?php echo do_shortcode('[contact-form-7 id="29" title="Contacto"]'); ?>
                </div><!-- fin contact-form -->
            </div>

            <div class="six columns">
                <div class="address-zone"><!-- address-zone -->
                    <div class="box">
                        <?php
                        $pais_aux = '';
                        foreach ($contactos as $contacto) {
                            ?>
                            <h2><?php if ($pais_aux != $contacto['pais']): ?>Dirección <?php echo $contacto['pais']; ?><?php endif; ?></h2>

                            <p><?php echo $contacto['direccion']; ?></p>
                            <?php if ($contacto['email']): ?>
                                <p class="email">
                                    <a href="mailto:<?php echo $contacto['email']; ?>" title="Enviar email"><?php echo $contacto['email']; ?></a>
                                </p>
                            <?php endif; ?>
                            <?php if ($contacto['telefono']): ?>
                                <p class="fono">
                                    <a href="tel:<?php echo $contacto['telefono']; ?>" title="Llamar al teléfono"><?php echo $contacto['telefono']; ?></a>
                                </p>
                            <?php endif; ?>
                            <?php
                            $pais_aux = $contacto['pais'];
                        } ?>
                    </div>
                </div><!-- fin address-zone -->
            </div>
        </div><!-- fin container-footer -->
    </div>
</footer>
<?php wp_footer(); ?>
<?php if (is_page('contacto')) :?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1HhCzSEk-fObvREdU1Cr_SR3I5XOLHPg&callback=initializeMap"></script>
<?php endif; ?>
</body>
</html>