<?php
/**
 * Plugin Name:       Simple Form Builder aas
 * Plugin URI:        https://wordpress.org/plugins/simple-form-builder-aas/
 * Description:       Simple Form Builder Will Help You To Build Your Custome Form Easily.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Amran Ali Saurab
 * Author URI:        
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        
 * Text Domain:       aas
 */


  // Including CSS
//   function aas_enqueue_style(){
//     wp_enqueue_style('aas-style', plugins_url('css/sstt-style.css', __FILE__));
//   }
//   add_action( "wp_enqueue_scripts", "sstt_enqueue_style" );

  // Including JavaScript
  function aas_enqueue_scripts(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('aas-plugin-ui-script', plugins_url('js/saa-jqui.js', __FILE__), array(), '1.0.0', 'true');
    wp_enqueue_script('aas-plugin-frormbuilder-script', plugins_url('js/saa-formbuilder.js', __FILE__), array(), '1.0.0', 'true');

  }
  add_action( "wp_enqueue_scripts", "aas_enqueue_scripts" );

  // jQuery Plugin Setting Activation
  function aas_scroll_script(){?>
        <script>
            jQuery(document).ready(function () {
                //jQuery.scrollUp();
                jQuery(function($){
                        $(document.getElementById('myformbuilder')).formBuilder();
                    });
            });
        </script>

<?php }
add_action( "wp_footer", "aas_scroll_script" );



// writing back php for working with ui
?>
    <div id="myformbuilder"></div>
<?php




 ?>