<?php   



if (!defined('ABSPATH')) {
    exit; 
}


add_action('rocket_settings_tools_content', 'custom_rocket_tool_option');
function custom_rocket_tool_option() {
    ?>
    <div class="wpr-tools">
        <style>.wpr-tools-col:last-child{text-align:left;} #check_interval, #modified_interval{width:40px;} .wpr-fields label{font-weight: 400; font-size: 14px; color: #585858;}</style>
        <div class="wpr-tools-col wpr-radio">
            <div class="wpr-title3 wpr-tools-label">
                <input id="clear_recent_cache" name="clear_recent_cache" value="1" type="checkbox" <?php checked(1, get_option('clear_recent_cache', 0)); ?>>
                <label for="clear_recent_cache">
                    <span data-l10n-active="On" data-l10n-inactive="Off" class="wpr-radio-ui"></span>
                    <?php esc_html_e('Vider le cache des pages après modification', 'rocket'); ?>
                </label>
            </div>
            
            <div class="wpr-fields">
                 <label>Vérifier toutes les</label><input type="number" id="check_interval" name="check_interval" value="<?php echo esc_attr(get_option('check_interval', 3)); ?>" min="1"> 
                
                <label for="modified_interval"><?php esc_html_e('minutes si une page a été modifiée ces', 'rocket'); ?></label>
                <input type="number" id="modified_interval" name="modified_interval" value="<?php echo esc_attr(get_option('modified_interval', 5)); ?>" min="1">
					<label>dernières minutes et vide le cache de la publication.</label>
            </div>
            <button id="save_custom_option" class="wpr-button"><?php esc_html_e('Enregistrer', 'rocket'); ?></button>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#save_custom_option').on('click', function(e) {
                e.preventDefault();
                var clear_recent_cache = $('#clear_recent_cache').is(':checked') ? 1 : 0;
                var check_interval = $('#check_interval').val();
                var modified_interval = $('#modified_interval').val();

                $.post(ajaxurl, {
                    action: 'save_custom_rocket_option',
                    clear_recent_cache: clear_recent_cache,
                    check_interval: check_interval,
                    modified_interval: modified_interval,
                    _ajax_nonce: '<?php echo wp_create_nonce("save_custom_rocket_option_nonce"); ?>'
                }, function(response) {
                    alert(response.data);
                });
            });
        });
    </script>
    <?php
}