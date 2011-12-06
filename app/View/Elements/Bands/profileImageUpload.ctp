<script>
    function validateImageFileType(){
        var fileName = $('#bandProfileImage').val();
        
        if (fileName.trim() == '') {
            alert('Please select a file.');
            return false;
        }
        var namePart = fileName.trim().split(".");
        var ext = namePart[namePart.length - 1];
        if (!(ext  == "png" || ext  == "jpg"|| ext  == "gif"|| ext  == "jpeg"
            ||ext  == "PNG" || ext  == "JPG"|| ext  == "GIF"|| ext  == "JPEG")) {
            alert("Only PNG, JPG, GIF, or JPEG file are allowed.");
            return false;
        } 
        return true;
    }
</script>
<!-- Image Upload Dialog-->
<div>
    <?php
    echo $this->Form->create(null
        , array('type' => 'file'
        , 'action' => 'showUploadForm'
        , 'enctype' => 'multipart/form-data'
        , 'id' => 'uploadBandProfile'
        , 'onsubmit' => 'if (!validateImageFileType(this.value)){return false} document.getElementById("uploadBandProfile").target = "upload_target";')
    );
    ?>
    <fieldset>
        <?php
        $selectedBand = $this->Session->read('band');
        echo $this->Form->input('name', array('value' => $selectedBand['Band']['bandName'], 'type' => 'hidden'));
        echo $this->Form->input('image', array('id' => 'bandProfileImage', "type" => "file", 'label' => 'Upload Image'));
        echo $this->Form->submit('Submit'
            , array('url' => array('action' => 'showUploadForm'
                , 'update' => 'cropImage'
            )
            , 'post', 'style' => 'width:110px; float: right; margin: 6px 36px 0 0;')
        );
        ?>
        <iframe id="upload_target" name="upload_target" src="" style="border:1px solid black; width:700px;height:400px;border:0px solid #fff;"></iframe>
    </fieldset>
    <?php
    echo $this->Form->end();
    ?>
</div>

