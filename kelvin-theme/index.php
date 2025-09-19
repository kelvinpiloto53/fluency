<?php get_header(); ?>

<div class="container">
    <main id="main" class="site-main">
        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                    </header>

                    <div class="entry-content">
                        <?php the_content( 'Leia mais...' ); ?>
                    </div>
                </article>

            <?php endwhile; ?>

            <?php the_posts_pagination(); // Adiciona paginação se houver muitos posts. ?>

        <?php else : ?>

            <p>Nenhum post foi encontrado.</p>

        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>
