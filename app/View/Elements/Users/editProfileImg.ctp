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
    echo $this->Form->create('User'
        , array('type' => 'file'
            , 'action' => 'showUploadForm'
            , 'enctype' => 'multipart/form-data'
            , 'id' => 'profileImgForm'
            , 'style' => 'padding: 0px;')
    );
    ?>
    <fieldset>
        <?php
        $selectedBand = $this->Session->read('user');
        echo $this->Form->input('name', array('value' => $selectedBand['User']['id'], 'type' => 'hidden'));
        echo $this->Form->input('image', array('id' => 'bandProfileImage', "type" => "file", 'label' => 'Upload Image'
            , 'onchange'=>'if (!validateImageFileType(this.value)){return false} document.getElementById("profileImgForm").target = "upload_target"; $("#profileImgForm").submit();'));
        ?>
        <iframe id="upload_target" name="upload_target" src="" 
                style="border:1px solid black; width:100%; height: 400px; border:0px solid #fff;"></iframe>
    </fieldset>
    <?php
    echo $this->Form->end();
    ?>
</div>

