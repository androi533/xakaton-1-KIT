;!(function ($) {
    $.fn.classes = function (callback) {
        var classes = [];
        $.each(this, function (i, v) {
            var splitClassName = v.className.split(/\s+/);
            for (var j = 0; j < splitClassName.length; j++) {
                var className = splitClassName[j];
                if (-1 === classes.indexOf(className)) {
                    classes.push(className);
                }
            }
        });
        if ('function' === typeof callback) {
            for (var i in classes) {
                callback(classes[i]);
            }
        }
        return classes;
    };
})(jQuery);

$(function() {
	"use strict";
	var timerId, div;

	$(document).on("mousedown", "body", function(e){
		if ($('div').hasClass('helpenterfield')) {
			div = $('.helpenterfield');
			if (div.is(e.target) || div.has(e.target).length > 0) {

			} else {
				$('.helpenterfield').remove();
			}
		}
	});

	$(document).on("mousedown", ".showwindow", function(e){
		$.ajax({
			url: "tmpl/obrabotka.php",
			type:"post",
			data: {
				show: $(this).find('.hidden').text()
			},
			success:function(loader){
				$('body').append(loader);
			}
		});
	});

	$(document).on("keyup", ".helpenter", function(e){
		var object;
		object = $(this);

		clearTimeout(timerId);
		timerId = setTimeout(send, 1543);

		
		function send() {
			$.ajax({
				url: "tmpl/obrabotka.php",
				type:"post",
				data: {
					helpenter: "enter", 
					val: $(object).val(),
					name: $(object).attr('name')
				},
				success:function(loader){
					$('.helpenterfield').remove();
					$(object).parent().parent().after(loader);					
				}
			});
		}
	});
	
	$(document).on("mousedown", ".helpenterchoise", function(e){
		var obj;
		obj = $(this).find('.name').text();
		$.ajax({
			url: "tmpl/obrabotka.php",
			type:"post",
			data: {
				helpenter: "choise", 
				val: $(this).find('.val').text(),
				name: $(this).find('.name').text()
			},
			success:function(loader){ 
				$('.helpenterfield').remove();
				$('.helpenter[name="'+obj+'"]').val(loader);
				//$(object).parent().parent().after(loader);					
			}
		});
	});
});