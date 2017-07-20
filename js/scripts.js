jQuery(function( $ ){

	$(document).ready(function(){

		/*
		* @name: setDimensions
		* @author: Ivan Ortiz
		* @versio: 0.1
		* @description: Vigila el tamaño de la pantalla
		* @date: 2016/04/04
		*
		* @param: none
		* @return: none
		*/

		delay = 250,
		throttled = false,
		calls = 0;

		function setDimensions(){
			responsiveMenu();
			projectItems();
		};


		// window.resize event listener
		window.addEventListener('resize', function() {
		    // only run if we're not throttled
		  if (!throttled) {
		    // actual callback action
		    setDimensions();
		    // we're throttled!
		    throttled = true;
		    // set a timeout to un-throttle
		    setTimeout(function() {
		      throttled = false;
		    }, delay);
		  }  
		});

		setDimensions();

		/*
		* @name: responsiveMenu
		* @author: Ivan Ortiz
		* @versio: 0.1
		* @description: 
		* @date: 2016/04/04
		*
		* @param: none
		* @return: none
		*/
		function responsiveMenu(){

			var el = $("#menu_principal");

			if (window.matchMedia("(max-width: 680px)").matches) {
				if(!el.hasClass("responsive-menu")){
					el.addClass("responsive-menu").before('<div class="responsive-menu-icon"></div>');
					
					$(".responsive-menu-icon").click(function(){
						$("#menu_principal").toggleClass("openMenu");
					});

				}
			}else{

				if(el.hasClass("responsive-menu")){
					el.removeClass("responsive-menu");
					if(el.hasClass("openMenu")){el.removeClass("openMenu");}
					el.prev().remove();
				}

				$("#menu_principal").removeAttr("style");
			}

		}

		var outPutData; 

		function projectItems(){

			var el = $("#proyectos");

			if(!outPutData){
				$.ajax({
			        url: "php/controller/control.php",    
			        async: false,
			        type: "POST",
			        data: 'action=0&JSONInicio='+0+'&JSONTotal='+15,
			        dataType: "json",
			        success: function(response){
			            outPutData = response;

			        },
			        error: function(xhr, ajaxOptions, throwError){
			            alert("Ha surgido un error con la conexion");
			            console.log(xhr.status+"\n"+throwError);
			        }
			    });	
			}


			if (window.matchMedia("(max-width: 645px)").matches && !el.hasClass("items-movil")) {

				var totalItems = 1;
				var inicioItems = 0;

				el.removeClass("items-tablet items-pc").addClass("items-movil");

			    displayItems(totalItems,inicioItems);


			}else if (window.matchMedia("(max-width: 885px)").matches && !el.hasClass("items-tablet")) {

				var totalItems = 6;
				var inicioItems = 0;

				el.removeClass("items-movil items-pc").addClass("items-tablet");

			    displayItems(totalItems,inicioItems);

			}else if(window.matchMedia("(min-width: 885px)").matches && !el.hasClass("items-pc")){

				var totalItems = 12;
				var inicioItems = 0;

				el.removeClass("items-movil items-tablet").addClass("items-pc");

			    displayItems(totalItems,inicioItems);

			}

		}


		function displayItems(totalItems,inicioItems){

	    	if(totalItems==1){

		    	var contentDiv = "<div class='wrap wrap-items-m'>";
		    	contentDiv +=" <div class='item-arrow-h'><span class='arrow' onclick='downItems("+inicioItems+","+totalItems+",1);'>w</span></div>";
		    	contentDiv += "<figure class='item'>";
                contentDiv += "<a class='item-hover' href='{URL}'>";
                contentDiv += "<div class='item-info'>";
                contentDiv += "<figcaption class='headline'>";
                contentDiv += outPutData[inicioItems].nombre;
                contentDiv += "</figcaption>";
                contentDiv += "</div>";
                contentDiv += "<div class='mask'></div>";
                contentDiv += "</a>"
                contentDiv += "<div class='item-img'><img src='img/proj/"+outPutData[inicioItems].imagen+"_thumb.jpg' alt='Imagen de "+outPutData[inicioItems].nombre+"' /></div>";
                contentDiv += "</figure>";
				contentDiv +=" <div class='item-arrow-h'><span class='arrow' onclick='upItems("+inicioItems+","+totalItems+",1);'>y</span></div>";
		    	contentDiv +="</div>";


	    	}else if(totalItems== 6){

		    	var contentDiv = "<div class='wrap wrap-items-t'>";
				contentDiv +=" <div class='item-arrow-v'><span class='arrow' onclick='downItems("+inicioItems+","+totalItems+",3);'>z</span></div>";
				contentDiv +=" <div>";
				for(i=0;i<totalItems;i++){
					var itemPosition = inicioItems+i;
						contentDiv += "<figure class='item'>";
	                    contentDiv += "<a class='item-hover' href='{URL}'>";
	                    contentDiv += "<div class='item-info'>";
	                    contentDiv += "<figcaption class='headline'>";
	                    contentDiv += outPutData[itemPosition].nombre;
	                    contentDiv += "</figcaption>";
	                    contentDiv += "</div>";
	                    contentDiv += "<div class='mask'></div>";
	                    contentDiv += "</a>"
	                    contentDiv += "<div class='item-img'><img src='img/proj/"+outPutData[itemPosition].imagen+"_thumb.jpg' alt='Imagen de "+outPutData[itemPosition].nombre+"' /></div>";
	                    contentDiv += "</figure>";

	                    if(i==2){
							contentDiv +="</div><div>";
	                    }

					}
					contentDiv += "</div>";
					contentDiv +=" <div class='item-arrow-v'><span class='arrow' onclick='upItems("+inicioItems+","+totalItems+",3);'>x</span></div>";

	    	}else if(totalItems== 12){
		    	
	    		if((totalItems+inicioItems)<outPutData.length){
	    			var total = totalItems + inicioItems;
	    		}else{
	    			var total = outPutData.length;
	    		}

		    	var contentDiv = "<div class='wrap wrap-items-t'>";
				contentDiv +=" <div class='item-arrow-v'><span class='arrow' onclick='downItems("+inicioItems+","+totalItems+",3);'>z</span></div>";
				contentDiv +=" <div>";
				for(i=0;i<total;i++){
					var itemPosition = inicioItems+i;
						contentDiv += "<figure class='item'>";
	                    contentDiv += "<a class='item-hover' href='{URL}'>";
	                    contentDiv += "<div class='item-info'>";
	                    contentDiv += "<figcaption class='headline'>";
	                    contentDiv += outPutData[itemPosition].nombre;
	                    contentDiv += "</figcaption>";
	                    contentDiv += "</div>";
	                    contentDiv += "<div class='mask'></div>";
	                    contentDiv += "</a>"
	                    contentDiv += "<div class='item-img'><img src='img/proj/"+outPutData[itemPosition].imagen+"_thumb.jpg' alt='Imagen de "+outPutData[itemPosition].nombre+"' /></div>";
	                    contentDiv += "</figure>";

	                if(i==2 || i==5 || i==8){
						contentDiv +="</div><div>";
	                }

				}
				contentDiv += "</div>";
				contentDiv +=" <div class='item-arrow-v'><span class='arrow' onclick='upItems("+inicioItems+","+totalItems+",3);'>x</span></div>";


	    	}

            $("#proyectos").html(contentDiv);

		}


		function downItems(inicioItems, totalItems, valor){
			
			console.log("down");
			//inicioItems = inicioItems - valor;

			//displayItems(totalItems,inicioItems);

		}

		function upItems(inicioItems, totalItems, valor){
			
			console.log("up");
			//inicioItems = inicioItems + valor;

			//displayItems(totalItems,inicioItems);

		}





	}); //End $(document).ready

}); //End jQuery function

		



		/*
		* @name: replaceClass
		* @author: Ivan Ortiz
		* @versio: 0.1
		* @description: Changes one class by another
		* @date: 2016/04/04
		*
		* @param: {String} id of the element to change
		* @param {String} class name to remove
		* @param {String} class name to add
		* @return: none
		*/

window.onload = function(){
		function catchPhrases(){

			//Espacio para Ajax

			var words = new Array("CREACIÓN","PALABRA1","PALABRA2");

			var sortWords = words.sort(function(a, b){return 0.5 - Math.random()});

			var catchWord = document.getElementById("catch");

			goText(0);

			function showText(word, text, posLetra, posPalabra){
				text += word[posLetra];
				catchWord.innerHTML = text;
				posLetra++;

				if(posLetra<word.length){	
					setTimeout(function(){showText(word,text,posLetra,posPalabra);},700);
				}else{
					posPalabra++;
					if(posPalabra == sortWords.length){posPalabra = 0;};
					setTimeout(function(){goText(posPalabra);},1000);
				}
			}

			function goText(posPalabra){
				var word = sortWords[posPalabra].split("");
				var j = 0;
				var text = "";
				setTimeout(function(){showText(word,text,j,posPalabra);},700);

			}


		}	

		catchPhrases();

}


