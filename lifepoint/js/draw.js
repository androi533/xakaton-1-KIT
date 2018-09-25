

$( document ).ready( function() {
	width=screen.width;	
	height=screen.height;

	$.ajax({
		url: "tmpl/pen.php",
		type:"post",
		data: {
			sizes: true, w: width, h: height
		},
		success:function(loader){
			var obj = JSON.parse( loader );
			$('#tablet').attr("width", obj.width);
			$('#tablet').attr("height", obj.height);
		}
	});



});

if(window.addEventListener) {
    window.addEventListener('load', function () {
    
    var canvas, context, tool;

    var obj = Object.create(null);
    var objHelpform = Object.create(null);
    objHelpform.width = 336;
    objHelpform.height = 80;
    var objs = [];

    var i_obj = 1;

    function clearArray(array) {
	  while (array.length) {
	    array.pop();
	  }
	}

    $(document).bind('contextmenu', function(e) {
        return false;
    });

    $(document).keyup(function (ev) {
        if (i_obj > 0) {
            if ( (ev.keyCode == 90) && (ev.ctrlKey) ) {
                i_obj = i_obj - 1;
                objs.splice(i_obj, 1);

                context.clearRect(0, 0, screen.width, screen.height);
                for (var i = objs.length - 1; i > 0; i--) {
                    if (objs[i].typeform == 'rect') {
                        a = Math.round(( objs[i].max_x - objs[i].min_x)/2);
                        b = Math.round(( objs[i].max_y - objs[i].min_y)/2);
                        x2 = objs[i].max_x-a;  //центр фигуры
                        y2 = objs[i].max_y-b; //центр фигуры

                        for (var j = -b; j <= b; j++) {
                            y1 = j;
                            x1 = a;
                            context.strokeRect(Math.round(x1+x2), Math.round(y1+y2), 1, 1);
                            context.strokeRect(Math.round(-x1+x2), Math.round(y1+y2), 1, 1);
                        }

                        for (var j = -a; j <= a; j++) {
                            x1 = j;
                            y1 = b;
                            context.strokeRect(Math.round(x1+x2), Math.round(y1+y2), 1, 1);
                            context.strokeRect(Math.round(x1+x2), Math.round(-y1+y2), 1, 1);
                        }
                    }

                    if (objs[i].typeform == 'ellipse') {
                        a = Math.round(( objs[i].max_x - objs[i].min_x)/2);
                        b = Math.round(( objs[i].max_y - objs[i].min_y)/2);
                        x2 = objs[i].max_x-a;  //центр фигуры
                        y2 = objs[i].max_y-b; //центр фигуры

                        for (var j = -b; j <= b; j++) {
                            x1 = a/b*Math.pow( (Math.pow(b, 2)-Math.pow(j, 2)), 1/2);
                            y1 = j;
                            context.strokeRect(Math.round(x1+x2), Math.round(y1+y2), 1, 1);
                            context.strokeRect(Math.round(-x1+x2), Math.round(y1+y2), 1, 1);
                        }
                        
                    }

                    if (objs[i].typeform == 'line_hor') {
                        //a = Math.round(( objs[objs[i].parent].max_x - objs[objs[i].parent].min_x)/2);
                        //objs[objs[i].parent].max_x
                        y1 = objs[i].min_y; //начало фигуры
                        //x1 = objs[i].min_x; //начало фигуры
                        for (var j = objs[objs[i].parent].min_x; j <= objs[objs[i].parent].max_x; j++) {
                            x2 = j;
                            context.strokeRect(Math.round(x2), Math.round(y1), 1, 1);
                        }
                    }

                    if (objs[i].typeform == 'line_ver') {
                        //b = Math.round(( objs[i].max_y - objs[i].min_y)/2); 
                        x1 = objs[i].min_x; //начало фигуры
                        //y1 = objs[i].min_y; //начало фигуры
                        for (var j = objs[objs[i].parent].min_y; j <= objs[objs[i].parent].max_y; j++) {
                            y2 = j;
                            context.strokeRect(Math.round(x1), Math.round(y2), 1, 1);
                          //context.strokeRect(objs[i].min_x, objs[i].min_y, objs[i].max_x-objs[i].min_x, objs[i].max_y-objs[i].min_y);
                        }
                    }
                }

            }
        }
    });

    function init () {
        // Находим canvas элемент
        var min_x, min_y, max_x, max_y, a, b, x1, x2, y1, y2;
        canvas = document.getElementById('tablet');
        
        
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
        //canvas.addEventListener('keyup',   ev_canvas, false);

        min_x = 0;
    	max_x = screen.width;
    	min_y = 0;
    	max_y = screen.height;

    	
        if (objs.length == 0) {
            //console.log(min_x+' '+min_y+' '+max_x+' '+max_y);

            obj.id = 0;
            obj.min_x = min_x;
            obj.max_x = max_x;
            obj.min_y = min_y;
            obj.max_y = max_y;
            obj.typeform = 'screen';
            obj.parent = 'this';
            obj.sloy = 0;

            objs[0] = obj;

            //console.log(objs);
        }
    	
    }

    // Здесь мы будем ловить движения мыши
    function tool_pencil () {
        var tool = this;
        var dX = 10;
        var mnozh = 3;
        var points_x = [];
        var points_y = [];
        var min_x, min_y, max_x, max_y, ellipse, a, b, typeform;
        var timerIdShow, timerIdHide;
        this.started = false;
        this.inshowhelpzone = false;
        this.show = false;
        this.activeobj = 0;

        this.mousedown = function (ev) {
            console.log(ev.which);
            if (ev.which == 3) {
                ev.preventDefault();
                return false;
            } else {
                context.beginPath();
                context.moveTo(ev._x, ev._y);
                points_x.push(ev._x);
                points_y.push(ev._y);
                tool.started = true;
            }
        };

        // Эта функция вызывается каждый раз, когда вы перемещаете мышь.
        // Но рисование происходит только когда вы удерживаете кнопку мыши
        // нажатой.
        this.mousemove = function (ev) {
            //console.log(ev._x+';'+ev._y)
            function showhelp (ev, typeform) {
                timerIdShow = null;
                $('.helpform').removeClass('hidden');
                
                $('.helpform').attr('style', 'left:'+ev.clientX+';top:'+ev.clientY);
                $('.helpform').html('<div class="vac">'+typeform+'</div>');
                //$('.helpform').attr('top', e.clientY);
                objHelpform.x = ev.clientX;
                objHelpform.y = ev.clientY;
                objHelpform.show = true;
                console.log('Show help '+objHelpform.x+';'+objHelpform.y);
                $('.helpform').removeClass('stels');
            }

            function hidehelp () {
                timerIdHide = null;
                console.log('Hide help');
                tool.inshowhelpzone = false;
                tool.activeobj = 0;
                objHelpform.show = false;
                $('.helpform').addClass('stels');
            }

            if (tool.started) {
                context.lineTo(ev._x, ev._y);
                points_x.push(ev._x);
            	points_y.push(ev._y);
                context.stroke();
            } else {
                if (tool.inshowhelpzone) {
                    
                } else {
                    
                }
                /* if (tool.inshowhelpzone) {
                    if ( (ev._x < objs[tool.activeobj].max_x + dX*mnozh) && (ev._x > objs[tool.activeobj].min_x - dX*mnozh) && (ev._y > objs[tool.activeobj].min_y - dX*mnozh) && (ev._y < objs[tool.activeobj].max_y + dX*mnozh) ) {
                        if (tool.show == false) {
                            if (timerIdShow == null) {
                                typeform = objs[tool.activeobj].typeform;
                                console.log(typeform);
                                timerIdShow = setTimeout(function () {showhelp(ev, typeform);}, 543);
                            } else {
                                console.log('FFA');
                                clearTimeout(timerIdHide);
                                timerIdShow = setTimeout(function () {showhelp(ev, typeform);}, 543);
                            }

                                    //timerIdShow = setTimeout(function () {showhelp(ev, objs[i].typeform);}, 543);
                                        
                            if (timerIdHide == null) {
                                console.log('bag');
                                clearTimeout(timerIdHide);
                            } else {
                                tool.inshowhelpzone = false;
                                //timerIdHide = setTimeout(hidehelp, 1543);
                                console.log('no bag');
                            }
                        }
                        console.log('Stop on zone '+tool.show);
                        //return;
                    } else {
                        if (objHelpform.show) {
                            if ( (ev._x > objHelpform.x - dX*mnozh) && (ev._x < objHelpform.x + objHelpform.width + dX*mnozh) && (ev._y < objHelpform.y + objHelpform.height + dX*mnozh)  && (ev._y > objHelpform.y - dX*mnozh) ) {
                                if (timerIdHide == null) {
                                    clearTimeout(timerIdHide);
                                }
                                console.log('Stop on helpform');
                            } else {
                                $('#tablet').removeClass('pointer');
                                console.log('Stop out zone '+objHelpform.x);
                                if (!timerIdShow) {
                                    clearTimeout(timerIdShow);
                                }
                                
                                timerIdHide = setTimeout(hidehelp, 1543);
                            }
                        } else {
                            clearTimeout(timerIdHide);
                            clearTimeout(timerIdShow);
                        }
                    }
                } else {
                    for (var i = objs.length - 1; i >= 0; i--) {
                        switch (objs[i].typeform) {
                            case 'rect':
                                if ( (ev._x > objs[i].min_x - dX) && (ev._x < objs[i].max_x + dX) && (ev._y < objs[i].max_y + dX) && (ev._y > objs[i].min_y + dX) ) {
                                    tool.inshowhelpzone = true;
                                    tool.activeobj = i;
                                    $('#tablet').addClass('pointer');
                                    console.log('Start in zone rect');
                                    //clearTimeout(timerIdShow);
                                    clearTimeout(timerIdHide);
                                    if (timerIdShow == null)
                                        //timerIdShow = setTimeout(function () {showhelp(ev, objs[i].typeform);}, 543);
                                        timerIdShow = setTimeout(function () {showhelp(ev, 'Прямоугольник');}, 543);
                                }
                                break;
                            case 'ellipse':
                                if ( (ev._x > objs[i].min_x - dX) && (ev._x < objs[i].max_x + dX) && (ev._y < objs[i].max_y + dX) && (ev._y > objs[i].min_y + dX) ) {
                                    tool.inshowhelpzone = true;
                                    tool.activeobj = i;
                                    $('#tablet').addClass('pointer');
                                    console.log('Start in zone ellipse');
                                    //clearTimeout(timerIdShow);
                                    clearTimeout(timerIdHide);
                                    if (timerIdShow == null)
                                        //timerIdShow = setTimeout(function () {showhelp(ev, objs[i].typeform);}, 543);
                                        timerIdShow = setTimeout(function () {showhelp(ev, 'Овал');}, 543);
                                }
                                break;
                            case 'line_ver':
                                if ( (ev._x > objs[i].min_x - dX) && (ev._x < objs[i].max_x + dX) && (ev._y < objs[objs[i].parent].max_y + dX) && (ev._y > objs[objs[i].parent].min_y + dX) ) {
                                    tool.inshowhelpzone = true;
                                    tool.activeobj = i;
                                    $('#tablet').addClass('pointer');
                                    console.log('Start in zone ver');
                                    //clearTimeout(timerIdShow);
                                    clearTimeout(timerIdHide);
                                    if (timerIdShow == null)
                                        //timerIdShow = setTimeout(function () {showhelp(ev, objs[i].typeform);}, 543);
                                        timerIdShow = setTimeout(function () {showhelp(ev, 'Вертикальная линия');}, 543);
                                }
                                break;
                            case 'line_hor':
                                if ( (ev._y > objs[i].min_y - dX) && (ev._y < objs[i].max_y + dX) && (ev._x < objs[objs[i].parent].max_x + dX) && (ev._x > objs[objs[i].parent].min_x + dX) ) {
                                    tool.inshowhelpzone = true;
                                    tool.activeobj = i;
                                    $('#tablet').addClass('pointer');
                                    console.log('Start in zone hor');
                                    //clearTimeout(timerIdShow);
                                    clearTimeout(timerIdHide);
                                    if (timerIdShow == null) {
                                        console.log('AUF');
                                        timerIdShow = setTimeout( function () {showhelp(ev, 'Горизонтальная линия');}, 543);
                                    }
                                }
                                break;
                            case 'screen':
                                console.log('Экран');
                                break;
                            default:
                                console.log('ХЗ');
                        }
                        if ( (objs[i].typeform == 'rect') || (objs[i].typeform == 'ellipse') ) { //|| (objs[i].typeform == 'screen') 
                            if ( (ev._x > objs[i].min_x - dX) && (ev._x < objs[i].max_x + dX) && (ev._y < objs[i].max_y + dX) && (ev._y > objs[i].min_y + dX) ) {
                                tool.inshowhelpzone = true;
                                tool.activeobj = i;
                                $('#tablet').addClass('pointer');
                                console.log('Start in zone zamk');
                                //clearTimeout(timerIdShow);
                                clearTimeout(timerIdHide);
                                if (timerIdShow == null)
                                    //timerIdShow = setTimeout(function () {showhelp(ev, objs[i].typeform);}, 543);
                                    timerIdShow = setTimeout(function () {showhelp(ev, 'zamk');}, 543);
                            }
                        } else {
                            if (objs[i].typeform == 'line_ver') {
                                if ( (ev._x > objs[i].min_x - dX) && (ev._x < objs[i].max_x + dX) && (ev._y < objs[objs[i].parent].max_y + dX) && (ev._y > objs[objs[i].parent].min_y + dX) ) {
                                    tool.inshowhelpzone = true;
                                    tool.activeobj = i;
                                    $('#tablet').addClass('pointer');
                                    console.log('Start in zone ver');
                                    //clearTimeout(timerIdShow);
                                    clearTimeout(timerIdHide);
                                    if (timerIdShow == null)
                                        //timerIdShow = setTimeout(function () {showhelp(ev, objs[i].typeform);}, 543);
                                        timerIdShow = setTimeout(function () {showhelp(ev, 'line_ver');}, 543);
                                }
                            }

                            if (objs[i].typeform == 'line_hor') {
                                if ( (ev._y > objs[i].min_y - dX) && (ev._y < objs[i].max_y + dX) && (ev._x < objs[objs[i].parent].max_x + dX) && (ev._x > objs[objs[i].parent].min_x + dX) ) {
                                    tool.inshowhelpzone = true;
                                    tool.activeobj = i;
                                    $('#tablet').addClass('pointer');
                                    console.log('Start in zone hor');
                                    //clearTimeout(timerIdShow);
                                    clearTimeout(timerIdHide);
                                    if (timerIdShow == null)
                                        timerIdShow = setTimeout( function () {showhelp(ev, 'Горизонтальная линия');}, 543);
                                }
                            }
                        }
                    }
                }*/
            }
        };

        // Событие при отпускании мыши
        this.mouseup = function (ev) {
            if (tool.started) {
            	tool.mousemove(ev);
                context.closePath();

                min_x = screen.width;
            	max_x = 0;
            	min_y = screen.height;
            	max_y = 0;

            	for (var i = points_x.length - 1; i >= 0; i--) {
            		_x = points_x[i];
            		_y = points_y[i];
            		if (_x < min_x) {
            			min_x = _x;
            		}
            		if (_y < min_y) {
            			min_y = _y;
            		}
            		if (_x > max_x) {
            			max_x = _x;
            		}
            		if (_y > max_y) {
            			max_y = _y;
            		}
            	}

            	if ( (max_x - min_x < dX) && (max_y - min_y < dX) ) {
            		//console.log('Помарка');
            	} else {
            		if ( (max_x - min_x < dX*3) || (max_y - min_y < dX*3) ) {
            			if (max_x - min_x < dX*3) {
            				//console.log('Прямая вертикальная');
            				obj = new Object();
            				obj.id = i_obj;
				        	obj.min_x = max_x;
				        	obj.max_x = max_x;
				        	obj.min_y = min_y;
				        	obj.max_y = max_y;
				        	obj.typeform = 'line_ver';
            			}
	            		if (max_y - min_y < dX*3) {
	            			//console.log('Прямая горизонтальная');
	            			obj = new Object();
	            			obj.id = i_obj;
				        	obj.min_x = min_x;
				        	obj.max_x = max_x;
				        	obj.min_y = max_y;
				        	obj.max_y = max_y;
				        	obj.typeform = 'line_hor';
	            		}
	            	} else {
                        var point_max_ellipse = 0;
                        var point_max_rect = 0;
                        var ex_o, ex_i, c, c_o, c_i, f1_o, f2_o, f1_i, f2_i;

                        a = Math.round(( max_x - min_x)/2);
                        b = Math.round(( max_y - min_y)/2);

                        x2 = max_x-a;  //центр фигуры
                        y2 = max_y-b; //центр фигуры

                        if (b > a) { //Свапаем для эллипса
                            c = a;
                            a = b;
                            b = c;
                        }
                        ex_o = Math.sqrt(1 - Math.pow((b/a),2));
                        ex_i = Math.sqrt(1 - Math.pow( (b-dX)/(a-dX), 2));
                        c_o = a * ex_o;
                        c_i = a * ex_i;
                        f1_o = 0 - c_o;
                        f2_o = 0 + c_o;
                        f1_i = 0 - c_i;
                        f2_i = 0 + c_i;
                        ellipse = true;

                        //Далее с точками
                        for (var k = 0; k < points_x.length; k++) {
                            x = points_x[k] - x2;
                            y = points_y[k] - y2;
                           /* d1_o = Math.sqrt( (Math.pow(f1_o - x, 2) + Math.pow(f1_o - y, 2)) );
                            d2_o = Math.sqrt( (Math.pow(f2_o - x, 2) + Math.pow(f2_o - y, 2)) );
                            d1_i = Math.sqrt( (Math.pow(f1_i - x, 2) + Math.pow(f1_i - y, 2)) );
                            d2_i = Math.sqrt( (Math.pow(f2_i - x, 2) + Math.pow(f2_i - y, 2)) );*/
                            //console.log('['+points_x[k]+';'+points_y[k]+']');
                            
                            /*if (Math.round(d1_o + d2_o, 4) <= Math.round( 2 * a, 4)) {
                                console.log ('ATA');
                                
                                if (Math.round(d1_i + d2_i, 4) > Math.round( 2 * (a-dX), 4)) {
                                    console.log(' лежит в эллипсе');
                                    point_max_ellipse = point_max_ellipse + 1;
                                } else {
                                    console.log(' не лежит в эллипсе');
                                }
                            }*/

                            if (Math.pow(x/(a+dX*1.5), 2) + Math.pow(y/(b+dX*1.5), 2) <= 1) {
                                //console.log ('ATA 2');
                                if (Math.pow(x/(a-dX*1.5), 2) + Math.pow(y/(b-dX*1.5), 2) > 1) {
                                    //console.log(' лежит в эллипсе');
                                    point_max_ellipse = point_max_ellipse + 1;
                                }
                            }

                            if ( (points_x[k] < min_x + dX) || (points_y[k] < min_y + dX) || (points_x[k] > max_x - dX) || (points_y[k] > max_y - dX) ) {
                                //console.log(' лежит в области прямоугольника');
                                point_max_rect = point_max_rect + 1;
                            }
                        }
                        
                        if (point_max_ellipse > point_max_rect) {
                            ellipse = true;
                        } else {
                            ellipse = false;
                        }

                        if (ellipse) {
                            obj = new Object();
                            obj.id = i_obj;
                            obj.min_x = min_x;
                            obj.max_x = max_x;
                            obj.min_y = min_y;
                            obj.max_y = max_y;
                            obj.typeform = 'ellipse';
                        } else {
                            //console.log('Прямоугольник');
                            obj = new Object();
                            obj.id = i_obj;
                            obj.min_x = min_x;
                            obj.max_x = max_x;
                            obj.min_y = min_y;
                            obj.max_y = max_y;
                            obj.typeform = 'rect';
                        }
	            	}

                    
                    var max_sloy = 0;
                    var id_parent = 0;
                    for (var i = objs.length - 1; i >= 0; i--) {
                        if ( (objs[i].typeform == 'rect') || (objs[i].typeform == 'ellipse') ) {
                            if ( (objs[i].min_x <= obj.min_x) && (objs[i].min_y <= obj.min_y) && (objs[i].max_y >= obj.max_y) && (objs[i].max_x >= obj.max_x) ) {
                                if (max_sloy < objs[i].sloy) {
                                    max_sloy = objs[i].sloy;
                                    id_parent = objs[i].id;
                                    console.log(max_sloy+' '+id_parent);
                                }
                            }
                        }
                    }

                    obj.parent = id_parent;
                    if ( (obj.typeform == 'ellipse') || (obj.typeform == 'rect') ) {
                        obj.sloy = max_sloy + 1;
                    } else {
                        if  (obj.typeform == 'line_ver')  {
                            obj.max_y = objs[id_parent].max_y;
                            obj.min_y = objs[id_parent].min_y;
                        }
                        
                        if (obj.typeform == 'line_hor') {
                            obj.max_x = objs[id_parent].max_x;
                            obj.min_x = objs[id_parent].min_x;
                        }

                        obj.sloy = max_sloy;
                    }                    

                    objs[i_obj] = obj;

                    i_obj = i_obj + 1;
            	}
            	
            	/*console.log(min_x+' '+min_y+' '+max_x+' '+max_y);*/
            	console.log(objs);

                clearArray(points_x);
                clearArray(points_y);

                $.cookie('objs', JSON.stringify(objs));

                min_x = ev.clientX;
            	max_x = 0;
            	min_y = ev.clientY;
            	max_y = 0;
                tool.started = false;

                context.clearRect(0, 0, screen.width, screen.height);
                for (var i = objs.length - 1; i > 0; i--) {
                	if (objs[i].typeform == 'rect') {
                        a = Math.round(( objs[i].max_x - objs[i].min_x)/2);
                        b = Math.round(( objs[i].max_y - objs[i].min_y)/2);
                        x2 = objs[i].max_x-a;  //центр фигуры
                        y2 = objs[i].max_y-b; //центр фигуры

                        for (var j = -b; j <= b; j++) {
                            y1 = j;
                            x1 = a;
                            context.strokeRect(Math.round(x1+x2), Math.round(y1+y2), 1, 1);
                            context.strokeRect(Math.round(-x1+x2), Math.round(y1+y2), 1, 1);
                        }

                        for (var j = -a; j <= a; j++) {
                            x1 = j;
                            y1 = b;
                            context.strokeRect(Math.round(x1+x2), Math.round(y1+y2), 1, 1);
                            context.strokeRect(Math.round(x1+x2), Math.round(-y1+y2), 1, 1);
                        }
                	}

                    if (objs[i].typeform == 'ellipse') {
                        a = Math.round(( objs[i].max_x - objs[i].min_x)/2);
                        b = Math.round(( objs[i].max_y - objs[i].min_y)/2);
                        x2 = objs[i].max_x-a;  //центр фигуры
                        y2 = objs[i].max_y-b; //центр фигуры

                        for (var j = -b; j <= b; j++) {
                            x1 = a/b*Math.pow( (Math.pow(b, 2)-Math.pow(j, 2)), 1/2);
                            y1 = j;
                            context.strokeRect(Math.round(x1+x2), Math.round(y1+y2), 1, 1);
                            context.strokeRect(Math.round(-x1+x2), Math.round(y1+y2), 1, 1);
                        }
                        
                    }

                	if (objs[i].typeform == 'line_hor') {
                        //a = Math.round(( objs[objs[i].parent].max_x - objs[objs[i].parent].min_x)/2);
                        //objs[objs[i].parent].max_x
                        y1 = objs[i].min_y; //начало фигуры
                        //x1 = objs[i].min_x; //начало фигуры
                        for (var j = objs[objs[i].parent].min_x; j <= objs[objs[i].parent].max_x; j++) {
                            x2 = j;
                            context.strokeRect(Math.round(x2), Math.round(y1), 1, 1);
                        }
                	}

                	if (objs[i].typeform == 'line_ver') {
                        //b = Math.round(( objs[i].max_y - objs[i].min_y)/2); 
                        x1 = objs[i].min_x; //начало фигуры
                        //y1 = objs[i].min_y; //начало фигуры
                        for (var j = objs[objs[i].parent].min_y; j <= objs[objs[i].parent].max_y; j++) {
                            y2 = j;
                            context.strokeRect(Math.round(x1), Math.round(y2), 1, 1);
                          //context.strokeRect(objs[i].min_x, objs[i].min_y, objs[i].max_x-objs[i].min_x, objs[i].max_y-objs[i].min_y);
                        }
                	}
                }
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

    if ($.cookie('objs')) {
        if (!canvas) {
            objs = JSON.parse($.cookie('objs'));
            i_obj = objs.length;

            canvas = document.getElementById('tablet');
            
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

            context.clearRect(0, 0, screen.width, screen.height);
            context.beginPath();
            for (var i = objs.length - 1; i > 0; i--) {
                if (objs[i].typeform == 'rect') {
                    a = Math.round(( objs[i].max_x - objs[i].min_x)/2);
                    b = Math.round(( objs[i].max_y - objs[i].min_y)/2);
                    x2 = objs[i].max_x-a;  //центр фигуры
                    y2 = objs[i].max_y-b; //центр фигуры

                    for (var j = -b; j <= b; j++) {
                        y1 = j;
                        x1 = a;
                        context.strokeRect(Math.round(x1+x2), Math.round(y1+y2), 1, 1);
                        context.strokeRect(Math.round(-x1+x2), Math.round(y1+y2), 1, 1);
                    }

                    for (var j = -a; j <= a; j++) {
                        x1 = j;
                        y1 = b;
                        context.strokeRect(Math.round(x1+x2), Math.round(y1+y2), 1, 1);
                        context.strokeRect(Math.round(x1+x2), Math.round(-y1+y2), 1, 1);
                    }
                }

                if (objs[i].typeform == 'ellipse') {
                    a = Math.round(( objs[i].max_x - objs[i].min_x)/2);
                    b = Math.round(( objs[i].max_y - objs[i].min_y)/2);
                    x2 = objs[i].max_x-a;  //центр фигуры
                    y2 = objs[i].max_y-b; //центр фигуры

                    for (var j = -b; j <= b; j++) {
                        x1 = a/b*Math.pow( (Math.pow(b, 2)-Math.pow(j, 2)), 1/2);
                        y1 = j;
                        context.strokeRect(Math.round(x1+x2), Math.round(y1+y2), 1, 1);
                        context.strokeRect(Math.round(-x1+x2), Math.round(y1+y2), 1, 1);
                    }
                    
                }

                if (objs[i].typeform == 'line_hor') {
                    //a = Math.round(( objs[objs[i].parent].max_x - objs[objs[i].parent].min_x)/2);
                    //objs[objs[i].parent].max_x
                    y1 = objs[i].min_y; //начало фигуры
                    //x1 = objs[i].min_x; //начало фигуры
                    for (var j = objs[objs[i].parent].min_x; j <= objs[objs[i].parent].max_x; j++) {
                        x2 = j;
                        context.strokeRect(Math.round(x2), Math.round(y1), 1, 1);
                    }
                }

                if (objs[i].typeform == 'line_ver') {
                    //b = Math.round(( objs[i].max_y - objs[i].min_y)/2); 
                    x1 = objs[i].min_x; //начало фигуры
                    //y1 = objs[i].min_y; //начало фигуры
                    for (var j = objs[objs[i].parent].min_y; j <= objs[objs[i].parent].max_y; j++) {
                        y2 = j;
                        context.strokeRect(Math.round(x1), Math.round(y2), 1, 1);
                      //context.strokeRect(objs[i].min_x, objs[i].min_y, objs[i].max_x-objs[i].min_x, objs[i].max_y-objs[i].min_y);
                    }
                }
            }
            context.closePath();
            
        }
    }

    init();



}, false); }