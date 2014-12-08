<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo CHtml::encode($this->description); ?>" />
        <meta name="keywords" content="<?php echo CHtml::encode($this->keywords); ?>" />
        <base href="<?php  echo Yii::app()->createAbsoluteUrl('/'); ?>">
        <link rel="canonical" href="<?php echo $this->canonical; ?>">

        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap3.2.0.min.css">
        <link rel="stylesheet/less" type="text/css" href="<?php  echo Yii::app()->theme->baseUrl; ?>/less/app.less" />
        <!-- <link href='http://fonts.googleapis.com/css?family=Cabin+Sketch:700,400' rel='stylesheet' type='text/css'> -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font" rel='stylesheet' type='text/css'>
        
        <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery1.11.1.min.js"></script>
        <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.7.3/less.min.js"></script> -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/less.js"></script>
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap3.2.0.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/app.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/panzoom.js"></script>
       
        <title>
            <?php echo CHtml::encode($this->pageTitle); ?>
        </title>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body>

        <div class="wrap">

            <div class="header">
                <?php $this->renderPartial('//layouts/header'); ?>
            </div>

           <!--  <div class="black"></div>
            <div class="red"></div>
            <div class="black"></div> -->

            <div class="content">
               
                
                <?php echo $content; ?>
            </div>
            <div class="sidebar">
                <?php $this->renderPartial('//layouts/sidebar'); ?>
            </div>
            <div class="clear"></div>

            <div class="footer">
                <div class="black"></div>
                <div class="red"></div>
                <div class="black"></div>
                <?php $this->renderPartial('//layouts/footer'); ?>
            </div>

        </div>


    </body>
</html>