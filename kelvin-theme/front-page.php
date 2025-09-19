<?php
/**
 * Template para a página inicial estática.
 *
 * @package Kelvin_Theme
 */

get_header();
?>

<main id="main" class="site-main">

    <?php
    // Carrega a seção Hero
    get_template_part('template-parts/section', 'hero');

    // Carrega a seção de Diferenciais (placeholder)
    get_template_part('template-parts/section', 'diferenciais');

    // Carrega a seção de Cursos (placeholder)
    get_template_part('template-parts/section', 'cursos');

    // Carrega a seção de Depoimentos (placeholder)
    get_template_part('template-parts/section', 'depoimentos');
    ?>

</main>

<?php
get_footer();
