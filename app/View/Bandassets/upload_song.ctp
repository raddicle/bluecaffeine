<script>
    
    <?php if (isset($uploadError)) :?>
        alert('<?php echo $uploadError ?>');
    <?php else :?>
        if (<?php echo $mediaType ?> == 1) {
            parent.songDialogCallBack();
        } else {
            parent.videoDialogCallBack();
        }
    <?php endif?>
</script>
