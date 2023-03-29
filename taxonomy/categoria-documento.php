<?php

add_action('init', 'gpx_arquivo_taxonomy', 1);

function gpx_arquivo_taxonomy()
{
    $categoria = new SVT_Taxonomy(
        __('Categoria de Documento', 'svt'), // Nome (Singular) da nova Taxonomia.
        'categoria-documento', // Slug do Taxonomia.
        'documento' // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
    );

    $categoria->set_labels(
        array(
            'singular_name' => __('Categoria de Documento', 'svt'),
            'add_or_remove_items' => __('Adicionar ou remover Categorias', 'svt'),
            'view_item' => __('Ver Categoria', 'svt'),
            'edit_item' => __('Editar Categoria', 'svt'),
            'search_items' => __('Pesquisar Categorias', 'svt'),
            'update_item' => __('Atualizar Categoria', 'svt'),
            'parent_item' => __('Categoria Pai', 'svt'),
            'parent_item_colon' => __('Categoria Pai', 'svt'),
            'menu_name' => __('Categorias de Documento', 'svt'),
            'add_new_item' => __('Adicionar Nova', 'svt'),
            'new_item_name' => __('Nova Categoria', 'svt'),
            'all_items' => __('Todas Categorias', 'svt'),
            'separate_items_with_commas' => __('Separar Categorias por vírgula', 'svt'),
            'choose_from_most_used' => __('Escolher Categorias mais usadas', 'svt'),
        )
    );

    $categoria->set_arguments(
        array(
            'hierarchical' => true
        )
    );
}