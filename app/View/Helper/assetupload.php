<?php

class AssetuploadHelper extends AppHelper {

    var $helpers = array('Html', 'Form', 'Js');

    function createAssetForm($controller, $actionUrl, $dialogTitle, $dialogId, $compAttached, $bandId, $assetType = "FILE", $mediaType = "AUDIO") {

        $uploadForm =
            $this->Form->create($controller, array('action' => $actionUrl
                , 'enctype' => 'multipart/form-data'
                , 'id' => '__form' . $dialogId
                , 'type' => 'file')) .
            '<fieldset>' .
            $this->Form->input('file_name', array('label' => 'Song', 'id'=>'assetName'.$dialogId)) .
            $this->Form->input('genre', array('label' => 'Genre', 'type' => 'select', 'options' => Configure::read('genre'))) .
            $this->Form->input('media_type', array('type' => 'hidden'
                , 'value' => ($mediaType == 'AUDIO' ? '1' : '2'), 'accept'=>'*.gif')) .
            $this->Form->input('band_id', array('type' => 'hidden', 'value' => $bandId)) .
            $this->Form->input('fileType', array('type' => 'hidden', 'id'=>'fileType'.$dialogId)) .
            $this->Form->input('description', array('type' => 'textarea', 'rows' => '3')) .
            $this->Form->input('image', array("type" => "file", 'label' => $dialogTitle, 'id'=>'assetFile'.$dialogId, 'class'=>'required')) .
            '<div id="assetLinks">' .
            '<div class="input file">' .
            $this->Form->input('BandassetLink.link', array('div' => false)) .
            '</div>' .
            '</div>' .
            $this->Form->input('Upload'
                , array('style' => 'width:110px; float: right; margin: 6px 24px 0 0;'
                , 'type' => 'submit', 'label' => false)) .
            '</fieldset>' .
            $this->Form->end() .
            '  <iframe id="__' . $dialogId . '_target" name="__' . $dialogId . '_target" style="width:0px;height:0px;border:0px solid #fff;"></iframe>
         <script>
                $(document).ready(function() {
                    document.getElementById("__form' . $dialogId . '").onsubmit=function() {
                        if ($("#assetName'.$dialogId.'").val().trim() == "" ||  $("#assetFile'.$dialogId.'").val().trim() == ""){
                            alert("Song name and file are madatory. Please enter before saving.");
                            return false;
                        } else {
                            var namePart = $("#assetFile'.$dialogId.'").val().trim().split(".");
                            var ext = namePart[namePart.length - 1];
                            if (!(ext  == "mp3" || ext  == "mp4")) {
                                alert("Only MP3 or MP4 file are allowed.");
                                return false;
                            } else {
                            $("#fileType'.$dialogId.'").val(ext);
                            
                            }
                        }
                        
                        document.getElementById("__form' . $dialogId . '").target = "__' . $dialogId . '_target";
                    }
                });
         </script>';
        return $uploadForm;
    }

}

?>