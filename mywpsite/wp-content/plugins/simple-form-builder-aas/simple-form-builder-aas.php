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
?>
        <script>
            jQuery(document).ready(function () {
                jQuery(function($){
                        jQuery(($) => {
                                        $('.btn-group').hide(); // hide form data default btn save, clear,getdata
                          
                                        $("#savefrmEntry").hide(); // hide form data entry btn
                                        var postId = '';

                                        const fbEditor = document.getElementById("build-wrap"); // for building form 
                                        const formBuilder = $(fbEditor).formBuilder();
                                        const fbRender = document.getElementById("fb-render");  // for rendering the form elements

                                        // default show the saved From tile(start)
                                        var jsonArray = "";
                                            $.ajax({
                                                      type: 'POST', 
                                                      url: ajaxurl,
                                                      data: {
                                                        'action': 'call_my_ajax_handler',
                                                        't_data':'',
                                                      },
                                                      success: function (data) {
                                                      //alert('success');
                                                      //console.log(data);

                                                      $("#bodytable").empty();

                                                      //Parse to an array of JSON objects
                                                      jsonArray = JSON.parse(data);
                                                      for (i=0;i<jsonArray.length;i++) {
                                                        //alert(jsonArray[i].ID + ", " + jsonArray[i].post_date + ", " + jsonArray[i].post_content);
                                                       
                                                         $("#tblId").append('<tr id = "'+jsonArray[i].ID+'"><td>' + jsonArray[i].ID + '</td><td>' + jsonArray[i].post_content + 
                                                         '</td><td><button type="button" id="btn-DataEntry" >Data Entry</button></td></tr>');
                                                      }

                                                    },
                                                      error: function () {
                                                      alert('fail');
                                                      }
                                                    });
                                        // default show the saved From tile(end)
                                        
                                        //get all saved Form Templete here
                                        function getFromTemplate(){
                                          var jsonFormattedString = '';
                                                      $.ajax({
                                                                type: 'POST', 
                                                                url: ajaxurl,
                                                                data: {
                                                                  'action': 'call_my_ajax_handler_temp',
                                                                  't_postid_data':postId,
                                                                },
                                                                success: function (data) {
                                                                alert('success');
                                                                  
                                                                //Parse to an array of JSON objects
                                                                 var jArray = JSON.parse(data);

                                                                for (i=0;i<jArray.length;i++) {
                                                                  
                                                                  var ydata = jArray[i];

                                                                  jsonFormattedString = ydata.replaceAll("\\", "");
                                                                  jsonArray = JSON.parse(jsonFormattedString);
                                                                  //$(fbRender).formRender({ jsonFormattedString });

                                                                }

                                                    const fbRender = document.getElementById("fb-render");
                                                    jQuery(function($) {
                                                      var formData = JSON.stringify(jsonArray);
                                                      $(fbRender).formRender({ formData });
                                                    
                                                    });
                                                 },
                                                          error: function () {
                                                          alert('fail');
                                                      }
                                                              });
                                          }
                                          //getFromTemplate();  // call get all saved Form Templete

                                     // saving from Data entry    
                                    function savedata(){
                                      var sendingdata = getFormData('#fb-render');
                                                        function getFormData(dom_query){
                                                              var out = {};
                                                              var s_data = $(dom_query).serializeArray();
                                                              //transform into simple data/value object
                                                              for(var i = 0; i<s_data.length; i++){
                                                                  var record = s_data[i];
                                                                  out[record.name] = record.value;
                                                              }
                                                              return out;
                                                          }
                                          //console.log(sendingdata);
                                          const formData = JSON.stringify(sendingdata); // json stringify is must to send data

                                                    $.ajax({
                                                      type: 'POST', 
                                                      url: ajaxurl,
                                                      data: {
                                                        'action': 'favourit_data',
                                                        't_data':formData,
                                                        't_post_id':postId,
                                                      },
                                                      success: function (data) {
                                                      alert('success');
                                                      
                                                      },
                                                      error: function () {
                                                      alert('fail');
                                                      }
                                                    });

                                      } 

                                        document.getElementById("saveData").addEventListener("click", () => {  // btn save form data 
                                              savedata(); // call save function for data entry
                                        });

                                        document.getElementById("saveFrmTitle").addEventListener("click", () => {  // save form title data
                                          const result = formBuilder.actions.save();
                                          console.log(result);

                                          const renderData = $.parseJSON(result); // making  fromdata array of string
                                          const formData = JSON.stringify(renderData);
                                          $(fbRender).formRender({ formData });

                                         
                                          var rawdata = formData;   // using ajax to send data into wordpress database

                                          var frmTitleValue = $("#frm_title").val();
                                                    $.ajax({
                                                      type: 'POST', 
                                                      url: ajaxurl,
                                                      data: {
                                                        'action': 'frm_title_data',
                                                        't_frmtitle_data':frmTitleValue,
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

                                        // jQuery("#getFrmTitlePostData").click(function(){
                                        //   var jsonArray = "";
                                        //     $.ajax({
                                        //               type: 'POST', 
                                        //               url: ajaxurl,
                                        //               data: {
                                        //                 'action': 'call_my_ajax_handler',
                                        //                 't_data':'',
                                        //               },
                                        //               success: function (data) {
                                        //               alert('success');
                                        //               console.log(data);

                                        //               $("#bodytable").empty();

                                        //               //Parse to an array of JSON objects
                                        //               jsonArray = JSON.parse(data);
                                        //               for (i=0;i<jsonArray.length;i++) {
                                        //                 //alert(jsonArray[i].ID + ", " + jsonArray[i].post_date + ", " + jsonArray[i].post_content);
                                                       
                                        //                 //  $("#bodytable").append("<tr><td>" +jsonArray[i].ID  +"</td><td>" + jsonArray[i].post_content +"</td><td>" + jsonArray[i].post_date +"</td></tr>");

                                        //                  $("#tblId").append('<tr id = "'+jsonArray[i].ID+'"><td>' + jsonArray[i].ID + '</td><td>' + jsonArray[i].post_content + '</td><td><button type="button" id="btn-' + jsonArray[i].ID + '" >Create Form</button></td></tr>');

                                                         
                                        //               }

                                                      
                                        //               },
                                        //               error: function () {
                                        //               alert('fail');
                                        //               }
                                        //             });
                                        // });

                                        $('#tblId').on('click','tr', function() {
                                         
                                          //alert( $( this ).text() );
                                          var row = $(this).closest('tr');
                                          var id = $(row).find('td').eq(0).html();
                                          postId = id; // assign id in postId
                                          
                                          $("#tblId").find("tr:gt(1)").remove();

                                          $("#build-wrap").hide(); // hide builder form
                                          getFromTemplate();  // call get all saved Form Templete
                                         
                                          $("#savefrmEntry").show(); // hide form data entry btn

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
          <!-- <button class="btn btn-success" id="saveFrmTitle" type="button">Save Form Title</button> -->
          <!-- <button class="btn btn-primary" id="getFrmTitlePostData" type="button">Get Form Title</button> -->
          
      </div>
    </div>

    <br/>
    <div id="build-wrap"></div>

    <div class="row">
      <div class= "col-md-4" id="savefrmEntry">
          <button id="saveData" type="button">External Save Button</button>

      </div>
      <div class= "col-md-8">
          <button class="btn btn-success" id="saveFrmTitle" type="button">Save Form </button>
      </div>
    </div>

          </br>
          <h4> save console data to database and retrive it and show the real form like below</h4>
          
  <!-- <div id="fb-render">
      <form  enctype="multipart/form-data"></form>
  </div> -->
    
  <form id="fb-render" enctype="multipart/form-data">    </form>



    <table class="table" id = "tblId">
        <thead>
        <tr>
            <th>ID</th>
            <th>POST Content</th>
            <th>POST Date</th>
            
            <th></th>
        </tr>
        </thead>
        <tbody id = "bodytable" >

        </tbody>
    </table>

<?php

    
}

 add_action("admin_menu","saa_custom_menu");


 function my_favourit_car(){  // data save into wordpress Db

    if(isset($_REQUEST)){
      $my_data = $_REQUEST['t_data'];  // all form data
      $my_frmpost_Id = $_REQUEST['t_post_id']; // form title id
      $current_Date = date("Y-m-d H:i:s");
      
      global $wpdb;
      $wpdb->insert(
          //$wpdb->prefix.'posts',
          $wpdb->prefix.'postmeta',
          [
            'meta_value'=> $my_data,
            //'post_id'=> '84',
            'post_id'=> $my_frmpost_Id,
            
            
          ]
      );
  
    }
}
 add_action('wp_ajax_favourit_data','my_favourit_car');


//  function my_post_form_template(){  // data save into wordpress Db

//   if(isset($_REQUEST)){
//     $my_data = $_REQUEST['t_frmtitle_data'];  // all form data
//     //$my_frmpost_Id = $_REQUEST['t_post_id']; // form title id
//     $current_Date = date("Y-m-d H:i:s");
    
//     global $wpdb;
//     $wpdb->insert(
//         $wpdb->prefix.'posts',
//         [
//           'post_content'=> $my_data,
//           'post_date'=> $current_Date,
//           'post_date_gmt' => $current_Date,
//           'post_title' => 'saa-form-title',
//         ]
//     );

//   }
// }
// add_action('wp_ajax_favourit_data','my_post_form_template');

 
 function my_form_title(){  // data save into wordpress Db
  if(isset($_REQUEST)){
    $my_frmdata = $_REQUEST['t_data'];  // all form data
    $my_frmtitledata = $_REQUEST['t_frmtitle_data'];
    $current_Date = date("Y-m-d H:i:s");
    
    global $wpdb;
    $wpdb->insert(
        $wpdb->prefix.'posts',
        [
          'post_content'=> $my_frmtitledata,
          'post_content_filtered' => $my_frmdata,
          'post_date'=> $current_Date,
          'post_date_gmt' => $current_Date,
          'post_title' => 'saa-form-title',
        ]
    );

  }
}


add_action('wp_ajax_frm_title_data','my_form_title');

function my_ajax_handler(){
  global $wpdb;
  //$programs = $wpdb->get_results("SELECT * FROM wp_posts where post_content = 'Test Form Title'");
  $programs = $wpdb->get_results("SELECT * FROM wp_posts where post_title = 'saa-form-title'");

 
  $tv=array();
  foreach ( $programs as $program) 
  {
     
       $tv[]=$program;
      // $tv[]=$program->post_content;
      // $tv[]=$program->post_date;
  }
  echo json_encode($tv);
  
  wp_die();
}
add_action( 'wp_ajax_call_my_ajax_handler', 'my_ajax_handler' );
add_action( 'wp_ajax_nopriv_call_my_ajax_handler', 'my_ajax_handler' );




function my_ajax_handler_tempdata(){
  if(isset($_REQUEST)){
    $my_frmPostId = $_REQUEST['t_postid_data'];  // all form data

    global $wpdb;
    $programs = $wpdb->get_results("SELECT post_content_filtered FROM wp_posts where ID = $my_frmPostId ");

   
    $tv=array();
    foreach ( $programs as $program) 
    {
       
         $tv[]=$program->post_content_filtered;
        
    }
    echo json_encode($tv);
    
    wp_die();
    
  }
 
}
add_action( 'wp_ajax_call_my_ajax_handler_temp', 'my_ajax_handler_tempdata' );
add_action( 'wp_ajax_nopriv_call_my_ajax_handler_temp', 'my_ajax_handler_tempdata' );