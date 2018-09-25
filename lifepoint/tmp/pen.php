<?php

?><script type="text/javascript">
	var draw;
	draw = false;

	$(function() {
		"use strict";
		var timerId, div, width, height;

		function InitFunc() {
			if(window.addEventListener) {
			    window.addEventListener('load', function () {
			    
			    var canvas, context, tool;

			    function init () {
			        // Находим canvas элемент
			        canvas = document.getElementById('canvas');
			        
			        if (!canvas) {
			            alert('Ошибка! Canvas элемент не найден!');
			            return;
			        }

			        if (!canvas.getContext) {
			            alert('Ошибка: canvas.getContext не существует!');
			            return;
			        }

			        // Получаем 2D canvas context.
			        context = canvas.getContext('2d');
			        if (!context) {
			            alert('Ошибка: getContext! не существует');
			            return;
			        }
			        
			        tool = new tool_pencil();
			        canvas.addEventListener('mousedown', ev_canvas, false);
			        canvas.addEventListener('mousemove', ev_canvas, false);
			        canvas.addEventListener('mouseup',   ev_canvas, false);
			    }

			    // Здесь мы будем ловить движения мыши
			    function tool_pencil () {
			        var tool = this;
			        this.started = false;

			    
			        this.mousedown = function (ev) {
			            context.beginPath();
			            context.moveTo(ev._x, ev._y);
			            tool.started = true;
			        };

			        // Эта функция вызывается каждый раз, когда вы перемещаете мышь.
			        // Но рисование происходит только когда вы удерживаете кнопку мыши
			        // нажатой.
			        this.mousemove = function (ev) {
			            if (tool.started) {
			                context.lineTo(ev._x, ev._y);
			                context.stroke();
			            }
			        };

			        // Событие при отпускании мыши
			        this.mouseup = function (ev) {
			            if (tool.started) {
			                tool.mousemove(ev);
			                tool.started = false;
			            }
			        };
			    }

			    // Эта функция определяет позицию курсора относительно холста
			    function ev_canvas (ev) {
			        if (ev.layerX || ev.layerX == 0) { // Firefox
			            ev._x = ev.layerX;
			            ev._y = ev.layerY;
			        } else if (ev.offsetX || ev.offsetX == 0) { // Opera
			            ev._x = ev.offsetX;
			            ev._y = ev.offsetY;
			        }

			        // Вызываем обработчик события tool
			        var func = tool[ev.type];
			        if (func) {
			            func(ev);
			        }
			    }

			    init();

			}, false); }
		}

		width=screen.width;	
		height=screen.height;
		$.ajax({
			url: "tmpl/pen.php",
			type:"post",
			data: {
				sizes: true, w: width, h: height
			},
			success:function(loader){
				$('body').html(loader);
				InitFunc();
			}
		});

		function CreateImage() {
			var cnvs = document.getElementById("canvas");
			var ctxt = cnvs.getContext("2d");
			ctxt.strokeStyle = "#F26700";
			ctxt.lineWidth = 6;
			ctxt.beginPath();
			ctxt.moveTo(35,30);
			ctxt.lineTo(75,20);
			ctxt.lineTo(115,30);
			ctxt.lineTo(105,110);
			ctxt.lineTo(75,120);
			ctxt.lineTo(45,110);
			ctxt.closePath();
			ctxt.stroke();
		}
	});
</script>