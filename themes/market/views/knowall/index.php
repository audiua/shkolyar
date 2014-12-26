<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<div class="info">Всезнайка</div> 
<p class="description">
&nbsp;&nbsp;&nbsp;&nbsp;Розділ <?php echo CHtml::link('Всезнайка',array('/knowall')); ?>, буде корисний для тих кого цікавить усе навкруги: утворення планети, наша галактика, рекорди Гіннеса, людські можливости, цікаві факти. Тут зібранно безліч цікавих матеріалів, які допоможуть Вам розширити свій кругозір та відповісти на питання Що? Чому? Як? Коли?. Також ви знайдите, в цьому розділі, багато корисних порад з моди, краси, спорту, кулінарії та різних видів хоббі, які ви зможите використовувати у свому повсякденному житті.
</p>

<?php $this->widget('DataArticleWidget', array('model'=>$model)); ?>