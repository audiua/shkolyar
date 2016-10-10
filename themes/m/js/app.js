$(document).ajaxSend(function(event, request, settings) {

	$('.task-title').show();
	$('.task-separator').show();
	$('#inverted-contain').show();
    
    $('body,html').animate({scrollTop:480},200);
    // $('body,html').animate({scrollTop:0},200);
});

$(document).ajaxComplete(function(event, request, settings) {
    
	var contHeight = $('.content').outerHeight();
	var sidebarHeight = $('.sidebar').outerHeight();
	// console.log('resize');
	// console.log(sidebarHeight);
	if(contHeight > sidebarHeight){
		$('.sidebar').height(contHeight);
	}
	
   
});


$(document).ready(function () {

	$('.darking').click(function(){
		$(this).hide();
		$('.loading').hide();
	});

	$('.loading').hide();
    $('.darking').hide();


	//--------------------------------------
	// scroll to top page
	$(window).scroll(function() {
	 
		if($(this).scrollTop() != 0) {
			$('#toTop').fadeIn();
		} else {
			$('#toTop').fadeOut();
		}
	});
 
	$('#toTop').click(function() {
		$('body,html').animate({scrollTop:0},100);
	});



	var clas = $('.clas-active').find('a').text();
	var clasActive = '.clas-active-'+clas;

	var author=$('.task').find('span.author').data('author');
	var title=$('.task').find('span.title').data('title');

	// вешаем handler на все заданияна странице
	$('.task-number').each(function(i,val){
		$(val).on('click',{'numb':$(val).data('url'), 'parent':val}, getTask);
	});
	$('.task').hide();

	// function imgLoaded(img){
	// 	var img = $(img);
	// 	console.log(img);
	// }

	// on('click',{'numb':this.text()},getTask);

	/**
	 * загрузка аяксом картинки задания
	 * @param  obj e обьект задани
	 */
	function getTask(e){

		var numb= e.data.numb;
		var parent = e.data.parent;

		// определяем урл задания
		var fullUrl = location.href;
		if(fullUrl.indexOf('#') != -1){
			var url = fullUrl.replace(/#.*/i,'') + '/'+numb;
		} else {
			var url = location.href + '/'+numb;
		}

		$.ajax({
		  	type: "post",
		 	url: url,
		  	data: {'mode': ''},
		  	dataType: "html",
	  	    beforeSend: function( xhr ) {
			    // xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
			    $('.task').show();
		  		$('.loading').show();
    			$('.darking').show();
			},
		  	success: function(reponse){
		  		$('.task').show().html('<div class="title">Розв’язання: №'+numb+'</div><div class="separator"></div>'+reponse);
		  	
		  		$('.loading').hide();
    			$('.darking').hide();

			  	// красим в цвет класса
			  		$('.task-one').filter('.task-active').each(function(){
			  			$(this).removeClass('task-active')
				  		.find('p').removeClass('bold');
			  		});
			  			
			  		
			  		$(parent)
				  		.parents('.task-one')
				  		.addClass('task-active')
				  		.find('p')
				  		.addClass('bold');


		  	}

		});

		
	}


	$('.b-left').click(function(){
		var activeTask = $('.task-one').filter('.task-active');
		var prevTask = $(activeTask).prev('.task-one');
		if(activeTask && prevTask){
			$(prevTask).find('.task-number').click();
		}
	});

	$('.b-right').click(function(){
		var activeTask = $('.task-one').filter('.task-active');
		var nextTask = $(activeTask).next('.task-one');
		if(activeTask && nextTask){
			$(nextTask).find('.task-number').click();
		}
	});



	// disabled padination buttons
	$('.yiiPager').find('.disabled').each(function(){
		$(this).find('a').click(function(e){
			e.preventDefault();
		});
	});


	$('[data-url=1]').click();


	function linksUp() {
		$('a[data-key]').each(function(i,v){
			$(this).attr('href', Base64.decode($(this).attr('data-key')));
		});
	}

	linksUp();


});
