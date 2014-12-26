<div class="header">


	<nav class="navbar navbar-default navbar-static-top " role="navigation">
	  <div class="container">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <?php echo CHtml::link('Inside', '/inside/admin', array('class'=>'navbar-brand')); ?>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class="<?php echo $this->id == 'clas' ? 'active' : '' ; ?>"><?php echo CHtml::link('Класи', '/inside/clas/'); ?></li>
			<li class="<?php echo $this->id == 'subject' ? 'active' : '' ; ?>"><?php echo CHtml::link('Предмети', '/inside/subject/'); ?></li>
			
	        <li class="dropdown <?php echo stripos($this->id, 'gdz') !== false ? 'active' : '' ; ?>">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Гдз <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li> <?php echo CHtml::link('Класи', '/inside/gdzClas'); ?></li>
	            <li class="divider"></li>
	            <li> <?php echo CHtml::link('Предмети', '/inside/gdzSubject'); ?></li>
	            <li class="divider"></li>
	            <li> <?php echo CHtml::link('Збiрники', '/inside/gdzBook'); ?></li>
	          </ul>
	        </li>

	        <li class="dropdown <?php echo stripos($this->id, 'textbook') !== false ? 'active' : '' ; ?>">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Пiдручники <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li> <?php echo CHtml::link('Класи', '/inside/textbookClas'); ?></li>
	            <li class="divider"></li>
	            <li> <?php echo CHtml::link('Предмети', '/inside/textbookSubject'); ?></li>
	            <li class="divider"></li>
	            <li> <?php echo CHtml::link('Пiдручники', '/inside/textbookBook'); ?></li>
	          </ul>
	        </li>

	        <li class="dropdown <?php echo stripos($this->id, 'knowall') !== false ? 'active' : '' ; ?>">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Всезнайка <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li> <?php echo CHtml::link('Статьи', '/inside/knowall'); ?></li>
	            <li class="divider"></li>
	            <li> <?php echo CHtml::link('Категории', '/inside/knowallCategory'); ?></li>
	          </ul>
	        </li>

	        <li class="dropdown <?php echo stripos($this->id, 'library') !== false ? 'active' : '' ; ?>">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Худ-лiт <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li> <?php echo CHtml::link('Твори', '/inside/libraryBook'); ?></li>
	            <li class="divider"></li>
	            <li> <?php echo CHtml::link('Автори', '/inside/libraryAuthor'); ?></li>
	          </ul>
	        </li>
			
			
			<li class="<?php echo $this->id == 'writing' ? 'active' : '' ; ?>"><?php echo CHtml::link('Твори', '/inside/writing'); ?></li>
	      
	      </ul>
	     
	      <ul class="nav navbar-nav navbar-right">
	        <!-- <li><a href="#">Link</a></li> -->
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Yii::app()->user->role; ?> <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><?php echo CHtml::link('Сайт', '/',array('target'=>'_blanck')); ?></li>
	            <li class="divider"></li>
	            <li><?php echo CHtml::link('Выйти', '/site/logout'); ?></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
</div>