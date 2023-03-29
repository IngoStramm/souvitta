<?php

add_action('init', 'gpx_documento_cpt', 1);

function gpx_documento_cpt()
{
    $documento = new SVT_Post_Type(
        __('Documento', 'svt'), // Nome (Singular) do Post Type.
        'documento' // Slug do Post Type.
    );

    $documento->set_labels(
        array(
            'menu_name' => __('Documentos da Área Restrita', 'svt'),
            'singular_name' => __('Documento', 'svt'),
            'view_item' => __('Ver Documentos', 'svt'),
            'edit_item' => __('Editar Documentos', 'svt'),
            'search_items' => __('Pesquisar Documentos', 'svt'),
            'update_item' => __('Atualizar Documentos', 'svt'),
            'parent_item_colon' => __('Documento Pai', 'svt'),
            'add_new' => __('Adicionar Novo', 'svt'),
            'add_new_item' => __('Adicionar novo Documento', 'svt'),
            'new_item' => __('Novo', 'svt'),
            'all_items' => __('Todos Documentos', 'svt'),
            'not_found' => __('Nenhum Documento encontrado', 'svt'),
            'not_found_in_trash' => __('Nenhum Documento encontrado na lixeira', 'svt'),
        )
    );

    $documento->set_arguments(
        array(
            'public' => true,
            'show_in_nav_menus' => true,
            'has_archive' => true,
            'supports' => array('title'),
        )
    );
}
