<?php

/**
 * Documento Archive Template.
 */

get_header();
?>

<!-- #Content -->
<div id="Content">
    <div class="content_wrapper clearfix">

        <!-- .sections_group -->
        <div class="sections_group">

            <div class="section">
                <div class="section_wrapper clearfix">

                    <div class="column one column_blog">
                        <div class="blog_wrapper isotope_wrapper">

                            <div class="posts_group lm_wrapper classic col-3">
                                <?php

                                // Loop attributes
                                $attr = array(
                                    'featured_image'     => false,
                                    'filters'                 => $filters,
                                );

                                if ($load_more) {
                                    $attr['featured_image'] = 'no_slider';    // no slider if load more
                                }
                                if (mfn_opts_get('blog-images')) {
                                    $attr['featured_image'] = 'image';    // images only option
                                }
                                //gpx_debug('teste');
                                // echo mfn_content_post(false, false, $attr);


                                if (have_posts()) {
                                    while (have_posts()) {
                                        the_post();
                                        $post_id = get_the_ID(); ?>
                                        <div class="posts_group lm_wrapper documento classic col-3">
                                            <div class="post-item isotope-item clearfix no-image hentry post no-img">
                                                <div class="post-desc-wrapper">
                                                    <div class="post-desc">
                                                        <div class="post-title">
                                                            <h2 class="entry-title documento-titulo" itemprop="headline">

                                                                <?php echo get_the_title(); ?>

                                                                <?php $gpx_documento_url = get_post_meta($post_id, 'gpx_documento_url', true);
                                                                if ($gpx_documento_url) { ?>

                                                                    <ul class="documento-actions clearfix">

                                                                        <li class="documento-action">
                                                                            <a href="<?php echo $gpx_documento_url; ?>" download="<?php echo get_the_title(); ?>.pdf"><i class="icon-download fa"></i></a>
                                                                        </li>

                                                                        <li class="documento-action">
                                                                            <a href="<?php echo $gpx_documento_url; ?>" target="_blank"><i class="icon-eye fa"></i></a>
                                                                        </li>

                                                                    </ul>
                                                                    <!-- /.documento-actions -->

                                                                <?php } ?>

                                                            </h2><!-- /.entry-title -->
                                                        </div>
                                                        <!-- /.post-title -->

                                                        <?php $gpx_documento_desc = get_post_meta($post_id, 'gpx_documento_desc', true);
                                                        if ($gpx_documento_desc) { ?>

                                                            <div class="post-excerpt documento-descricao">
                                                                <?php echo $gpx_documento_desc; ?>
                                                            </div>
                                                            <!-- /.post-excerpt -->

                                                        <?php } ?>

                                                    </div>
                                                    <!-- /.post-desc -->
                                                </div>
                                                <!-- /.post-desc-wrapper -->
                                            </div>
                                            <!-- /.post-item isotope-item clearfix no-image hentry -->
                                        </div>
                                        <!-- /.posts_group lm_wrapper classic col-3 -->
                                <?php }
                                }
                                ?>
                            </div>

                            <?php
                            // pagination
                            if (function_exists('mfn_pagination')) :

                                echo mfn_pagination(false, false);

                            else :
                            ?>
                                <div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'betheme')) ?></div>
                                <div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'betheme')) ?></div>
                            <?php
                            endif;
                            ?>

                        </div>
                    </div>

                </div>
            </div>


        </div>

        <!-- .four-columns - sidebar -->
        <div class="sidebar sidebar-1 four columns">
            <div class="widget-area clearfix">
                <?php $categorias_documentos = wp_list_categories(array(
                    'current_category'  => get_queried_object_id(),
                    'taxonomy'          => 'categoria-documento',
                    'show_option_all'   => __('Todos Documentos', 'svt'),
                    'echo'              => false,
                    'hide_empty'        => true,
                    'title_li'          => ''
                )); ?>
                <?php
                // $terms = get_terms(array(
                //     'taxonomy'              => 'categoria-documento',
                //     'hide_empty'            => true,
                // ));
                // gpx_debug($terms);
                ?>
                <aside id="categorias-documento" class="widget widget_categories categorias-documento-widget">
                    <?php /* ?><h3><?php _e('Categorias', 'svt'); ?></h3><?php */ ?>

                    <ul class="svt-toggle-list">
                        <?php echo $categorias_documentos; ?>
                    </ul>

                    <?php /* ?>

                        <ul>

                            <?php
                            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
                            $curr_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            $css_current_cat_class = 'current-cat';
                            $documento_url = get_post_type_archive_link('documento');
                            ?>

                            <li class="cat-item cat-item-1 <?php if (is_post_type_archive('documento')) echo $css_current_cat_class; ?>"><a href="<?php echo get_post_type_archive_link('documento'); ?>"><?php _e('Todos Documentos', 'svt'); ?></a>
                            </li>

                            <?php $count = 2; ?>
                            <?php foreach ($terms as $term) { ?>
                                <?php // gpx_debug($term->parent); 
                                ?>
                                <?php $active_class = get_queried_object_id() == $term->term_id ? $css_current_cat_class : null; ?>
                                <li class="cat-item cat-item-<?php echo $count . ' ' . $active_class; ?>"><a href="<?php echo get_term_link($term->term_id); ?>"><?php echo $term->name; ?></a>
                                </li>
                                <?php $count++; ?>
                            <?php } ?>
                        </ul>

                        <?php */ ?>

                </aside>

            </div>
        </div>

    </div>
</div>

<?php get_footer();

// Omit Closing PHP Tags
