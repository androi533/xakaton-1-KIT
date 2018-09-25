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
	var objs = ['#loginzone', '#logob', '#windowToForm'];
	var objs2 = ['#windowForm'];
	//var user = $.cookie('user_id');
	//if (cook.indexOf('page=dialogs') != -1) { 
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {menu_link: $.cookie('page'), user: $.cookie('id_user'), market: $.cookie('market'), id_project: $.cookie('id_project'), pagename: $.cookie('pagename') },
			success:function(loader){
				$("#wrapper").html(loader);
				$('#loginzone').addClass('hidden');
			}
		});

		if ( $.cookie('id_zayavki') > 0 ) {
			$.ajax({
				url: "../tmpl/obrabotka.php",
				type:"post",
				data: {menu_link: 'id_zayavki', id_zayavki: $.cookie('id_zayavki')},
				success:function(loader){
					//alert(loader);
					$('#windowToForm .obolochka .centredv').html(loader);	
					$('#windowToForm').removeClass('hidden');
				}
			}); 
		}

		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {menu_link: $.cookie('inpage'), user: $.cookie('id_user'), market: $.cookie('market'), numproj: $.cookie('id_project'), pagename: $.cookie('pagename'), id_card: $.cookie('id_card') },
			success:function(loader){
				$('.voronkaview').addClass('hidden');
				$('.site_view').addClass('hidden');
				if ( $.cookie('inpage') == '.site_view') {
					$('.voronka').text('АВТОВОРОНКА ПРОДАЖ');
				} else {
					$('.voronka').text('СТРАНИЦА САЙТА');
				}
				
				$($.cookie('inpage')).html(loader);
				$($.cookie('inpage')).removeClass('hidden');
				//alert($.cookie('user_id')+' '+$.cookie('inpage')+' '+$.cookie('pagename'))
			}
		});

		if ($.cookie('inpage') == 'card') {
			$.ajax({
				url: "../tmpl/obrabotka.php",
				type:"post",
				data: {menu_link: $.cookie('inpage'), id_card: $.cookie('id_card'), numproj: $.cookie('id_project') },
				success:function(loader){
					$('#windowToFormChecker .obolochka .centredv').html(loader);
					$('#windowToFormChecker').removeClass('hidden');
				}
			});
		}
	//}

	$(document).on("mousedown", "body", function(e){
		
		var div, target, bool, close;
		target = e.target;
		close = false;
		if (e.which == 1) {
			div = $('body .daterangepicker')
			if (div.is(e.target) || div.has(e.target).length > 0) { // или по его дочерним элементам
				//alert('Календарь');
			} else {
				//e.preventDefault();
				if (!$('#windowForm').hasClass('hidden')) {
					bool = false;
					for (var i = objs2.length - 1; i >= 0; i--) {
						div = $(objs2[i]);
						if (div.is(e.target) // если клик был по нашему блоку
						|| div.has(e.target).length > 0) { // или по его дочерним элементам
							if ($(target).hasClass('closemenu')) {
								div.addClass('hidden');
							} else {
								bool = true;
							}
						}
					}
					if (bool) {
						if ($(target).find('.innerform').length>0) {
							for (var i = objs2.length - 1; i >= 0; i--) {
								div = $(objs2[i]);
								if ( (!div.hasClass('hidden')) && (div.hasClass('window')) ) {
									div.addClass('hidden');
								}
							}
						}
					} else {
						for (var i = objs2.length - 1; i >= 0; i--) {
							div = $(objs2[i]);
							if ( (!div.hasClass('hidden')) && (div.hasClass('window')) ) {
								div.addClass('hidden');
							}
						}
					}
				} else {
					bool = false;
					for (var i = objs.length - 1; i >= 0; i--) {
						div = $(objs[i]);
						if (div.is(e.target) // если клик был по нашему блоку
						|| div.has(e.target).length > 0) { // или по его дочерним элементам
							if ($(target).hasClass('closemenu')) {
								div.addClass('hidden');
								close = true;
							} else {
								bool = true;
							}
						}
					}
					if (bool) {
						if ($(target).find('.promo').length>0) {
							for (var i = objs.length - 1; i >= 0; i--) {
								div = $(objs[i]);
								if ( (!div.hasClass('hidden')) && (div.hasClass('window')) ) {
									div.addClass('hidden');
									close = true;
								}
							}
						}
					} else {
						for (var i = objs.length - 1; i >= 0; i--) {
							div = $(objs[i]);
							if ( (!div.hasClass('hidden')) && (div.hasClass('window')) ) {
								div.addClass('hidden');
								close = true;
							}
						}
					}

					if (close) {
						if ( $.cookie('id_zayavki') > 0 ) {
							
							$.ajax({
								url: "../tmpl/obrabotka.php",
								type:"post",
								data: {
									unlock: "lock", id_zayavki: $.cookie('id_zayavki'), potreb: $('#potreb').val(), dataclient: $('#dataclient').val()
								},
								success:function(loader){
									//$.cookie('id_zayavki', null); //В другой момент закрывать заявку
									$('#wrapper').html(loader);
								}
							});
						}
					}
				}
			}
		}
	});

	$(document).on("click", ".closecard", function(e){
		if (e.which == 1) {
			$.ajax({
				url: "../tmpl/obrabotka.php",
				type:"post",
				data: {
					unlock: "close", 
					select_status: $(this).parent().parent().find('.select_status').val(),
					comment: $(this).parent().parent().find('.comment').val(),
					id_zayavki: $.cookie('id_zayavki')
				},
				success:function(loader){
					$('#wrapper').html(loader);
					$.cookie('id_zayavki', null);
				}
			});
		}
	});

	$(document).on("click", "#welcome", function(e){
		e.preventDefault();
		$.cookie('page', 'welcome');
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {menu_link: "welcome" },
			success:function(loader){
				$("#wrapper").html(loader);
				$('#loginzone').addClass('hidden');
			}
		});
	});

	$(document).on("click", ".sendstep", function(e){
		e.preventDefault();
		var id, val;
		id = this.id;
		val = $('#sendvalue').val();
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {sendname: this.id, sendvalue: $('#sendvalue').val() },
			success:function(loader){
				if (id == 'projectname') {
					if (loader.length < 512) {
						document.location.href = loader;
					} else {
						$("#wrapper").html(loader);
						$('#loginzone').addClass('hidden');
					}
				} else {
					$("#wrapper").html(loader);
					$('#loginzone').addClass('hidden');
				}
			}
		});
	});

	$(document).on("click", "#start", function(e){
		e.preventDefault();
		$.cookie('page', 'start');		
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {menu_link: "start", user: $.cookie('id_user') },
			success:function(loader){
				$("#wrapper").html(loader);
				$('#loginzone').addClass('hidden');
			}
		});
	});

	$(document).on("click", "#next", function(e){
		e.preventDefault();
		$.cookie('page', 'next');
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {menu_link: "next", user: $.cookie('id_user') },
			success:function(loader){
				$("#wrapper").html(loader);
				$('#loginzone').addClass('hidden');
			}
		});
	});

	$(document).on("click", "#acc", function(e){
		e.preventDefault();
		$.cookie('page', 'acc');
		$.cookie('inpage', null);
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {menu_link: "acc", user: $.cookie('id_user'), numproj: $.cookie('id_project') },
			success:function(loader){
				$("#wrapper").html(loader);
				$('#loginzone').addClass('hidden');
			}
		});
	});

	$(document).on("click", "#addkey", function(e){
		e.preventDefault();
		var value;
		value =  $('input[name=addkey]').val();
		if (value == '') {
			value = 'empty';
		}
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {yad: "addkey", val: value},
			success:function(loader){
				$("#wrapper").html(loader);
				$('#loginzone').addClass('hidden');
			}
		});
	});

	$(document).on("click", "#mark", function(e){
		e.preventDefault();
		$.cookie('page', 'addkey');
		$.cookie('inpage', null);
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {menu_link: "addkey"},
			success:function(loader){
				$("#wrapper").html(loader);
				$('#loginzone').addClass('hidden');
			}
		});
	});

	$(document).on("click", "#otchet", function(e){
		e.preventDefault();
		$.cookie('page', 'otchet');
		$.cookie('inpage', null);
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {menu_link: "otchet" },
			success:function(loader){
				$("#wrapper").html(loader);
				$('#loginzone').addClass('hidden');
			}
		});
	});

	$(document).on("click", "#delegirovanie", function(e){
		e.preventDefault();
		$.cookie('page', 'delegirovanie');
		$.cookie('inpage', null);
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {menu_link: "delegirovanie" },
			success:function(loader){
				$("#wrapper").html(loader);
				$('#loginzone').addClass('hidden');
			}
		});
	});

	$(document).on("click", "#zayavki", function(e){
		e.preventDefault();
		$.cookie('page', 'zayavki');
		$.cookie('inpage', null);
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {menu_link: "zayavki", numproj: $.cookie('id_project') },
			success:function(loader){
				$("#wrapper").html(loader);
				$('#loginzone').addClass('hidden');
			}
		});
	});

	$(document).on("click", "#sait", function(e){
		e.preventDefault();
		$.cookie('page', 'sait');
		$.cookie('inpage', '.site_view');
		$.cookie('pagename', 'index');
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {menu_link: 'sait', market: $.cookie('market'), numproj: $.cookie('id_project'), pagename: $.cookie('pagename') },
			success:function(loader) {
				$('#wrapper').html(loader);
				$('#loginzone').addClass('hidden');
				$('.site_view').removeClass('hidden');
				$('.voronkaview').addClass('hidden');	
				//console.log($.cookie('market')+' N '+$.cookie('id_project')+' P '+$.cookie('pagename'));
			}
		});
	});

	$(document).on("click", "#bonus", function(e){
		e.preventDefault();
		$.cookie('page', 'bonus');
		$.cookie('inpage', null);
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {menu_link: "bonus" },
			success:function(loader){
				$("#wrapper").html(loader);
				$('#loginzone').addClass('hidden');
			}
		});
	});

	$(document).on("click", "#pay", function(e){
		e.preventDefault();
		$.cookie('page', 'pay');
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {menu_link: "pay", user: $.cookie('id_user') },
			success:function(loader){
				$("#wrapper").html(loader);
				$('#loginzone').addClass('hidden');
			}
		});
	});

	$(document).on("click", "#exitB", function(e){
		e.preventDefault();
		$.cookie('id_user', null);
		$.cookie('page', null);
		$.cookie('inpage', null);
		$.cookie('pagename', null);
		$.cookie('market', null);
		$.cookie('id_project', null);

		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {exit: "true" },
			success:function(loader){
				window.location.href = "CRM3.php";
				//$('#wrapper').html(loader);
			}
		});
	});

	$(document).on("click", ".voronka", function(e){
		e.preventDefault();
		if ($('.voronkaview').hasClass('hidden')) {
			$(this).text('СТРАНИЦА САЙТА');
			$.cookie('inpage', '.voronkaview');
			//$.cookie('siteproj', $(this).find('.siteproj').text());
			//alert($.cookie('siteproj'));
			$.cookie('pagename', 'index');
			$.ajax({
				url: "../tmpl/obrabotka.php",
				type:"post",
				data: {menu_link: ".voronkaview", market: $.cookie('market'), numproj: $.cookie('id_project'), pagename: $.cookie('pagename') },
				success:function(loader){
					$(".voronkaview").html(loader);
					$('.voronkaview').removeClass('hidden');
					$('.site_view').addClass('hidden');
					$('.voronkaright').animate({ scrollTop: $('#laststepscroll').offset().top }, 500);
				}
			});
		} else {
			$.cookie('inpage', '.site_view');
			$(this).text('АВТОВОРОНКА ПРОДАЖ');
			$('.voronkaview').addClass('hidden');
			$('.site_view').removeClass('hidden');
		}
	});

	$(document).on('click', '.projbutton', function(e){
		e.preventDefault();
		if($.cookie('market') == $(this).find('.market').text()){
			$.cookie('market', $(this).find('.market').text());
			$.cookie('id_project', $(this).find('.numproj').text());
			$.cookie('pagename', 'index');
			$.ajax({
				url: '../tmpl/obrabotka.php',
				type:'post',
				data: {crmchange: 'csite', market: $.cookie('market'), numproj: $.cookie('id_project'), pagename: $.cookie('pagename') },
				success:function(loader) {
					$('#wrapper').html(loader);			
				}
			});
		}else{
			$.cookie('market', $(this).find('.market').text());
			$.ajax({
				url: '../tmpl/obrabotka.php',
				type:'post',
				data: {crmchange: 'nsite', market: $.cookie('market') },
				success:function(loader) {
					$('#wrapper').html(loader);			
				}
			});
			document.location.replace ("https://directolog-plus.ru/"+$.cookie('market')+"/CRM3.php");
		}
		
	});

	$(document).on('click', '.loadsite', function(e){
		e.preventDefault();
		$.cookie('inpage', '.site_view');
		$.cookie('pagename', 'index');
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {crmchange: 'csite', market: $.cookie('market'), numproj: $.cookie('id_project'), pagename: $.cookie('pagename') },
			success:function(loader) {
				$('#wrapper').html(loader);
				$('.site_view').removeClass('hidden');
				$('.voronkaview').addClass('hidden');
			}
		});
	});

	/*$(document).on('click', '.marketnew', function(e){
		e.preventDefault();
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {openwindow: 'addsite'},
			success:function(loader) {
				$('#windowForm .innerform').html(loader);	
				$('#windowForm').removeClass('hidden');	
			}
		});
	});

	$(document).on('click', '.pagenamenew', function(e){
		e.preventDefault();
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {openwindow: 'addpage', market: $.cookie('market'), numproj: $.cookie('id_project')},
			success:function(loader) {
				$('#windowForm .innerform').html(loader);	
				$('#windowForm').removeClass('hidden');	
			}
		});
	});*/

	/*$(document).on('click', '#addpage', function(e){
		e.preventDefault();
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {newobj: 'addpage', market: $.cookie('market'), numproj: $.cookie('id_project'), val: $('#iname').val() },
			success:function(loader) {
				$('#windowForm').addClass('hidden');
				alert(loader);
			}
		});
	});*/

	/*$(document).on('click', '#addsite', function(e){
		e.preventDefault();
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {newobj: 'addsite', val: $('#iname').val()},
			success:function(loader) {
				$('#windowForm').addClass('hidden');
				alert(loader);
			}
		});
	});*/

	$(document).on('click', '.pagebutton', function(e){
		e.preventDefault();
		$.cookie('market', $(this).find('.market').text());
		$.cookie('id_project', $(this).find('.numproj').text());
		$.cookie('pagename', $(this).find('.pagename').text());
		$.cookie('inpage', '.site_view');
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {crmchange: 'cpage', market: $.cookie('market'), numproj: $.cookie('id_project'), pagename: $.cookie('pagename') },
			success:function(loader) {
				$('#wrapper').html(loader);			
			}
		});
	});

//ОТПРАВКА ФОРМЫ С ОПРЕДЕЛЕННЫМИ ДАННЫМИ В АККАУНТЕ
	$(document).on('click', '.senddata', function(e){
		e.preventDefault();
		var value, arr, ar;
		var cook = new Object();
		var cook2 = new Object();
		var cook3 = new Object();
		if ($(".promo").parent().parent().hasClass('window')) {
			if ($(".promo div").hasClass('hidden')) {
				arr = $(".promo div .hidden").classes();
				for (var i = 0; i < arr.length; i++) {
					if (arr[i] != 'hidden') {
						cook3[arr[i]] = $(".promo div .hidden").text();
					}
				}
			}
			var data3=JSON.stringify(cook3);
		} else {
			arr = $(".promo").parent().parent().parent();
			$.each(arr, function() {
				if ($(this).hasClass('window')) {
					ar = $(this).find('div .hidden').classes();
					for (var i = 0; i < ar.length; i++) {
						if (ar[i] != 'hidden') {
							cook3[ar[i]] = $(this).find('.'+ar[i]).text();
						}
					}

					$(this).find("textarea,input,select").each( function() {
						if (this.id == null) {
							alert('НАРУШЕНА ЦЕЛОСТНОСТЬ СТРАНИЦЫ!');
						} else {
							value = $(this).val();
							if (value == '') {
								value = 'empty';
							}
							cook2[this.id] = value;
						}
					});
				}
			});
			var data3=JSON.stringify(cook3);

			var data=JSON.stringify(cook2);
		}

		if ($.cookie('id_project') != null) {
			cook['id_project'] = $.cookie('id_project');
		}
		if ($.cookie('pagename') != null) {
			cook['pagename'] = $.cookie('pagename');
		}
		if ($.cookie('id_user') != null) {
			cook['id_user'] = $.cookie('id_user');
		}
		if ($.cookie('market') != null) {
			cook['market'] = $.cookie('market');
		}
		if ($.cookie('inpage') != null) {
			cook['inpage'] = $.cookie('inpage');
		}
		if ($.cookie('page') != null) {
			cook['page'] = $.cookie('page');
		}
		var data2=JSON.stringify(cook);

		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {crmchange: this.id, val: data, cooki: data2, hidden: data3 },
			success:function(loader){
				//alert(loader);
				//Тут бы как нибудь обработать новую (добавленную) страницу и сайт
				$('#wrapper').html(loader);
				$('#windowToForm').addClass('hidden');
			}
		});
	});	

//ОТПРАВКА ФОРМЫ С ОПРЕДЕЛЕННЫМИ ДАННЫМИ В АККАУНТЕ
	$(document).on('click', '.senddatac', function(e){
		e.preventDefault();
		var value, arr;
		var cook = new Object();
		var cook2 = new Object();
		var cook3 = new Object();


			arr = $(this).parent().parent().find('.hidden').classes();
			for (var i = 0; i < arr.length; i++) {
				if (arr[i] != 'hidden') {
					cook3[arr[i]] = $(this).parent().parent().find('.'+arr[i]).text();
				}
			}

		var data3=JSON.stringify(cook3);
		

		$('#windowForm .innerform .menuheight .data').find("textarea,input,select").each( function(e) {
			if (this.id == null) {
				alert('НАРУШЕНА ЦЕЛОСТНОСТЬ СТРАНИЦЫ!');
			} else {
				if ( $(this).attr('type') == 'checkbox' ) {
					if ($(this).is(':checked')){
						value = '1';
					} else {
					    value = '0';
					}
				} else {
					value = $(this).val();
					if (value == '') {
						value = 'empty';
					}
				}
				cook2[this.id] = value;
			}
		});
		var data=JSON.stringify(cook2);

		if ($.cookie('id_project') != null) {
			cook['id_project'] = $.cookie('id_project');
		}
		if ($.cookie('pagename') != null) {
			cook['pagename'] = $.cookie('pagename');
		}
		if ($.cookie('id_user') != null) {
			cook['id_user'] = $.cookie('id_user');
		}
		if ($.cookie('market') != null) {
			cook['market'] = $.cookie('market');
		}
		if ($.cookie('inpage') != null) {
			cook['inpage'] = $.cookie('inpage');
		}
		if ($.cookie('page') != null) {
			cook['page'] = $.cookie('page');
		}
		var data2=JSON.stringify(cook);

		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {crmchange: this.id, val: data, cooki: data2, hidden: data3 },
			success:function(loader){
				//alert(loader);
				$('#windowForm').addClass('hidden');
				$('#windowToForm .obolochka .centredv').html(loader);
			}
		});
	});	

//КЛИК ПО ПУНКТАМ МЕНЮ В УЛУЧШЕНИИ РЕКЛАМЫ
	$(document).on('click', '.cmm', function(e){
		e.preventDefault();
		$.cookie('page', $(this).find('.value').text()); //Здесь типа подстраницы в Улучшении рекламы: +Ключевой, Ключевые, Матрица //Чтобы при релоад стр оставаться на той же

		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {markmenu: $(this).find('.value').text() },
			success:function(loader){
				$('#wrapper').html(loader);	
			}
		});
	});

//КЛИК ПО КАЛЕНДАРЮ В ЗАЯВКАХ
	$(document).on('click', '.cz', function(e){
		e.preventDefault();
		$('.innerform').css({'left':e.pageX,'top':e.pageY});
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {openwindowx: $(this).find('.value').text(), id: $(this).find('.id').text() },
			success:function(loader){
				$('#windowForm .innerform').html(loader);	
				$('#windowForm').removeClass('hidden');
				jQuery(document).ready(function()
				{
					var drag = 0;
					var l, t, pos, cl, ct, dl, dt;
					jQuery('.movable').mousedown(function(event)
					{
						if (drag == 0) {
						 	drag = 1;

							cl = event.clientX;
							ct = event.clientY;

							pos = jQuery('.move').parent().position();
							l = parseInt(pos.left);
							t = parseInt(pos.top);
							
							dl = cl - l;
							dt = ct - t;
					
							//console.log(dl+' '+event.clientX+' '+event.pageX);
							//console.log(dt+' '+event.clientY+' '+event.pageY);
				        }

						jQuery('body').mouseup(function(event)
						{
							 drag = 0;
						});

						jQuery('body').mousemove(function(event)
						{
							
							if (drag == 1)
							{
								jQuery('.move').parent().css({'top':event.clientY - dt,'left':event.clientX - dl});
							}
						});
					});
				});
			}
		});
	});

//КЛИК ПО КНОПКАМ ПЛЮС НА ВЫБОР ТИПА РЕКЛАМЫ ДЛЯ КЛЮЧЕВОГО ЗАПРОСА
	$(document).on('click', '.ckc', function(e){
		e.preventDefault();
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {keywordchange: $(this).find('.type').text(), val: $(this).find('.value').text() },
			success:function(loader){
				alert(loader); //Изменить на цвет рамки
			}
		});
	});

//КЛИК ПО ПУНКТАМ МЕНЮ В КЛЮЧЕВЫХ ЗАПРОСАХ В УЛУЧШЕНИИ РЕКЛАМЫ
	$(document).on('click', '.ckzt', function(e){
		e.preventDefault();
		$.cookie('page', $(this).find('.value').text());
		//$.cookie('inpage', $(this).find('.value').text());

		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {markmenu: $(this).find('.value').text() },
			success:function(loader){
				$('#wrapper').html(loader);	
			}
		});
	});

//КЛИК ПО КНОПКАМ В КЛЮЧЕВЫХ ЗАПРОСАХ В УЛУЧШЕНИИ РЕКЛАМЫ
	$(document).on('click', '.cmmk', function(e){
		e.preventDefault();

		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {popup: $(this).find('.obolochka .centredv .value').text(), id_phrase: $(this).find('.obolochka .centredv .id').text() },
			success:function(loader){
				$('#windowToForm').removeClass('hidden');
				$('#windowToForm .obolochka .centredv').html(loader);	
			}
		});
	});

	$(document).on('click', '.closewtf', function(e){
		e.preventDefault();

		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {markmenu: $(this).find('.value').text() },
			success:function(loader){
				$('#windowToForm').addClass('hidden');
				$('#windowToForm .obolochka .centredv').html('');	
			}
		});
	});

//КЛИК ПО ЭЛЕМЕНТАМ ДАННЫЕ КОТОРЫХ НУЖНО ИЗМЕНИТЬ С ОТОБРАЖЕНИЕМ ФОРМЫ ДЛЯ ИЗМЕНЕНИЯ В АККАУНТЕ
	$(document).on('click', '.cacc', function(e){
		e.preventDefault();
		if ($(this).hasClass('unlock')) {
			$.cookie('id_zayavki', $(this).find('.id_zayavki').text());
			$.ajax({
				url: '../tmpl/obrabotka.php',
				type:'post',
				data: {unlock: "unlock", id_zayavki: $(this).find('.id_zayavki').text()},
				success:function(loader){
					$('#wrapper').html(loader);
				}
			});
		}
		if (!$(this).hasClass('disabled')) {
			var value, arr;
			var cook = new Object();
			var cook2 = new Object();
			var cook3 = new Object();

			if ($(this).find("div").hasClass('hidden')) {
				arr = $(this).find("div.hidden").classes();
				for (var i = 0; i < arr.length; i++) {
					if (arr[i] != 'hidden') {
						cook3[arr[i]] = $(this).find("div."+arr[i]).text();
					}
				}
			}
			var data3=JSON.stringify(cook3);

			if ($.cookie('id_project') != null) {
				cook['id_project'] = $.cookie('id_project');
			}
			if ($.cookie('pagename') != null) {
				cook['pagename'] = $.cookie('pagename');
			}
			if ($.cookie('id_user') != null) {
				cook['id_user'] = $.cookie('id_user');
			}
			if ($.cookie('market') != null) {
				cook['market'] = $.cookie('market');
			}
			if ($.cookie('inpage') != null) {
				cook['inpage'] = $.cookie('inpage');
			}
			if ($.cookie('page') != null) {
				cook['page'] = $.cookie('page');
			}
			var data2=JSON.stringify(cook);

			value = $(this).find('.value').text();
			cook2[this.id] = value;
			var data=JSON.stringify(cook2);
			$.ajax({
				url: '../tmpl/obrabotka.php',
				type:'post',
				data: {openwindow: $(this).find('.value').text(), hidden: data3, cooki: data2 },
				success:function(loader){
					$('#windowToForm .obolochka .centredv').html(loader);	
					$('#windowToForm').removeClass('hidden');
				}
			});
		}
	});

//КЛИК ПО ЭЛЕМЕНТАМ ДАННЫЕ КОТОРЫХ НУЖНО ИЗМЕНИТЬ С ОТОБРАЖЕНИЕМ ФОРМЫ ДЛЯ ИЗМЕНЕНИЯ В КАРТОЧКЕ
	$(document).on('click', '.ccacc', function(e){
		e.preventDefault();
		$('.innerform').css({'left':e.pageX,'top':e.pageY});

		var value, arr;
		var cook = new Object();
		var cook2 = new Object();
		var cook3 = new Object();

		if ($(this).find("div").hasClass('hidden')) {
			arr = $(this).find("div.hidden").classes();
			for (var i = 0; i < arr.length; i++) {
				if (arr[i] != 'hidden') {
					cook3[arr[i]] = $(this).find("div."+arr[i]).text();
				}
			}
		}
		if ($('#id_user').text() != '') cook3['id_user'] = $('#id_user').text();
		var data3=JSON.stringify(cook3);

		if ($.cookie('id_project') != null) {
			cook['id_project'] = $.cookie('id_project');
		}
		if ($.cookie('pagename') != null) {
			cook['pagename'] = $.cookie('pagename');
		}
		if ($.cookie('id_user') != null) {
			cook['id_user'] = $.cookie('id_user');
		}
		if ($.cookie('market') != null) {
			cook['market'] = $.cookie('market');
		}
		if ($.cookie('inpage') != null) {
			cook['inpage'] = $.cookie('inpage');
		}
		if ($.cookie('page') != null) {
			cook['page'] = $.cookie('page');
		}
		var data2=JSON.stringify(cook);

		value = $(this).find('.value').text();
		cook2[this.id] = value;
		var data=JSON.stringify(cook2);

		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {openwindow: $(this).find('.value').text(), hidden: data3, cooki: data2  },
			success:function(loader){
				$('#windowForm .innerform .menuheight').html(loader);	
				$('#windowForm').removeClass('hidden');
				jQuery(document).ready(function()
				{
					var drag = 0;
					var l, t, pos, cl, ct, dl, dt;
					jQuery('.movable').mousedown(function(event)
					{
						if (drag == 0) {
						 	drag = 1;

							cl = event.clientX;
							ct = event.clientY;

							pos = jQuery('.move').parent().position();
							l = parseInt(pos.left);
							t = parseInt(pos.top);
							
							dl = cl - l;
							dt = ct - t;
					
							//console.log(dl+' '+event.clientX+' '+event.pageX);
							//console.log(dt+' '+event.clientY+' '+event.pageY);
				        }

						jQuery('body').mouseup(function(event)
						{
							 drag = 0;
						});

						jQuery('body').mousemove(function(event)
						{
							
							if (drag == 1)
							{
								jQuery('.move').parent().css({'top':event.clientY - dt,'left':event.clientX - dl});
							}
						});
					});
				});
			}
		});
	} );

//КЛИК ПО ЭЛЕМЕНТАМ ДАННЫЕ КОТОРЫХ НУЖНО ИЗМЕНИТЬ С ОТОБРАЖЕНИЕМ ФОРМЫ ДЛЯ ИЗМЕНЕНИЯ НА САЙТЕ
	$(document).on('click', '.csite', function(e){
		e.preventDefault();
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {openwindow: $(this).find('.value').text(), pagename: $.cookie('pagename'), id: $(this).find('.id_form').text()},
			success:function(loader){
				$('#windowToForm .obolochka .centredv').html(loader);
				$('#windowToForm').removeClass('hidden');
			}
		});
	} );

//КЛИК ПО ЭЛЕМЕНТАМ ДАННЫЕ КОТОРЫХ НУЖНО ИЗМЕНИТЬ С ОТОБРАЖЕНИЕМ ОБЩЕЙ ФОРМЫ ДЛЯ ИЗМЕНЕНИЯ НА САЙТЕ
	$(document).on('click', '.csite2', function(e){
		e.preventDefault();
		$('.innerform').css({'left':e.pageX,'top':e.pageY});
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {openwindowz: $(this).find('.value').text(), pagename: $.cookie('pagename'), id: $(this).find('.id').text()},
			success:function(loader){
				$('#windowForm .innerform').html(loader);	
				$('#windowForm').removeClass('hidden');
				jQuery(document).ready(function()
				{
					var drag = 0;
					var l, t, pos, cl, ct, dl, dt;
					jQuery('.movable').mousedown(function(event)
					{
						if (drag == 0) {
						 	drag = 1;

							cl = event.clientX;
							ct = event.clientY;

							pos = jQuery('.move').parent().position();
							l = parseInt(pos.left);
							t = parseInt(pos.top);
							
							dl = cl - l;
							dt = ct - t;
					
							//console.log(dl+' '+event.clientX+' '+event.pageX);
							//console.log(dt+' '+event.clientY+' '+event.pageY);
				        }

						jQuery('body').mouseup(function(event)
						{
							 drag = 0;
						});

						jQuery('body').mousemove(function(event)
						{
							
							if (drag == 1)
							{
								jQuery('.move').parent().css({'top':event.clientY - dt,'left':event.clientX - dl});
							}
						});
					});
				});
			}
		});
	} );
//КЛИК ПО КНОПКЕ УДАЛИТЬ В ПЛАШКАХ
	$(document).on('click', '#delplate', function(e){
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {crmchange: 'delplate', id: $(this).find('.id_plate').text() },
			success:function(loader){
				$('#windowToForm').addClass('hidden');
				$('.site_view').html(loader);
			}
		});
	});
//КЛИК ПО ПЛАШКАМ ДАННЫЕ КОТОРЫХ НУЖНО ИЗМЕНИТЬ С ОТОБРАЖЕНИЕМ ОБЩЕЙ ФОРМЫ ДЛЯ ИЗМЕНЕНИЯ НА САЙТЕ
	$(document).on('click', '.cspe', function(e){
		e.preventDefault();
		$('.innerform').css({'left':e.pageX,'top':e.pageY});
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {openwindowz: $(this).find('.value').text(), pagename: $.cookie('pagename'), numproj: $.cookie('id_project'), id: $(this).find('.id').text()},
			success:function(loader){
				$('#windowForm .innerform').html(loader);	
				$('#windowForm').removeClass('hidden');
				jQuery(document).ready(function()
				{
					var drag = 0;
					var l, t, pos, cl, ct, dl, dt;
					jQuery('.movable').mousedown(function(event)
					{
						if (drag == 0) {
						 	drag = 1;

							cl = event.clientX;
							ct = event.clientY;

							pos = jQuery('.move').parent().position();
							l = parseInt(pos.left);
							t = parseInt(pos.top);
							
							dl = cl - l;
							dt = ct - t;
					
							//console.log(dl+' '+event.clientX+' '+event.pageX);
							//console.log(dt+' '+event.clientY+' '+event.pageY);
				        }

						jQuery('body').mouseup(function(event)
						{
							 drag = 0;
						});

						jQuery('body').mousemove(function(event)
						{
							
							if (drag == 1)
							{
								jQuery('.move').parent().css({'top':event.clientY - dt,'left':event.clientX - dl});
							}
						});
					});
				});
			}
		});
	} );

//КЛИК ПО ДОБАВЛЕНИЮ ПЛАШКИ
	$(document).on('click', '.cspa', function(e){
		e.preventDefault();
		$('.innerform').css({'left':e.pageX,'top':e.pageY});
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {openwindowz: 'addplate', pagename: $.cookie('pagename'), numproj: $.cookie('id_project')},
			success:function(loader){
				$('#windowForm .innerform').html(loader);	
				$('#windowForm').removeClass('hidden');
				jQuery(document).ready(function()
				{
					var drag = 0;
					var l, t, pos, cl, ct, dl, dt;
					jQuery('.movable').mousedown(function(event)
					{
						if (drag == 0) {
						 	drag = 1;

							cl = event.clientX;
							ct = event.clientY;

							pos = jQuery('.move').parent().position();
							l = parseInt(pos.left);
							t = parseInt(pos.top);
							
							dl = cl - l;
							dt = ct - t;
					
							//console.log(dl+' '+event.clientX+' '+event.pageX);
							//console.log(dt+' '+event.clientY+' '+event.pageY);
				        }

						jQuery('body').mouseup(function(event)
						{
							 drag = 0;
						});

						jQuery('body').mousemove(function(event)
						{
							
							if (drag == 1)
							{
								jQuery('.move').parent().css({'top':event.clientY - dt,'left':event.clientX - dl});
							}
						});
					});
				});
			}
		});
	} );

	$(document).on('click', '.casl', function(e){
		e.preventDefault();
		$('.innerform').css({'left':e.pageX,'top':e.pageY});
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {openwindowx: $(this).find('.value').text() },
			success:function(loader){
				$('#windowForm .innerform').html(loader);	
				$('#windowForm').removeClass('hidden');
				jQuery(document).ready(function()
				{
					var drag = 0;
					var l, t, pos, cl, ct, dl, dt;
					jQuery('.movable').mousedown(function(event)
					{
						if (drag == 0) {
						 	drag = 1;

							cl = event.clientX;
							ct = event.clientY;

							pos = jQuery('.move').parent().position();
							l = parseInt(pos.left);
							t = parseInt(pos.top);
							
							dl = cl - l;
							dt = ct - t;
					
							//console.log(dl+' '+event.clientX+' '+event.pageX);
							//console.log(dt+' '+event.clientY+' '+event.pageY);
				        }

						jQuery('body').mouseup(function(event)
						{
							 drag = 0;
						});

						jQuery('body').mousemove(function(event)
						{
							
							if (drag == 1)
							{
								jQuery('.move').parent().css({'top':event.clientY - dt,'left':event.clientX - dl});
							}
						});
					});
				});
			}
		});
	} );

	$(document).on('click', '.cffi', function(e){
		e.preventDefault();
		$('.innerform').css({'left':e.pageX,'top':e.pageY});
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {openwindowx: $(this).find('.value').text(), id: $(this).find('.id').text() },
			success:function(loader){
				$('#windowForm .innerform').html(loader);	
				$('#windowForm').removeClass('hidden');
				jQuery(document).ready(function()
				{
					var drag = 0;
					var l, t, pos, cl, ct, dl, dt;
					jQuery('.movable').mousedown(function(event)
					{
						if (drag == 0) {
						 	drag = 1;

							cl = event.clientX;
							ct = event.clientY;

							pos = jQuery('.move').parent().position();
							l = parseInt(pos.left);
							t = parseInt(pos.top);
							
							dl = cl - l;
							dt = ct - t;
					
							//console.log(dl+' '+event.clientX+' '+event.pageX);
							//console.log(dt+' '+event.clientY+' '+event.pageY);
				        }

						jQuery('body').mouseup(function(event)
						{
							 drag = 0;
						});

						jQuery('body').mousemove(function(event)
						{
							
							if (drag == 1)
							{
								jQuery('.move').parent().css({'top':event.clientY - dt,'left':event.clientX - dl});
							}
						});
					});
				});
			}
		});
	} );

	$(document).on('click', '.cae', function(e){
		e.preventDefault();
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {openwindowm: $(this).find('.value').text() },
			success:function(loader){
				$('#windowToForm .obolochka .centredv').html(loader);	
				$('#windowToForm').removeClass('hidden');
			}
		});
	} );

	$(document).on('click', '.ccz', function(e){
		e.preventDefault();
		$.cookie('inpage', 'card');
		$.cookie('id_card', $(this).find('.idzayavki').text());
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {openwindowm: $(this).find('.value').text(), id: $(this).find('.idzayavki').text()},
			success:function(loader){
				$('#windowToFormChecker .obolochka .centredv').html(loader);	
				$('#windowToFormChecker').removeClass('hidden');
			}
		});
	} );

	$(document).on('click', '.cawt', function(e){
		e.preventDefault();
		$('.innerform').css({'left':e.pageX,'top':e.pageY});
		$.ajax({
			url: '../tmpl/obrabotka.php',
			type:'post',
			data: {openwindown: $(this).find('.value').text() },
			success:function(loader){
				$('#windowForm .innerform').html(loader);	
				$('#windowForm').removeClass('hidden');
				jQuery(document).ready(function()
				{
					var drag = 0;
					var l, t, pos, cl, ct, dl, dt;
					jQuery('.movable').mousedown(function(event)
					{
						if (drag == 0) {
						 	drag = 1;

							cl = event.clientX;
							ct = event.clientY;

							pos = jQuery('.move').parent().position();
							l = parseInt(pos.left);
							t = parseInt(pos.top);
							
							dl = cl - l;
							dt = ct - t;
					
							//console.log(dl+' '+event.clientX+' '+event.pageX);
							//console.log(dt+' '+event.clientY+' '+event.pageY);
				        }

						jQuery('body').mouseup(function(event)
						{
							 drag = 0;
						});

						jQuery('body').mousemove(function(event)
						{
							
							if (drag == 1)
							{
								jQuery('.move').parent().css({'top':event.clientY - dt,'left':event.clientX - dl});
							}
						});
					});
				});
			}
		});
	} );

	$(document).on("mouseenter", ".step", function(e){
		$(this).find('.delvoronka').removeClass('hidden'); 
	});

	$(document).on("mouseleave", ".step", function(e){
		$(this).find('.delvoronka').addClass('hidden'); 
	});
	 
	var drag, move;
		 
	$(document).on("mouseenter", ".pagebtn", function(e){
		$(this).attr("id","dragnow"); 
		$("#statusForm").css({'top':e.pageY-21,'left':e.pageX-25});
	});

	$(document).on("mouseleave", ".pagebtn", function(e){
		$(this).removeAttr("id");
		if (!drag) {
			move=false;
		}
	});

	$(document).on("mousedown", "#dragnow", function(e){
		drag=true;
		move=true;
		$('#statusForm').removeClass("hidden");
		$('#dragnow .blockpage').clone().appendTo("#statusForm");
	});

	$(document).on("mousemove", "body", function(e){
		if (drag) {
			$("#statusForm").css({'top':e.pageY-21,'left':e.pageX-25});
		}
	});

	$(document).on("mousemove", "#dragnow", function(e){
		if (drag) {
			$("#statusForm").css({'top':e.pageY-21,'left':e.pageX-25});
		}
	});	

	$(document).on("mouseenter", ".step", function(e){
		$(this).addClass('dropable');
	});

	$(document).on("mouseleave", ".step", function(e){
		$(this).removeClass('dropable');
	});
	 	 
	$(document).on("mouseup", "#dragnow", function(e){
		drag=false;
		move=false;
		$('#statusForm').addClass("hidden");
		$('#statusForm').empty();
	});

	$(document).on("contextmenu", ".dropable", function(e){
		e.preventDefault();
		e.stopPropagation();
	});

	$(document).on("mouseup", ".dropable", function(e){
		if (e.which == 3) {
			if ($(this).find('.pageid').text() != '') {
				e.stopPropagation();
				$.ajax({
					url: "../tmpl/obrabotka.php",
					type:"post",
					data: {crmchange: "dvoronka", pageid: $(this).find('.pageid').text(), stepnumb: $(this).find('.stepnumb').text()},
					success:function(loader){
						$('.voronkaview').html(loader);
						$('.voronkaright').animate({ scrollTop: $('#laststepscroll').offset().top }, 500);
					}
				});
			}
		}
		if  ( !$(this).hasClass('emptyfield') ) {
			$('#statusForm').addClass("hidden");
			$('#statusForm').empty();
			drag=false;
			move=false;
		}
	});

	$(document).on("mouseup", ".delvoronka", function(e){
		if (!drag) {
			if (e.which == 1) {
				if ($(this).parent('.step').find('.pageid').text() != '') {
					e.stopPropagation();
					$.ajax({
						url: "../tmpl/obrabotka.php",
						type:"post",
						data: {crmchange: "dvoronka", pageid: $(this).parent('.step').find('.pageid').text(), stepnumb: $(this).parent('.step').find('.stepnumb').text()},
						success:function(loader){
							$('.voronkaview').html(loader);
						}
					});
				}
			}
		}

		if  ( !$(this).parent('.step').hasClass('emptyfield') ) {
			$('#statusForm').addClass("hidden");
			$('#statusForm').empty();
			drag=false;
			move=false;
		}
	});

	$(document).on("mouseup", ".emptyfield", function(e){
		e.preventDefault();
		if (drag) {
			if (e.which == 1) {
				drag=false;
				move=false;
				$.ajax({
					url: "../tmpl/obrabotka.php",
					type:"post",
					data: {crmchange: "avoronka", stepnumb: $(this).find('.stepnumb').text(), pageid: $('#statusForm .blockpage .pageid').text()},
					success:function(loader){
						$('.voronkaview').html(loader);
						$('.voronkaright').animate({ scrollTop: $('#laststepscroll').offset().top }, 500);
					}
				});

				/*$(this).parent('.voronka_line').append('<div class="step pointer dashed emptyfield"><div class="wh100 blockpage pointer"><div class="imgline"></div>');
				$(this).empty();
				$('#statusForm .blockpage').clone().appendTo(this);*/
				$('#statusForm').addClass("hidden");
				$('#statusForm').empty();
			}
		}
	});

	$(document).on("click", "#logob", function(e){
		e.preventDefault();
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type:"post",
			data: {loginc: "true"},
			success:function(loader){
				$('#loginzone .menuheight').html(loader);
				jQuery(document).ready(function()
				{
					var drag = 0;
					var l, t, pos, cl, ct, dl, dt;
					jQuery('.movable').mousedown(function(event)
					{
						if (drag == 0) {
						 	drag = 1;

							cl = event.clientX;
							ct = event.clientY;

							pos = jQuery('.move').parent().position();
							l = parseInt(pos.left);
							t = parseInt(pos.top);
							
							dl = cl - l;
							dt = ct - t;
					
							//console.log(dl+' '+event.clientX+' '+event.pageX);
							//console.log(dt+' '+event.clientY+' '+event.pageY);
				        }

						jQuery('body').mouseup(function(event)
						{
							 drag = 0;
						});

						jQuery('body').mousemove(function(event)
						{
							
							if (drag == 1)
							{
								jQuery('.move').parent().css({'top':event.clientY - dt,'left':event.clientX - dl});
							}
						});
					});
				});
			}
		});
	});

	$(document).on("change", "input[type='file']", function(e){
		$.ajax({
			url: "../tmpl/obrabotka.php",
			type: "post",
			data: {color: this.id, val: this.value, numproj: $.cookie('id_project'), pagename: $.cookie('pagename')},
			success:function(loader){
				//$('.site_view').html(loader);	
				//alert(loader);
			}
		});
	});

	$(document).on("change", "input[type='color']", function(e){
		$.ajax({
					url: "../tmpl/obrabotka.php",
					type:"post",
					data: {color: this.id, val: this.value, numproj: $.cookie('id_project'), pagename: $.cookie('pagename')},
					success:function(loader){
						$('.site_view').html(loader);	
					}
				});
	});

	var timerId;

	$(document).on("keyup", ".comment", function(e){
		e.preventDefault();
		var vrval, vrid;
		clearTimeout(timerId);
		timerId = setTimeout(send, 1543);
		vrval = this.value;
		vrid = $(this).parent().find('.iduserkom').text();
		function send() {
			$.ajax({
				url: '../tmpl/obrabotka.php',
				method:'post',
				data: {sendcomment: vrval, id: vrid},
				success:function(loader){

				}
			});
		}
	});

	$(document).on("focus", "input[name='phone']", function(e){
		$('input[name="phone"]').mask("+7 (999) 999-9999");
	});

	$(document).on("focus", "input[name='time']", function(e){
		$.mask.definitions['s'] = '[0-5]';
		$.mask.definitions['h'] = '[0-2]';
		$('input[name="time"]').mask("h9:s9");
	});

	/*if ($("input[name=date]").attr("placeholder", "Дата")) {
		$(document).on("click", "input[name=date]", function(e){
			$("input[name=date]").daterangepicker({
				singleDatePicker: true,
				timePicker: true,
				timePickerIncrement: 30,
				timePicker24Hour: true,
				showDropdowns: true,
				autoApply: true,
				locale: {
					format: "MM.DD.YYYY hh:mm",
			        separator: " - ",
			        applyLabel: "Применить",
			        cancelLabel: "Отмена",
			        fromLabel: "От",
			        toLabel: "До",
			        customRangeLabel: "Свой",
			        daysOfWeek: [
			            "Вс",
			            "Пн",
			            "Вт",
			            "Ср",
			            "Чт",
			            "Пт",
			            "Сб"
			        ],
			        monthNames: [
			            "Январь",
			            "Февраль",
			            "Март",
			            "Апрель",
			            "Май",
			            "Июнь",
			            "Июль",
			            "Август",
			            "Сентябрь",
			            "Октябрь",
			            "Ноябрь",
			            "Декабрь"
			        ],
			        firstDay: 1
				}
			});
			$("input[name=date]").attr("placeholder", "");
			$("input[name=date]").on("change", function () {
			    var myDate = new Date($(this).val());
			    console.log(myDate, myDate.getTime());
			    $("#valcalendar").text(myDate.getTime());
			});
		});
	}/**/

	
});

	function showdate(i){
		if ($(i).attr("placeholder", "Дата")) {
			$(i).daterangepicker({
				singleDatePicker: true,
				timePicker: true,
				timePickerIncrement: 30,
				timePicker24Hour: true,
				showDropdowns: true,
				autoApply: true,
				locale: {
					format: "MM.DD.YYYY hh:mm",
			        separator: " - ",
			        applyLabel: "Применить",
			        cancelLabel: "Отмена",
			        fromLabel: "От",
			        toLabel: "До",
			        customRangeLabel: "Свой",
			        daysOfWeek: [
			            "Вс",
			            "Пн",
			            "Вт",
			            "Ср",
			            "Чт",
			            "Пт",
			            "Сб"
			        ],
			        monthNames: [
			            "Январь",
			            "Февраль",
			            "Март",
			            "Апрель",
			            "Май",
			            "Июнь",
			            "Июль",
			            "Август",
			            "Сентябрь",
			            "Октябрь",
			            "Ноябрь",
			            "Декабрь"
			        ],
			        firstDay: 1
				}
			});

			$(i).attr("placeholder", null);
			$(i).removeAttr('onclick');
			$(i).click();
		};
	}

	function changedate(i){
		var myDate = new Date($(i).val());
		//console.log(myDate, myDate.getTime());
		$("#valcalendar").text(myDate.getTime());
	}