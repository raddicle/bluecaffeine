<script>
    $(function() {
        $( "#videoDialog:ui-dialog" ).dialog( "destroy" );
        $( "#videoDialog" ).dialog({
            autoOpen: false,
            height: 450,
            width: 550,
            modal: true,
            close: function() {
            }
        });
    
        $( "#songDialog:ui-dialog" ).dialog( "destroy" );
        $( "#songDialog" ).dialog({
            autoOpen: false,
            height: 450,
            width: 550,
            modal: true,
            close: function() {
            }
        });
    });


    function resetSongForm() {
        $("#__formsongDialog").resetForm();
        $("#__formvideoDialog").resetForm();
    }

    function songDialogCallBack() {
        $.ajax({
            type: "post",
            url: "<?php echo $this->Html->url('/Bandassets/view/1', true); ?>",
            success: function(response) {
                $("#songDialog").dialog( "close" );
                $("#songSection").html(response);
            },
            error:function (XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
        return false;
    }

    function videoDialogCallBack(){
        $.ajax({
            type: "post",
            url: "<?php echo $this->Html->url('/Bandassets/view/2', true); ?>",
            success: function(response) {
                $("#videoDialog").dialog( "close" );
                $("#videoSection").html(response);
            },
            error:function (XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
        return false;    
    }



    $(document).ready(function() {
        $("#accordion").accordion({ 
            clearStyle: true,
            autoHeight: false
        });
    
        $( "#uploadImageDialog:ui-dialog" ).dialog("destroy");

        $( "#uploadImageDialog" ).dialog({
            autoOpen: false,
            height: 600,
            width: 750,
            modal: true,
            close: function() {
            }
        });

        $( "#updateProfileImage" )
        .button()
        .click(function() {
            $.ajax({
                type: 'post'
                , url: '<?php echo $this->Html->url('/band/editProfileimage', true); ?>'
                , success: function(response, status) {
                    $('#uploadImageDialog').html(response);
                }
                , error: function(response, status) {
                    alert('An unexpected error has occurred!');
                }
            }
        );
            
            
            $( "#uploadImageDialog" ).dialog( "open" );
        });


        $( "#accSettingDialog:ui-dialog" ).dialog( "destroy" );
        $( "#accSettingDialog" ).dialog({
            autoOpen: false,
            height: 710,
            width: 500,
            modal: true,
            close: function() {
                $("#newMember").css("display","none"); 
                $("#memberTable").css("display","inline"); 
            }
        });
        $( "#accountSetting" )
        .button()
        .click(function() {
            $( "#accSettingDialog" ).dialog( "open" );
        });


        $( "#newBandDialog:ui-dialog" ).dialog( "destroy" );
        $( "#newBandDialog" ).dialog({
            autoOpen: false,
            height: 420,
            width: 500,
            modal: true,
            close: function() {
            }
        });
        $( "#newBand" )
        .button()
        .click(function() {
            $( "#newBandDialog" ).dialog( "open" );
        });


        $( "#emailWebMasterDialog:ui-dialog" ).dialog( "destroy" );
        $( "#emailWebMasterDialog" ).dialog({
            autoOpen: false,
            height: 450,
            width: 600,
            modal: true,
            close: function() {

            }
        });
        $( "#emailWebMaster" )
        .button()
        .click(function() {
            $( "#emailWebMasterDialog" ).dialog( "open" );
        });
    });

    function viewPost(bandId){
        var data = "id="+ bandId;
        $.ajax({
            type: "post",  // Request method: post, get
            url: "<?php echo $this->Html->url('/band/banddetails', true); ?>", // URL to request
            data: data,  // post data
            success: function(response) {
                document.getElementById("post-view").innerHTML = response;
            },
            error:function (XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
        return false;
    }
    
</script>

<!-- Image Upload Dialog-->
<div id="uploadImageDialog" title="Upload band's profile image">
</div>
<!-- Account Setting Dialog-->
<div id="accSettingDialog" title="Account Setting">
    <?php echo $this->element('Bands/member'); ?>
</div>

<div id="newBandDialog" title="Create New Band">
    <?php echo $this->element('Bands/newband'); ?>
</div>

<!-- Email Web master Dialog-->
<div id="emailWebMasterDialog" title="To Bluecaffeine Webmaster">
    <div id="emailwebmasterContent">
        <?php
        echo $this->element('emailwebmaster');
        ?>
    </div>
</div>


<div style="width: 39%; float: left;">
    <?php
    echo $this->Html->image('/content/band/thumbnail/band_' . strtolower($band['Band']['id']), array('style' => 'width: 100%', 'id' => "profileImage",
        'onmouseover' => 'document.getElementById("bandImage").style.visibility = "visible"',
        'onmouseout' => 'document.getElementById("bandImage").style.visibility = "hidden"',
    ));
    ?>
    <div style="border: 1px solid lightgrey;">
        <div id="bandImage" style="margin-top: -25px; margin-left: 10px; visibility: hidden;"
             onmouseover='document.getElementById("bandImage").style.visibility = "visible"' 
             onmouseout='document.getElementById("bandImage").style.visibility = "hidden"'>
                 <?php
                 echo $this->Html->image('picture_edit.png', array('id' => 'updateProfileImage'));
                 ?>
            <span style="font-weight: bold; text-shadow: 0 0 4px #000">
                Edit Image
            </span>
        </div>
        <div id="bandProfileDetails">
            <dl>
                <dt>Band Name</dt>
                <dd><?php echo $band['Band']['bandName']; ?></dd>
                <dt>Genre</dt>
                <dd><?php echo $band['Band']['genre']; ?></dd>
                <dt>About Us</>
                <dd><?php echo $band['Band']['aboutBand']; ?></dd>
            </dl>
        </div>
    </div>
</div>
<div id="accordion" style="padding-left: 5px; width: 60%; float: right;">
    <h3><a href="#">Manage Account</a>
        <div style="margin-left: 35px; font-size: 80%; color: grey; ">Update your Bio, Email and other details</div>
    </h3>
    <div style="text-align: center;">
        <button id="accountSetting" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="margin: 3px; width: 250px">
            <span class="ui-button-text">Account Setting</span>
        </button>
        <button id="newBand" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="margin: 3px; width: 250px">
            <span class="ui-button-text">Create New Band</span>
        </button>
        <button id="emailWebMaster" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="margin: 3px; width: 250px">
            <span id="contactWebMaster" class="ui-button-text">Message to webmaster</span>
        </button>   		
    </div>

    <h3>
        <a href="#">Upload Songs</a>
        <div style="margin-left: 35px; font-size: 80%;color: grey;">Upload music and write about it!</div>
    </h3>
    <div>
        <a href="#" id="addNewSong" onclick='resetSongForm(); $("#songDialog").dialog( "open" );'>Add Song</a>
        <div id="songSection">
            <div id="songDialog" title="Upload Song">
                <?php
                echo $this->assetupload->createAssetForm('Bandasset', 'uploadSong', 'Upload Song', 'songDialog', 'uploadSong', $this->Session->read("bandId"), 'FILE', 'AUDIO');
                ?>        
            </div>    
            <?php
            echo $this->element('Assets/list', array("mediaType" => '1'));
            ?>
        </div>
    </div>


    <h3>
        <a href="#">Upload Videos</a>
        <div style="margin-left: 35px; font-size: 80%; color: grey;">Upload Videos</div>
    </h3>
    <div>
        <a href="#" id="addNewVideo" onclick='resetSongForm(); $("#videoDialog").dialog( "open" );'>Add Video</a>
        <div id="videoSection">
            <div id="videoDialog" title="Upload Video">
                <?php
                echo $this->assetupload->createAssetForm('Bandasset', 'uploadSong', 'Upload Video', 'videoDialog', 'uploadVideo', $this->Session->read("bandId"), 'FILE', 'VIDEO');
                ?>        
            </div>    
            <?php
            echo $this->element('Assets/list', array("mediaType" => '2'));
            ?>
        </div>
    </div>


    <h3>
        <a href="#">Manage Your Blogs</a>
        <div style="margin-left: 35px; font-size: 80%; color: grey;">Time to write a new blog!</div>
    </h3>
    <div id="bandBlog">
        <?php
        echo $this->element('Posts/list');
        ?>
    </div>


    <h3>
        <a href="#">Manage Your News</a>
        <div style="margin-left: 35px; font-size: 80%; color: grey;">Spread the words</div>
    </h3>
    <div id="bandNews">
        <?php
        echo $this->element('News/list');
        ?>
    </div>


</div>
