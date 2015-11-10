<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <base href="<?php  echo Yii::app()->createAbsoluteUrl('/'); ?>">

        <meta name="description" content="<?php echo CHtml::encode($this->description); ?>" />
        <meta name="keywords" content="<?php echo CHtml::encode($this->keywords); ?>" />

        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css">
        <!-- <link rel="stylesheet" href="/css/social-likes_flat.css"> -->

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php 
            $cs=Yii::app()->clientScript;
            $cs->registerCoreScript('jquery'); 
        ?>

        <?php 
            $path = Yii::app()->theme->basePath;
            $mainAssets = Yii::app()->AssetManager->publish($path);
            // Yii::app()->getClientScript()->registerScriptFile($mainAssets.'/js/jquery.cookie.js', CClientScript::POS_END);
            Yii::app()->getClientScript()->registerScriptFile($mainAssets.'/js/bootstrap.min.js', CClientScript::POS_END);
            Yii::app()->getClientScript()->registerScriptFile($mainAssets.'/js/base64.js', CClientScript::POS_END);
            Yii::app()->getClientScript()->registerScriptFile($mainAssets.'/js/app.js', CClientScript::POS_END);
            Yii::app()->getClientScript()->registerScriptFile($mainAssets.'/js/social-likes.min.js', CClientScript::POS_END);
         ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        
        <div class="container">
            <div class="row">
                <?php $this->renderPartial('//layouts/header'); ?>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?= $content; ?>
                </div>
            </div>
            <div class="row">
                <?php $this->renderPartial('//layouts/footer'); ?>
            </div>
        </div>
    </body>
</html>
