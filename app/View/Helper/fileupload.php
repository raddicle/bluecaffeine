<?php 
class FileuploadHelper extends AppHelper{
    var $helpers = array('Html', 'Form');

    function createUploadForm($controller, $actionUrl, $dialogTitle, $dialogId, $compAttached, $fileName) {

         $uploadForm =
         '  <div id="'.$dialogId.'" title="'.$dialogTitle.'">
            <div>'.
                $this->Form->create($controller, 
                                    array('action' => $actionUrl
                                          , 'enctype' => 'multipart/form-data'
                                          , 'id'=>'__form'. $dialogId
                                          , 'type' => 'file')).
                $this->Form->input('name', array('value' => $fileName
                                                 , 'type'=>'hidden')).
                $this->Form->input('image', array("type" => "file"
                                                  , 'label'=> $dialogTitle)).
                $this->Form->button('Submit'
                                    , array('class' => 'ui-button ui-widget ui-state-default ui-corner-all'
                                            , 'style'=>'float: right; margin-top: 20px;'
                                            , 'type' => 'submit')).
         $this->Form->end().
         '
         <iframe id="__'.$dialogId.'_target" name="__'.$dialogId.'_target" style="width:0px;height:0px;border:0px solid #fff;">
         </iframe>
         </div>
         </div>
         <script>
         $(function() {
                $( "#'.$dialogId.'" ).dialog({
                        autoOpen: false,
                        height: 150,
                        width: 450,
                        modal: true,
                        close: function() {
                                allFields.val( "" ).removeClass( "ui-state-error" );
                        }
                });

                $( "#'.$compAttached.'" )
                        .button()
                        .click(function() {
                                $( "#'.$dialogId.'" ).dialog( "open" );
                    });
                });


$(document).ready(function() {

                    document.getElementById("__form'. $dialogId .'").onsubmit=function() {
                        document.getElementById("__form'. $dialogId .'").target = "__'.$dialogId.'_target";
                        $( "#'.$dialogId.'" ).dialog("close");
                    }
                });
         </script>';
         return $uploadForm;
     }
 }
 ?>