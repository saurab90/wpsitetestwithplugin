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

    wp_enqueue_script('aas-plugin-frormrender-script', plugins_url('js/saa-formrender.js', __FILE__), array(), '1.0.0', 'true');

  }
  add_action( "wp_enqueue_scripts", "aas_enqueue_scripts" );

  function aas_enqueue_admin_scripts(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('aas-plugin-ui-script', plugins_url('js/saa-jqui.js', __FILE__), array(), '1.0.0', 'true');
    wp_enqueue_script('aas-plugin-frormbuilder-script', plugins_url('js/saa-formbuilder.js', __FILE__), array(), '1.0.0', 'true');

    wp_enqueue_script('aas-plugin-frormrender-script', plugins_url('js/saa-formrender.js', __FILE__), array(), '1.0.0', 'true');

  }
  add_action( "admin_enqueue_scripts", "aas_enqueue_admin_scripts" );
  // jQuery Plugin Setting Activation
  
  /*
  function aas_scroll_script(){?>
        <script>
            jQuery(document).ready(function () {
                jQuery(function($){
                        $(document.getElementById('myformbuilder')).formBuilder();
                    });
            });
        </script>

<?php }

// add_action( "wp_footer", "aas_scroll_script" );
*/



/*
?>
    <div id="myformbuilder"></div>
<?php
*/

function saa_custom_menu(){
    add_menu_page("saa list","Dummy test","manage_options","saa-list","call_back_fn");
    
}

function call_back_fn(){
?>
        <script>
            jQuery(document).ready(function () {
                jQuery(function($){
                        jQuery(($) => {
                                        const fbEditor = document.getElementById("build-wrap"); // for building form 
                                        const formBuilder = $(fbEditor).formBuilder();

                                        const fbRender = document.getElementById("fb-render");  // for rendering the form elements

                                        document.getElementById("saveData").addEventListener("click", () => {
                                        console.log("external save clicked");
                                          const result = formBuilder.actions.save();
                                          //console.log("result:", result);
                                          console.log(result);

                                          const renderData = $.parseJSON(result); // making array from string data
                                          var formData = JSON.stringify(renderData);
                                          $(fbRender).formRender({ formData });

                                        });

                                      });

                            // Form render part
                            // const getUserDataBtn = document.getElementById("get-user-data");
                            // const fbRender = document.getElementById("fb-render");
                            //  const originalFormData = [{"type":"text","required":false,"label":"Text Field","className":"form-control","name":"text-1686113504036","access":false,"value":"amran","subtype":"text"},{"type":"number","required":false,"label":"Number","className":"form-control","name":"number-1686113509221","access":false,"value":"1234"},{"type":"header","subtype":"h1","label":"Header","access":false}];

                            // //var originalFormData = [data];

                            // jQuery(function($) {
                            //   var formData = JSON.stringify(originalFormData);
                            //   //var formData = JSON.stringify(mdata);

                            //   $(fbRender).formRender({ formData });
                            //   getUserDataBtn.addEventListener(
                            //     "click",
                            //     () => {
                            //       window.alert(window.JSON.stringify($(fbRender).formRender("userData")));
                            //     },
                            //     false
                            //   );
                            // });
                    });
            });
        </script>

    <div class="saveDataWrap">
      <button id="saveData" type="button">External Save Button</button>
    </div>

    <div id="build-wrap"></div>
          </br>
          <h4> save console data to database and retrive it and show the real form like below</h4>
    <form id="fb-render"></form>

    <button type="button" id="get-user-data">Get Updated formData</button>

<?php

    //echo "hi... its working fine";

    //$location = get_post_meta( $post->ID, 'omb_location', true );  // get post omb_location data from wordpress db and 'true' for single value field or it's consider as array default.
	//$country  = get_post_meta( $post->ID, 'omb_country', true );   // get post omb_country data from wordpress db and 'true' for single value field or it's consider as array default.

    //$label1   = __( 'Location', 'our-metabox' );
    //$label2   = __( 'Country', 'our-metabox' );

    // $metabox_html = <<<EOD
    //                     <p>
    //                     <label for="omb_location">{$label1}: </label>
    //                     <input type="text" name="omb_location" id="omb_location" value=""/>
    //                     <br/>
    //                     <label for="omb_country">{$label2}: </label>
    //                     <input type="text" name="omb_country" id="omb_country" value=""/>
    //                     </p>
    //                 EOD;

    // echo $metabox_html;

    
}

 add_action("admin_menu","saa_custom_menu");


 ?>