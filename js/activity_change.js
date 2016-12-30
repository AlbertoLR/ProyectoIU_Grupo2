$(document).ready(function(){
    $("#activity").change(function(){
      var activit = $( "#activity" ).val();
      if(activit!=""){
        var capa=document.getElementById("limpiar");
        capa.style.visibility="hidden";
        capa.style.display="none";
      }  else{
          var capa=document.getElementById("limpiar");
          capa.style.visibility="visible";
          capa.style.display="block";
        }

    });
});
