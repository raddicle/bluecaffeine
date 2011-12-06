<?php

echo $this->Html->css('cake.generic');
echo $this->Html->css('imgareaselect-default');
echo $this->Html->css('jquery-ui.css');
print $this->Html->script('jquery');
print $this->Html->script('jquery-form');
print $this->Html->script('jquery-ui-min');
print $this->Html->script('jquery-jeditable');
?>
<script language="javascript">
    var name = "#save_thumb";
    var menuYloc = null;
	
    $(document).ready(function(){
        menuYloc = parseInt($(name).css("top").substring(0,$(name).css("top").indexOf("px")))
        $(window).scroll(function () { 
            offset = menuYloc+$(document).scrollTop()+"px";
            $(name).animate({top:offset},{duration:500,queue:false});
        });
    }); 
</script>

<style>
    #save_thumb {
        position:absolute;
        top:330px;
        left:10px;
        z-index:1000;
    }
</style>
<?php

echo $this->Html->script('jquery.imgareaselect.js');

echo $this->Form->create(null
    , array('action' => 'cropImage'
    , 'enctype' => 'multipart/form-data'
    , 'style' => 'border:1px solid #899caa; border-radius:3px; -moz-border-radius:3px; margin:0px; background:#fff; padding:0px;'));
?>
<?php

echo $this->Form->submit('Done', array("id" => "save_thumb"
    , 'style' => 'width:110px; float: right; margin: 6px 36px 0 0;'));

echo $this->Form->input('id');
echo $this->Form->hidden('name');
echo $this->Cropimage->createJavaScript($uploaded['imageWidth'], $uploaded['imageHeight'], 400, 300);

echo $this->Cropimage->createForm('/content/band/upload/' . $uploaded["imageName"], 300, 300);
echo $this->Form->end();
?> 
