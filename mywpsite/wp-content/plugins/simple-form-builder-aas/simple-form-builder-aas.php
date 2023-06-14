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
  function aas_enqueue_style(){
    wp_enqueue_style('aas-bootstrap-style', plugins_url('css/bootstrap.css', __FILE__));
    wp_enqueue_style('aas-custom-style', plugins_url('css/custom.css', __FILE__));
  }
  add_action( "admin_enqueue_scripts", "aas_enqueue_style" );

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

    wp_localize_script( 'jquery', 'my_ajax_vars', array(
      'ajaxurl'       => admin_url( 'admin-ajax.php' )
    ));

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
//   if ( isset( $_POST['submit'] ) ){
                                            
//     global $wpdb;


//     $tablename=$wpdb->prefix.'posts';

//     $data=array(
//         'post_content' => '123'
//       );


//     $wpdb->insert( $tablename, $data);
// }

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

                                          const renderData = $.parseJSON(result); // making  fromdata array of string
                                           const formData = JSON.stringify(renderData);
                                          $(fbRender).formRender({ formData });

                                          
                                          var rawdata = formData;   // using ajax to send data into wordpress database
                                                    $.ajax({
                                                      type: 'POST', 
                                                      url: ajaxurl,
                                                      data: {
                                                        'action': 'favourit_data',
                                                        't_data':rawdata,
                                                      },
                                                      success: function (data) {
                                                      alert('success');
                                                      
                                                      },
                                                      error: function () {
                                                      alert('fail');
                                                      }
                                                    });


                                        });

                                        document.getElementById("saveFrmTitle").addEventListener("click", () => {
                                          var frmTitleValue = $("#frm_title").val();
                                                    $.ajax({
                                                      type: 'POST', 
                                                      url: ajaxurl,
                                                      data: {
                                                        'action': 'frm_title_data',
                                                        't_data':frmTitleValue,
                                                      },
                                                      success: function (data) {
                                                      alert('success');
                                                      
                                                      },
                                                      error: function () {
                                                      alert('fail');
                                                      }
                                                    });


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
        
        <br/>

    <div class="form-group">
      <div class= "col-md-8">
      <label class="control-level">Form Title </lebel>
        <input class= "form-group" type="text" name="frm_title" id="frm_title" value=""/>
      </div>
      <div class= "col-md-4">
          <button class="btn btn-primary" id="saveFrmTitle" type="button">Save Form Title</button>
      </div>
    </div>

    <br/>
    <div id="build-wrap"></div>

    <div class="row">
      <div class= "col-md-4"></div>
      <div class= "col-md-8">
          <button id="saveData" type="button">External Save Button</button>
      </div>
    </div>

          </br>
          <h4> save console data to database and retrive it and show the real form like below</h4>

    <form id="fb-render"></form>

<?php

    
}

 add_action("admin_menu","saa_custom_menu");


 function my_favourit_car(){  // data save into wordpress Db

    if(isset($_REQUEST)){
      $my_data = $_REQUEST['t_data'];
      $current_Date = date("Y-m-d H:i:s");
      
      global $wpdb;
      $wpdb->insert(
          //$wpdb->prefix.'posts',
          $wpdb->prefix.'postmeta',
          [
            'meta_value'=> $my_data,
            'post_id'=> '84',
            
          ]
      );
  
    }
}
 add_action('wp_ajax_favourit_data','my_favourit_car');


 
 function my_form_title(){  // data save into wordpress Db

  if(isset($_REQUEST)){
    $my_data = $_REQUEST['t_data'];
    $current_Date = date("Y-m-d H:i:s");
    
    global $wpdb;
    $wpdb->insert(
        $wpdb->prefix.'posts',
        [
          'post_content'=> $my_data,
          'post_date'=> $current_Date,
          'post_date_gmt' => $current_Date,
        ]
    );

  }
}
add_action('wp_ajax_frm_title_data','my_form_title');

 

