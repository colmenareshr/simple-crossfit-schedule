<?php
function scs_add_meta_boxes() {
    add_meta_box(
        'scs_class_details',
        'Detalles de la Clase',
        'scs_class_details_callback',
        'crossfit_class',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'scs_add_meta_boxes');

function scs_class_details_callback($post) {
    wp_nonce_field(basename(__FILE__), 'scs_class_nonce');
    $start_time = get_post_meta($post->ID, '_scs_start_time', true);
    $end_time = get_post_meta($post->ID, '_scs_end_time', true);
    $days = get_post_meta($post->ID, '_scs_days', true);
    ?>
    <p>
        <label for="scs_start_time">Hora de inicio:</label>
        <input type="time" id="scs_start_time" name="scs_start_time" value="<?php echo esc_attr($start_time); ?>">
    </p>
    <p>
        <label for="scs_end_time">Hora de fin:</label>
        <input type="time" id="scs_end_time" name="scs_end_time" value="<?php echo esc_attr($end_time); ?>">
    </p>
    <p>
        <label>Días de la semana:</label><br>
        <?php
        $weekdays = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
        foreach ($weekdays as $day) {
            $checked = is_array($days) && in_array($day, $days) ? 'checked' : '';
            echo "<label><input type='checkbox' name='scs_days[]' value='$day' $checked> $day</label><br>";
        }
        ?>
    </p>
    <?php
}

function scs_save_meta_boxes($post_id) {
    if (!isset($_POST['scs_class_nonce']) || !wp_verify_nonce($_POST['scs_class_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if ('crossfit_class' != $_POST['post_type']) {
        return $post_id;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    $start_time = isset($_POST['scs_start_time']) ? sanitize_text_field($_POST['scs_start_time']) : '';
    $end_time = isset($_POST['scs_end_time']) ? sanitize_text_field($_POST['scs_end_time']) : '';
    $days = isset($_POST['scs_days']) ? array_map('sanitize_text_field', $_POST['scs_days']) : array();

    update_post_meta($post_id, '_scs_start_time', $start_time);
    update_post_meta($post_id, '_scs_end_time', $end_time);
    update_post_meta($post_id, '_scs_days', $days);
}
add_action('save_post', 'scs_save_meta_boxes');