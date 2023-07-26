<?php

add_action('cmb2_admin_init', 'gpx_documento_cmb');

function gpx_documento_cmb()
{
    $cmb = new_cmb2_box(array(
        'id'            => 'gpx_documento_metabox',
        'title'         => esc_html__('Opções', 'svt'),
        'object_types'  => array('documento'), // Post type
    ));

    // $cmb->add_field(array(
    //     'name'    => esc_html__('Descrição', 'svt'),
    //     'id'      => 'gpx_documento_desc',
    //     'type'    => 'textarea',
    // ));

    $cmb->add_field(array(
        'name'    => esc_html__('Arquivo para download', 'svt'),
        'id'      => 'gpx_documento_url',
        'type' => 'file',
        'query_args' => array(
            'type' => array(
                'application/pdf',
                'application/zip',
                'application/octet-stream',
                'application/x-zip-compressed',
                'multipart/x-zip',
                'image/gif',
                'image/jpeg',
                'image/png'
            )
        )
    ));
}
