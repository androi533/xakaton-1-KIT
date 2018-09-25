$(function() {
	"use strict";
	
	$('.dragfile').on('dragover', function(){
		$(this).addClass('dragfileover');
		$(this).find('div').removeClass('hidden');
		return false;
	});

	$('.dragfile').on('dragleave', function(){
		$(this).removeClass('dragfileover');
		$(this).find('div').addClass('hidden');
		return false;
	});

	$('.dragfile').on('drop', function(e){
		e.preventDefault();

		$(this).removeClass('dragfileover');
		var formdata = new FormData();
		var multiple = e.originalEvent.dataTransfer.files;
		for (var i=0;i<multiple.length; i++) {
			formdata.append('file[]', multiple[i]);
		}
			$.ajax({
				url: '../tmpl/upload.php',
				method:'post',
				data: formdata,
				contentType: false,
				cache: false,
				processData: false,
				success:function(loader){
					$("#fototoload").html(loader);
				}
			});
	});

	$('.dragfile2').on('dragover', function(){
		$(this).addClass('dragfileover');
		return false;
	});

	$('.dragfile2').on('dragleave', function(){
		$(this).removeClass('dragfileover');
		return false;
	});

	$('.dragfile2').on('drop', function(e){
		e.preventDefault();

		$(this).removeClass('dragfileover');
		var formdata = new FormData();
		var multiple = e.originalEvent.dataTransfer.files;
		for (var i=0;i<multiple.length; i++) {
			formdata.append('file[]', multiple[i]);
		}
		formdata.append('type', 'back');
			$.ajax({
				url: '../tmpl/upload.php',
				method:'post',
				data: formdata,
				contentType: false,
				cache: false,
				processData: false,
				success:function(loader){
					$("#fototoload").html(loader);
				}
			});
	});
});