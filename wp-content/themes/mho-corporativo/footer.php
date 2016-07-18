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
                        foreach ($contactos as $contacto) { ?>
                            <h2>Dirección <?php echo $contacto['pais']; ?></h2>
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
                        <?php } ?>
                    </div>
                </div><!-- fin address-zone -->
            </div>
        </div><!-- fin container-footer -->
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>