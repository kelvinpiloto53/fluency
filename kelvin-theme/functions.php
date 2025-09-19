<?php
/**
 * Funções do Kelvin Theme.
 *
 * @package Kelvin_Theme
 */

// setup básico do tema
function kelvin_theme_setup() {
	// deixa o wp cuidar do <title>
	add_theme_support( 'title-tag' );

	// habilitar thumbnails
	add_theme_support( 'post-thumbnails' );
    
    // suportar logo customizado
    add_theme_support( 'custom-logo', array(
        'height'      => 40,
        'width'       => 150,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

	// registrar o menu principal
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Menu Principal', 'kelvin-theme' ),
		)
	);
}
add_action( 'after_setup_theme', 'kelvin_theme_setup' );


// carregar css e js
function kelvin_theme_scripts() {
    // Carregar Google Fonts (IBM Plex Sans)
    wp_enqueue_style( 'kelvin-theme-fonts', 'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&display=swap', array(), null );
}
add_action( 'wp_enqueue_scripts', 'kelvin_theme_scripts' );

// INJEÇÃO DE CSS INLINE PARA DRIBLAR CACHE AGRESSIVO
// =============================================================================
// Essa é a solução definitiva para o problema de cache.
// Ele lê o arquivo CSS e o coloca diretamente no <head> da página.
function kelvin_theme_inline_styles() {
    $css_path = get_template_directory() . '/assets/stylesheet.css';
    if ( file_exists( $css_path ) ) {
        $css_content = file_get_contents( $css_path );
        echo '<style type="text/css">' . $css_content . '</style>';
    }
}
add_action( 'wp_head', 'kelvin_theme_inline_styles', 999 );


// Registrar áreas de widgets para o rodapé
function kelvin_theme_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Rodapé - Coluna 1', 'kelvin-theme' ),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Rodapé - Coluna 2', 'kelvin-theme' ),
        'id'            => 'footer-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Rodapé - Coluna 3', 'kelvin-theme' ),
        'id'            => 'footer-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Rodapé - Coluna 4 (Social)', 'kelvin-theme' ),
        'id'            => 'footer-4',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'kelvin_theme_widgets_init' );

// Otimizações de performance
// =============================================================================

// 1. limpar o head, tirar tranqueira do wp
function kelvin_theme_remove_head_clutter() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('template_redirect', 'rest_output_link_header', 11, 0);
}
add_action('init', 'kelvin_theme_remove_head_clutter');

// 2. desabilitar emojis, ninguém usa isso
function kelvin_theme_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'kelvin_theme_disable_emojis' );

// 3. desabilitar embeds
function kelvin_theme_disable_embeds(){
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}
add_action( 'init', 'kelvin_theme_disable_embeds', 9999);

// 4. remover ?ver= de css/js, ajuda no cache
function kelvin_theme_remove_query_strings( $src ) {
	if ( strpos( $src, '?ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'kelvin_theme_remove_query_strings', 10, 2 );
add_filter( 'script_loader_src', 'kelvin_theme_remove_query_strings', 10, 2 );

// 5. desabilitar xmlrpc (segurança)
add_filter( 'xmlrpc_enabled', '__return_false' );

// 6. defer pra scripts, pra carregar mais rápido
function kelvin_theme_defer_scripts( $tag, $handle, $src ) {
    // nao fazer isso no admin
    if ( is_admin() ) {
        return $tag;
    }
    // scripts pra aplicar o defer
    $defer_scripts = [
        // 'kelvin-theme-main'
    ];
    if ( in_array( $handle, $defer_scripts ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'kelvin_theme_defer_scripts', 10, 3 );

