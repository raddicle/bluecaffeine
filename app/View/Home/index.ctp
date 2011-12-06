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

<div style="display: table; text-align: center; border: 1px solid black; width: 100%; margin-top: 20px;">

    <div style="display: table-cell; padding-right: 20px; width: 200px;">
        <?php
        echo $this->element('adv');
        ?>
    </div>
    <div style="display: table-cell; padding-right: 20px;">
        <div>
            featured
        </div>
        <?php
        echo $this->element('featuredBand');
        ?>
    </div>
    <div style="display: table-cell; width: 200px;">
        <?php
        echo $this->element('blog');
        ?>
    </div>
</div>