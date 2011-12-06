Profile Image updated.
<br/>
<?php
    echo $this->Html->image($uploadedImage
            , array('id'=>"cropedProfileImage"));
    
?>

<script>
    parent.document.getElementById("profileImage").src="";
    parent.document.getElementById("profileImage").src=
        document.getElementById("cropedProfileImage").src;
    
    $("#dialog-form", window.parent).dialog("close");
</script>
