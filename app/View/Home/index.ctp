<style>
    .homeTitle{
        color: white;
        font-weight: bold;
    }

    .description{
        color: white;
    }
</style>
<script>
    $(function() {
        $( "#tabs" ).tabs();
        
        $("#registerAsArtist").click(registerAsArtist);
    });
    
    function registerAsArtist(){
       
        $.ajax({
            type: "post",
            url: "<?php echo $this->Html->url('/Users/registerAsArtist'); ?>",
            success: function(response) {
                alert("An email is end to Sales Support. Someone from Sales support will contact you.");
            },
            error:function (XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
        return false;    
    }


</script>


<?php $user = $this->Session->read('user');
    $this->set('showAdd', false);
    
    if ($this->Session->read('Auth.User') && $user['User']['role'] == 'fan') : ?>
    <a id="registerAsArtist" style="float:right; margin-top: -25px">Register as artist</a>
<?php endif ?>

<div style="display: table; text-align: center; width: 100%;">
    <div style="display: table-cell; padding-right: 20px; width: 200px;">
        <div class="homeTitle">artists</div>
        <?php echo $this->Html->image('home/artists.png', array('style' => 'width: 200px; height: 150px', 'class' => 'imageBorder')); ?>
        <div class="description">Welcome new fans to your music; take your music places</div>
        
    </div>

    <div style="display: table-cell; padding-right: 20px; width: 200px;">
        <div class="homeTitle">college band</div>
        <?php echo $this->Html->image('home/collegeBand.png', array('style' => 'width: 200px; height: 150px', 'class' => 'imageBorder')); ?>
        <div class="description">Sign up and take your talent into the industry</div>
    </div>

    <div style="display: table-cell; padding-right: 20px; width: 200px;">
        <div class="homeTitle">fans</div>
        <?php echo $this->Html->image('home/fans.png', array('style' => 'width: 200px; height: 150px', 'class' => 'imageBorder')); ?>
        <div class="description">Explore and share great new music; promote your favorite bands</div>
    </div>

    <div style="display: table-cell; width: 200px;">
        <div class="homeTitle">bluetube</div>
        <?php echo $this->Html->image('home/bluetube.png', array('style' => 'width: 200px; height: 150px', 'class' => 'imageBorder')); ?>
        <div class="description">Upload and share your videos – anything (music) goes!</div>
    </div>
</div>
<table class="transparent" cellspacing="6px" style="margin-top: 24px;">
    <tr>
        <td style="width: 185px; color: white; text-align: center;">
            <div>
                <?php
                echo $this->Html->image('home/home_small.jpg'
                        , array('url' => '/', 'class' => 'imageBorder', 'style' => 'width: 182px; height: 182px'));
                ?>
            </div>
            back to home

            <div style="margin-top: 24px;">
                <?php
                echo $this->Html->image('home/getFound.png'
                        , array('class' => 'imageBorder', 'style' => 'width: 182px; height: 182px;  margin-bottom: 6px;'));
                ?>
                Got the right sound? Get Found!
            </div>

        </td>
        <td style="width: 400px;">
            <div style="font-weight: bold; text-align: center; height: 406px; width: 100%" class="ribbon">
                featured Band
                <?php
                echo $this->element('featuredBand');
                ?>
            </div>
        </td>
        <td>
            <div id="tabs" style="height: 400px; background: none; border: 1px solid white;">
                <ul>
                    <li><a href="#tabs-1">news</a></li>
                    <li><a href="#tabs-2">blog</a></li>
                    <li><a href="#tabs-3">friends</a></li>
                </ul>
                <div id="tabs-1" style="border: 1px solid white; height: 344px;">
                    <?php
                    echo $this->element('news');
                    ?>
                </div>
                <div id="tabs-2" style="border: 1px solid white; height: 344px;">
                    <?php
                    echo $this->element('blog');
                    ?>
                </div>
                <div id="tabs-3" style="border: 1px solid white; height: 344px;">
                </div>
            </div>
        </td>
    </tr>
</table>
