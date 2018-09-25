<?php

?><script type="text/javascript">
	var draw;
	draw = false;

	$(function() {
		"use strict";
		var timerId, div, width, height;

		

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

	function StartFigure(t) {
		console.log('start draw');
		$(t).addClass('draw');
		draw = true;
		//addEventListener("mousemove", Draw(event, t));
		//event.preventDefault();
		timerId = setInterval(Draw(event, t), 1000);
	}

	function EndFigure(t) {
		console.log('end draw');
		draw = false;
		//removeEventListener("mousemove", Draw);
		clearTimeout(timerId);
		$(t).removeClass('draw');
	}

	function Draw(e, t) {
		function CreatePoint(e, t, ms) {
			//function TimeOut(e, t) {
			if (draw) {
				posX = e.clientX;
				posY = e.clientY;
				console.log(posX+" "+posY);

				var cnvs = document.getElementById("canvas");
				var ctxt = cnvs.getContext("2d");

				ctxt.strokeStyle = "#F26700";
				ctxt.lineWidth = 1;
				ctxt.fillRect(posX-1,posY-1,2,2);
			}
		}
		CreatePoint(e, t, 20);
	}

	/*function Draw(e, t) {
		function CreatePoint(e, t, ms) {
			function TimeOut(e, t) {
				draw = false;
				Draw(e, t);
			}
			console.log(ms);
			ms = ms - 1;

			if (draw === false) {
				if (ms == 0) {
					console.log('q');
				} else {
					console.log('w');
					setTimeout(CreatePoint(e, t, ms), 100);
				}
			} else {
				posX = e.clientX;
				posY = e.clientY;

				var cnvs = document.getElementById("canvas");
				var ctxt = cnvs.getContext("2d");

				ctxt.strokeStyle = "#F26700";
				ctxt.lineWidth = 1;
				ctxt.fillRect(posX-1,posY-1,2,2);
				

				if (ms == 0) {
					console.log('e');
					console.log(posX+" "+posY);
					TimeOut(e, t);
				} else {
					console.log('r');
					setTimeout(CreatePoint(e, t, ms), 100);
				}
			}
		}

		if ( $(t).hasClass('draw') ) {
			if (draw === false) {
				console.log('draw');
				draw = true;
				CreatePoint(e, t, 20);
			} else {
				console.log('nodraw');
				CreatePoint(e, t, 20);
			}
			
		} else {

		}
	}

				/*if (typeof timerId !== 'undefined') {
				clearTimeout(timerId);
			}*/

//console.log('draw');
			
			
			/*if (draw === false) {
					
				draw = true;
				
			}*/
			/*if (typeof timerId === 'undefined') {
				console.log('start timer');
				if (draw === false) {
					draw = true;
					timerId = setInterval(CreatePoint(e), 300);
				}
			} else {

			}*/
			//
			/*if (typeof timerId !== 'undefined') {
				unset(timerId);
			} else {
				Draw(e, t);
			}*/	
	/*var cnvsid = document.getElementById("canvas");
	timerId = setInterval(Draw(event, cnvsid), 2300);*/

			/*if (bool == false) {
				bool = true;
				var cnvs = document.getElementById("canvas");
				var ctxt = cnvs.getContext("2d");
				
				posX = e.clientX;
				posY = e.clientY;

				console.log(posX+" "+posY);
				ctxt.strokeStyle = "#F26700";
				ctxt.lineWidth = 1;
				ctxt.fillRect(posX-1,posY-1,2,2);

				timerId = setTimeout(CreatePoint(e, false), 300);
			}*/	
</script>