<?php
/**
 * Template para a seção Hero da página inicial.
 *
 * @package Kelvin_Theme
 */
?>

<section class="hero-section blur-in delay-4" style="background-image: url('<?php echo get_field('banner_site'); ?>');">
    <div class="container formsec">
        <div>
            <h1 class="hero-title animate fade-up delay-1">Curso online de inglês <br>em <span>São Paulo</span></h1>
        </div>
        <div id="form-um" class="formulario animate fade-left delay-4">
            <?php echo do_shortcode( '[wpforms id="5151" title="false"]' ); ?>
        </div>
    </div>
</section>
<section class="hero-products">
    <div class="container grid-lg-5 grid-sm-1">
       <div>
        <img src="https://modelos.99site.com.br/clientes/teste-fluency/wp-content/uploads/2025/09/Icon_desk.png"> 
        <h4>AULAS AO VIVO E <br>GRAVADAS</h4>
    </div>
    <div>
        <img src="https://modelos.99site.com.br/clientes/teste-fluency/wp-content/uploads/2025/09/Icon_clock.png"> 
        <h4>PLATAFORMA <br>INTERATIVA 24H</h4>
    </div>
    <div>
        <img src="https://modelos.99site.com.br/clientes/teste-fluency/wp-content/uploads/2025/09/Icon_file.png"> 
        <h4>PROFESSORES<BR> CERTIFICADOS</h4>
    </div>
    <div>
        <img src="https://modelos.99site.com.br/clientes/teste-fluency/wp-content/uploads/2025/09/Icon_blocks.png"> 
        <h4>MATERIAL DIDÁTICO<BR> DIGITAL INCLUSO</h4>
    </div>
    <div>
        <img src="https://modelos.99site.com.br/clientes/teste-fluency/wp-content/uploads/2025/09/Icon_people.png"> 
        <h4>SUPORTE PEDAGÓGICO<BR> E ORIENTAÇÃO</h4>
    </div>
</div>
</section>

