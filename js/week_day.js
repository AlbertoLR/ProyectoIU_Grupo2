 $("#day").change(function(){
	var day = document.getElementById("day").value;
		var fech = new Date(day);
		var dias = new Array('7','1','2','3','4','5','6');
		var dia=(dias[fech.getDay()]);
		var select=document.getElementById("horas");
		// Cogemos el listado de opciones en un array de valores
		var op=select.getElementsByTagName("option")
		// Seleccionamos la primera opción
		//select.options[0].selected=true;
		// Recorremos todas las opciones del segundo select
		var n=0;
		var s=0;
		for (var i = 0; i < op.length; i++) {
			if(op[i].id == dia)
			{
				// Si no coincide, lo marcamos o mostramos
				//(selecciona una de las dos opciones)			
				op[i].style.visibility="visible";				
				op[i].style.display="block";
				if(n==0){
					op[i].selected="selected";
					n+=1;
				}
				s+=1;

			}else{
				// Si coincide, lo desmarcamos o escondemos
				//(selecciona una de las dos opciones)
				op[i].style.visibility="hidden";
				op[i].style.display="none";
				
			}
			
		}
		if(s==0){
			op[op.length-1].style.visibility="visible";
			op[op.length-1].style.display="block";
			op[op.length-1].selected="selected";
			}else{
			op[op.length-1].style.visibility="hidden";
			op[op.length-1].style.display="none";
			}
  }
);