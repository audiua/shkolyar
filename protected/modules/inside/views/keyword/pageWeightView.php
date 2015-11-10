<h1>Manage in/out <?= CHtml::link($this->createAbsoluteUrl($model->url), $this->createUrl($model->url)); ?></h1>


<p>In (<?= count($linksIn); ?>)</p>
<?php foreach($linksIn as $one){
    echo CHtml::link($this->createAbsoluteUrl($one->url), $this->createUrl($one->url));
    echo '<br>';
} ?>

<p>Out (<?= count($linksOut); ?>)</p>

<?php foreach($linksOut as $one){
 echo CHtml::link($this->createAbsoluteUrl($one->url), $this->createUrl($one->url));
 echo '<br>';
} ?>