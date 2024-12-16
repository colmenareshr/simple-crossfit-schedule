<?php
function scs_register_post_types() {
    $labels = array(
        'name'               => 'Clases CrossFit',
        'singular_name'      => 'Clase CrossFit',
        'menu_name'          => 'Clases CrossFit',
        'add_new'            => 'Añadir Nueva',
        'add_new_item'       => 'Añadir Nueva Clase',
        'edit_item'          => 'Editar Clase',
        'new_item'           => 'Nueva Clase',
        'view_item'          => 'Ver Clase',
        'search_items'       => 'Buscar Clases',
        'not_found'          => 'No se encontraron clases',
        'not_found_in_trash' => 'No se encontraron clases en la papelera',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'crossfit-class'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('crossfit_class', $args);
}
add_action('init', 'scs_register_post_types');