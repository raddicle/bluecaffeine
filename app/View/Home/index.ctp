<style>
    .homeTitle{
        color: white;
        font-weight: bold;
    }

    .description{
        color: white;
    }
</style>

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

<div style="display: table; text-align: center; width: 100%; margin-top: 20px; ">
    <div style="display: table-cell; width: 200px; padding: 6px; vertical-align: top; font-weight: bold;">
        <div class="ribbon" style="width: 100%; padding: 6px;">
            back to home
            <div>
                <?php
                echo $this->Html->image('home/home_small.jpg'
                        , array('url' => '/', 'class' => 'imageBorder', 'style' => 'width: 100%;'));
                ?>
            </div>

            <div>
                <?php
                echo $this->Html->image('home/getFound.png'
                        , array('class' => 'imageBorder', 'style' => 'width: 100%;'));
                ?>
            </div>
        </div>
    </div>
    <div style="display: table-cell;">
        <div style="font-weight: bold; width: 95%; padding: 6px 0 6px 0; margin: 6px;" class="ribbon">
            featured
            <?php
            echo $this->element('featuredBand');
            ?>
        </div>
    </div>
    <div style="padding: 6px; display: table-cell; width: 300px; vertical-align: top;">
        <div style="width: 100%;">
            <div class="ribbon" style="width:100%; padding: 6px;">
                <?php
                echo $this->element('blog');
                ?>
            </div>
        </div>
    </div>
</div>