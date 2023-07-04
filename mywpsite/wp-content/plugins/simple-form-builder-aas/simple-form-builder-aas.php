<?php
/**
 * Plugin Name:       Simple Form Builder saa
 * Plugin URI:        https://wordpress.org/plugins/simple-form-builder-saa/
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
    add_menu_page("saa list","Build-Form","manage_options","saa-menu-01","call_back_fn_menu_01");
    add_submenu_page("saa-menu-01", "Get Form List", "Get Form List", 0, "saa-menu-02", "call_back_fn_menu_02");
    add_submenu_page("saa-menu-01", "Form Templete Edit", "Form Templete Edit", 1, "saa-menu-03", "call_back_fn_menu_03");
}

function call_back_fn_menu_01(){
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
                                                         '</td><td><button class = "btn btn-info" type="button" id="btn-DataEntry" >Data Entry</button></td></tr>');
                                                      }

                                                    },
                                                      error: function () {
                                                      alert('fail');
                                                      }
                                                    });
                                        // default show the saved From tile(end)
                                        
                                        //get all saved Form Templete here
                                        // function getFromTemplate(){
                                        //   var jsonFormattedString = '';
                                        //               $.ajax({
                                        //                         type: 'POST', 
                                        //                         url: ajaxurl,
                                        //                         data: {
                                        //                           'action': 'call_my_ajax_handler_temp',
                                        //                           't_postid_data':postId,
                                        //                         },
                                        //                         success: function (data) {
                                        //                         alert('success');
                                                                  
                                        //                         //Parse to an array of JSON objects
                                        //                          var jArray = JSON.parse(data);

                                        //                         for (i=0;i<jArray.length;i++) {
                                                                  
                                        //                           var ydata = jArray[i];

                                        //                           jsonFormattedString = ydata.replaceAll("\\", "");
                                        //                           jsonArray = JSON.parse(jsonFormattedString);
                                        //                           //$(fbRender).formRender({ jsonFormattedString });

                                        //                         }

                                        //             const fbRender = document.getElementById("fb-render");
                                        //             jQuery(function($) {
                                        //               var formData = JSON.stringify(jsonArray);
                                        //               $(fbRender).formRender({ formData });
                                                    
                                        //             });
                                        //          },
                                        //                   error: function () {
                                        //                   alert('fail');
                                        //               }
                                        //                       });
                                        //   }
                                          
                                     // saving from Data entry    
                                    // function savedata(){
                                    //   var sendingdata = getFormData('#fb-render');
                                    //                     function getFormData(dom_query){
                                    //                           var out = {};
                                    //                           var s_data = $(dom_query).serializeArray();
                                    //                           //transform into simple data/value object
                                    //                           for(var i = 0; i<s_data.length; i++){
                                    //                               var record = s_data[i];
                                    //                               out[record.name] = record.value;
                                    //                           }
                                    //                           return out;
                                    //                       }
                                    //       //console.log(sendingdata);
                                    //       const formData = JSON.stringify(sendingdata); // json stringify is must to send data

                                    //                 $.ajax({
                                    //                   type: 'POST', 
                                    //                   url: ajaxurl,
                                    //                   data: {
                                    //                     'action': 'favourit_data',
                                    //                     't_data':formData,
                                    //                     't_post_id':postId,
                                    //                   },
                                    //                   success: function (data) {
                                    //                   alert('success');
                                                      
                                    //                   },
                                    //                   error: function () {
                                    //                   alert('fail');
                                    //                   }
                                    //                 });

                                    //   } 

                                        // document.getElementById("saveData").addEventListener("click", () => {  // btn save form data 
                                        //       savedata(); // call save function for data entry
                                        // });

                                        document.getElementById("saveFrmTitle").addEventListener("click", () => {  // save form title data
                                          const result = formBuilder.actions.save();
                                          console.log(result);

                                          const renderData = $.parseJSON(result); // making  fromdata array of string
                                          const formData = JSON.stringify(renderData);
                                          //$(fbRender).formRender({ formData });  // rendering off when saveing form-title 

                                         
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
                                                          location.reload(true); // refresh the page
                                                      },
                                                      error: function () {
                                                      alert('fail');
                                                      }
                                                    });


                                        });
                                        

                                      //   $('#tblId').on('click','tr', function() {
                                         
                                      //     //alert( $( this ).text() );
                                      //     var row = $(this).closest('tr');
                                      //     var id = $(row).find('td').eq(0).html();
                                      //     postId = id; // assign id in postId
                                          
                                      //     $("#tblId").find("tr:gt(1)").remove();

                                      //     $("#build-wrap").hide(); // hide builder form
                                      //     getFromTemplate();  // call get all saved Form Templete
                                         
                                      //     $("#savefrmEntry").show(); // hide form data entry btn
                                      //     $("#saveFrmTitle").hide(); // hide builder form save btn
                                      //     $("#btn-DataEntry").hide(); // hide builder form save btn
                                      //     $("#frmTitle").hide(); // hide builder form title div

                                      //   });

                                       });

                    });


                   
            });
        </script>
        
        <br/>

    <div class="row" id = "frmTitle">
      <div class= "col-md-8 frmTitle">
        <div class= "form-group">
        <label class="control-level">Form Title </lebel>
          <input class= "form-group" type="text" name="frm_title" id="frm_title" value=""/>
        </div>
      </div>
      
    </div>

 
    <div id="build-wrap" class = "frmBuilder"></div>

    <div class="row">
      <div class= "col-md-4">
         <button class="btn btn-success" id="saveFrmTitle" type="button">Save Form </button>
      </div>
      <div class= "col-md-8"></div>
      
    </div>
   

<?php
    
}

function call_back_fn_menu_02(){
  ?>
        <script>
            jQuery(document).ready(function () {
                jQuery(function($){
                        jQuery(($) => {
                                        $('.btn-group').hide(); // hide form data default btn save, clear,getdata
                          
                                        $("#savefrmEntry").hide(); // hide form data entry btn
                                        $("#updatefrmEntry").hide(); // hide form data update btn

                                        var postId = '';
                                        var postmetaId = '';
                                        $("#tblDataEntryId").hide();

                                        
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
                                                         '</td><td><button class = "btn btn-info" type="button" id="btn-DataEntry" >Data Entry</button></td></tr>');
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
                                          jsonArray = '';
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
                                          // get meta data form templete
                                          function getMetaDataFormTemplate(){
                                          var jsonFormattedString = '';
                                                      $.ajax({
                                                                type: 'POST', 
                                                                url: ajaxurl,
                                                                data: {
                                                                  'action': 'call_my_ajax_handler_metatemp',
                                                                  't_postmetaid_data':postmetaId,
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

                                          // get all form data entry
                                          function getFromDataEntry(){
                                          var jsonFormattedString = '';
                                                      $.ajax({
                                                                type: 'POST', 
                                                                url: ajaxurl,
                                                                data: {
                                                                  'action': 'call_my_ajax_handler_temp_frmdata',
                                                                  't_postid_data':postId,
                                                                },
                                                                success: function (data) {
                                                                alert('success');
                                                                  
                                                                //Parse to an array of JSON objects
                                                                var jArray = JSON.parse(data);

                                                                headerData = null;

                                                                for (a=0;a<jArray.length;a++) {
                                                                  
                                                                  var ydata = jArray[a];
                                                                  var meta_id = ydata.meta_id;
                                                                  var post_id = ydata.post_id;

                                                                  jsonFormattedString = ydata.meta_value.replaceAll("\\", "");
                                                                  //var tformData = JSON.stringify(jsonFormattedString);
                                                                  jsonArray = JSON.parse(jsonFormattedString);
                                                                  var fieldname = '';
                                                                  var fieldvalue = '';
                                                                
                                                                row = $('<tr><td>' + meta_id + '</td><td>' + post_id + '</td></tr>');
                                                                headerRow = $('<tr></tr>');

                                                                for (var i = 0; i < jsonArray.length; i++) {
                                                                  fieldname = jsonArray[i].name;
                                                                  fieldvalue = jsonArray[i].userData;

                                                                  var rowData = $('<td></td>').addClass(fieldname).text(fieldvalue);
                                                                  row.append(rowData); // add data row cell dynamically
                                                                  

                                                                  headerData = $('<th></th>').addClass(fieldname).text(fieldname);
                                                                  headerRow.append(headerData); // add header cell dynamically

                                                                   
                                                                }

                                                                var btnData = $('<td><button class = "btn btn-warning" type="button" id="btn-edit" >Edit</button></td>');
                                                                row.append(btnData); // add data row cell dynamically
                                                                

                                                                $("#tblDataEntryId").append(row);
                                                                
                                                                $('tr td:nth-child(1)').hide();
                                                                $('tr td:nth-child(2)').hide();

                                                                // $("#tblDataEntryId").append('<tr id = "'+meta_id+'"><td>' + meta_id + '</td><td>' + post_id + '</td><td>' +fieldname 
                                                                //   + '</td><td>'+jsonFormattedString+ '</td><td><button class = "btn btn-info" type="button" id="btn-DataEntry" >Data Entry</button></td></tr>');
                                                                 
                                                                 
                                                            }
                                                            $("#tblDataEntryId thead").append(headerRow);

                                                                //   jsonFormattedString = meta_value.replaceAll("\\", "");
                                                                //   var saa_newData3 = jsonFormattedString.replace(/[&\/\\#+()$~%.'"*?<>]/g,'');
                                                                //   var sfdata = JSON.stringify(saa_newData3);
                                                                
                                                 },
                                                          error: function () {
                                                          alert('fail');
                                                      }
                                                              });
                                          }

                                          // get form templete edit
                                        // function getFormTemplateEdit(){
                                         
                                        //   const formData = JSON.stringify($(fbRender).formRender("userData")); // json stringify is must to send data

                                        //   var rawdata = formData;   // using ajax to send data into wordpress database

                                        //      $.ajax({
                                        //                         type: 'POST', 
                                        //                         url: ajaxurl,
                                        //                         data: {
                                        //                           'action': 'call_my_ajax_handler_formtempedit',
                                        //                           't_data':rawdata,
                                        //                           't_postid_data':postId,
                                        //                         },
                                        //                         success: function (data) {
                                        //                         alert('success');
                                                                  
                                        //                                                     const fbRender = document.getElementById("fb-render");
                                        //                                                     jQuery(function($) {
                                        //                                                       //var formData = JSON.stringify(jsonArray);
                                        //                                                       $(fbRender).formRender({ formData });
                                                                                            
                                        //                                                     });
                                        //                                                 },
                                        //                             error: function () {
                                        //                                 alert('fail');
                                        //                             }
                                        //        });

                                        //   }

                                     // saving from Data entry    
                                    function savedata(){
                                          const formData = JSON.stringify($(fbRender).formRender("userData")); // json stringify is must to send data

                                          
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
                                                          //$("#tblId").find("tr:gt(0)").remove();
                                                          getFromDataEntry();
                                                          //$("#tblDataEntryId").show();
                                                      
                                                      },
                                                      error: function () {
                                                      alert('fail');
                                                      }
                                                    });

                                      } 

                                        document.getElementById("saveData").addEventListener("click", () => {  // btn save form data 
                                              savedata(); // call save function for data entry
                                              location.reload(true); // refresh the page
                                        });
                                        
                                        // document.getElementById("btnfrmTemEdit").addEventListener("click", () => {  // btn save form data 
                                        //     getFormTemplateEdit(); // call save function for data entry
                                        // });

                                          // updating from Data entry    
                                          function updatedata(){
                                          const formData = JSON.stringify($(fbRender).formRender("userData")); // json stringify is must to send data

                                          
                                                    $.ajax({
                                                      type: 'POST', 
                                                      url: ajaxurl,
                                                      data: {
                                                        'action': 'update_data',
                                                        't_data':formData,
                                                        't_post_meta_id':postmetaId,
                                                      },
                                                      success: function (data) {
                                                          alert('success');
                                                          location.reload(true); // refresh the page
                                                          //getFromDataEntry();
                                                          
                                                          $("#tblDataEntryId").show();
                                                      
                                                      },
                                                      error: function () {
                                                      alert('fail');
                                                      }
                                                    });

                                      } 
                                        document.getElementById("updatefrmEntry").addEventListener("click", () => {  // btn save form data 
                                              updatedata(); // call save function for data entry
                                              getMetaDataFormTemplate();
                                        });



                                        $('#tblId').on('click','tr', function() {
                                         
                                          //alert( $( this ).text() );
                                          var row = $(this).closest('tr');
                                          var id = $(row).find('td').eq(0).html();
                                          postId = id; // assign id in postId
                                          
                                          //$("#tblId").find("tr:gt(0)").remove();
                                          $("#tblId").hide();

                                          $("#build-wrap").hide(); // hide builder form

                                          getFromDataEntry(); // get formed data
                                          getFromTemplate();  // call get saved Form Templete

                                          $("#savefrmEntry").show(); // hide form data entry btn
                                          $("#saveFrmTitle").hide(); // hide builder form save btn
                                          $("#btn-DataEntry").hide(); // hide builder form save btn
                                          $("#frmTitle").hide(); // hide builder form title div

                                          $("#tblDataEntryId").show();

                                        });

                                        $('#tblDataEntryId').on('click','tr', function() {
                                         
                                         //alert( $( this ).text() );
                                         var row = $(this).closest('tr');
                                         var metaid = $(row).find('td').eq(0).html();
                                         var id = $(row).find('td').eq(1).html();
                                         postId = id; // assign id in postId
                                         postmetaId = metaid;
                                        
                                         $("#tblId").hide();
                                         $("#build-wrap").hide(); // hide builder form

                                         //getFromTemplate();  // call get all saved Form Templete saurab:03072023
                                         getMetaDataFormTemplate();
                                        
                                         $("#savefrmEntry").hide(); // hide form data entry btn
                                         $("#saveFrmTitle").hide(); // hide builder form save btn
                                         $("#btn-DataEntry").hide(); // hide builder form save btn
                                         $("#frmTitle").hide(); // hide builder form title div

                                         $("#updatefrmEntry").show();
                                         $("#tblDataEntryId").show();

                                       });

                                });

                           
                    });


                   
            });
        </script>
        
        <br/>
   
   
  <div class="row">
      <div class= "col-md-6">
          <form id="fb-render" enctype="multipart/form-data"> </form>

      </div>
      <div class= "col-md-6">
          <!-- <div id="build-wrap" class = "frmBuilder"></div> -->
      </div>
      
  </div>

    <div class="row" id = "xid">
      
      
    </div>


  <div class="row">
      <div class= "col-md-4" id="savefrmEntry">
          <button id="saveData" type="button" class="btn btn-primary">Save Data</button>
          <!-- <button class = "btn btn-primary" type="button" id="btnfrmTemEdit" >Form Templete Edit</button> -->
      </div>
      <div class= "col-md-8"> </div>
  </div>
  </br>
  <div class="row">
      <div class= "col-md-4" id="updatefrmEntry">
          <button id="saveData" type="button" class="btn btn-primary">Update Data</button>
      </div>
      <div class= "col-md-8"> </div>
  </div>
  </br>

    <table class="table" id = "tblId">
        <thead>
        <tr>
            <th>ID</th>
            <th>Form Title</th>
            <th>Action</th>
            <th></th>
        </tr>
        </thead>
        <tbody id = "bodytable" >

        </tbody>
    </table>

    <table class="table" id = "tblDataEntryId">
        <thead>
       
        </thead>
        <tbody>

        </tbody>
    </table>

<?php
}

function call_back_fn_menu_03(){
  ?>
        <script>
            jQuery(document).ready(function () {
                jQuery(function($){
                        jQuery(($) => {
                                        $('.btn-group').hide(); // hide form data default btn save, clear,getdata
                          
                                        $("#savefrmEntry").hide(); // hide form data entry btn
                                        $("#updatefrmEntry").hide(); // hide form data update btn

                                        var postId = '';
                                        var postmetaId = '';
                                        $("#tblDataEntryId").hide();

                                        
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
                                                         '</td><td><button class = "btn btn-info" type="button" id="btn-DataEntry" >Edit Templete</button></td></tr>');
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
                                          jsonArray = '';
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

                                          // get form templete edit
                                          function getFormTemplateEdit(){
                                            var finalData = '';
                                          //const formData = JSON.stringify($(fbRender).formRender("userData")); // json stringify is must to send data
                                                    const fbRender = document.getElementById("fb-render");
                                                    jQuery(function($) {
                                                      var formData = JSON.stringify(jsonArray);
                                                      $(fbRender).formRender({ formData });

                                                       var result = formBuilder.actions.save();
                                                      //  var str = result.replace(/[0-9`~!@#$%^&*()_|+\-=?;'.<>\[\]\\\/]/gi,'');
                                                        //var fdt = formData.replace(/[0-9`~!@#$%^&*()_|+\-=?;'.<>\]\\\/]/gi,'');
                                                      //finalData = fdt +","+ str + "]";

                                                        var str = result.replace('[','');
                                                        //var str2 = str.replace(']','');
                                                        var str2 = str.slice(0, -1); // Masteringjs.io

                                                        //var fdt = formData.replace(']','');
                                                        var fdt = formData.slice(0, -1); // Masteringjs.io
                                                        finalData = fdt +","+ str2 + "]";
                                                      
                                                      const renderData = $.parseJSON(finalData); // making  fromdata array of string
                                                      const rawdata = JSON.stringify(renderData);
                                                      
                                                      $.ajax({
                                                               type: 'POST', 
                                                               url: ajaxurl,
                                                               data: {
                                                                  'action': 'call_my_ajax_handler_formtempedit',
                                                                  't_data':rawdata,
                                                                  't_postid_data':postId,
                                                                    },
                                                                success: function (data) {
                                                                    alert('success');
                                                                    location.reload(true); // refresh the page
                                                                   },
                                                                 error: function () {
                                                                  alert('fail');
                                                                  }
                                                            });
                                                      });

                                          }

                                    
                                        document.getElementById("btnfrmTemEdit").addEventListener("click", () => {  // btn save form data 
                                            getFormTemplateEdit(); // call save function for data entry
                                        });


                                        $('#tblId').on('click','tr', function() {
                                         
                                          //alert( $( this ).text() );
                                          var row = $(this).closest('tr');
                                          var id = $(row).find('td').eq(0).html();
                                          postId = id; // assign id in postId
                                          
                                          //$("#tblId").find("tr:gt(0)").remove();
                                          $("#tblId").hide();

                                          $("#build-wrap").show(); // hide builder form

                                          getFromTemplate();  // call get all saved Form Templete
                                          //getFromDataEntry(); // get formed data
                                          //getFormTemplateEdit();

                                          $("#savefrmEntry").show(); // hide form data entry btn
                                          $("#saveFrmTitle").hide(); // hide builder form save btn
                                          $("#btn-DataEntry").hide(); // hide builder form save btn
                                          $("#frmTitle").hide(); // hide builder form title div

                                          $("#tblDataEntryId").show();

                                        });

                                });

                           
                    });


                   
            });
        </script>
        
        <br/>
   
   
  <div class="row">
      <div class= "col-md-8">
          <div id="build-wrap" class = "frmBuilder"></div>
      </div>
      <div class= "col-md-4">
          <form id="fb-render" enctype="multipart/form-data"> </form>
      </div>
      
  </div>

    


  <div class="row">
      <div class= "col-md-4" id="savefrmEntry">
          <!-- <button id="saveData" type="button" class="btn btn-primary">Save Data</button> -->
          <button class = "btn btn-primary" type="button" id="btnfrmTemEdit" >Form Templete Edit</button>
      </div>
      <div class= "col-md-8"> </div>
  </div>
  </br>
  <!-- <div class="row">
      <div class= "col-md-4" id="updatefrmEntry">
          <button id="saveData" type="button" class="btn btn-primary">Update Data</button>
      </div>
      <div class= "col-md-8"> </div>
  </div> -->
  </br>

    <table class="table" id = "tblId">
        <thead>
        <tr>
            <th>ID</th>
            <th>Form Title</th>
            <th>Action</th>
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

 function my_update_metavalue(){  // data save into wordpress Db

  if(isset($_REQUEST)){
    $my_data = $_REQUEST['t_data'];  // all form data
    $my_frmpost_Id = $_REQUEST['t_post_meta_id']; // form title id
    //$current_Date = date("Y-m-d H:i:s");
    
    global $wpdb;
    $wpdb->update('wp_postmeta', array( 'meta_value'=>$my_data), array('meta_id'=>$my_frmpost_Id));

    // $wpdb->update(
    //     //$wpdb->prefix.'posts',
    //     $wpdb->prefix.'postmeta',
    //     [
    //       'meta_value'=> $my_data,
    //       //'post_id'=> '84',
    //       'post_id'=> $my_frmpost_Id,
          
          
    //     ]
    // );
    

  }
}
 add_action('wp_ajax_update_data','my_update_metavalue');
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

function my_ajax_handler_metatempdata(){
  if(isset($_REQUEST)){
    $my_frmPostId = $_REQUEST['t_postmetaid_data'];  // all form data

    global $wpdb;
    $programs = $wpdb->get_results("SELECT meta_value FROM wp_postmeta where meta_id = $my_frmPostId ");

   
    $tv=array();
    foreach ( $programs as $program) 
    {
       
         $tv[]=$program->meta_value;
        
    }
    echo json_encode($tv);
    
    wp_die();
    
  }
 
}
add_action( 'wp_ajax_call_my_ajax_handler_metatemp', 'my_ajax_handler_metatempdata' );
add_action( 'wp_ajax_nopriv_call_my_ajax_handler_metatemp', 'my_ajax_handler_metatempdata' );


function my_ajax_handler_formtempedit(){
  if(isset($_REQUEST)){
    $my_data = $_REQUEST['t_data'];  // all form data
    $my_frmPostId = $_REQUEST['t_postid_data'];  // all form data

    global $wpdb;
    //$programs = $wpdb->get_results("SELECT meta_value FROM wp_postmeta where meta_id = $my_frmPostId ");
    $wpdb->update('wp_posts', array( 'post_content_filtered'=>$my_data), array('ID'=>$my_frmPostId));
   
    // $tv=array();
    // foreach ( $programs as $program) 
    // {
       
    //      $tv[]=$program->meta_value;
        
    // }
    // echo json_encode($tv);
    
    //wp_die();
    
  }
 
}
add_action( 'wp_ajax_call_my_ajax_handler_formtempedit', 'my_ajax_handler_formtempedit' );
add_action( 'wp_ajax_nopriv_call_my_ajax_handler_formtempedit', 'my_ajax_handler_formtempedit' );



function my_ajax_handler_formdataentry(){
  if(isset($_REQUEST)){
    $my_frmPostId = $_REQUEST['t_postid_data'];  // all form data

    global $wpdb;
    $programs = $wpdb->get_results("SELECT * FROM wp_postmeta where post_id = $my_frmPostId ");

   
    $tv=array();
    foreach ( $programs as $program) 
    {
       
         $tv[]=$program;
        
    }
    echo json_encode($tv);
    
    wp_die();
    
  }
}

add_action( 'wp_ajax_call_my_ajax_handler_temp_frmdata', 'my_ajax_handler_formdataentry' );
add_action( 'wp_ajax_nopriv_call_my_ajax_handler_temp_frmdata', 'my_ajax_handler_formdataentry' );

