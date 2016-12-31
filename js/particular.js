$(document).ready(function(){
    $("#particular").change(function(){
      var part = $( "#particular" ).val();
      if(part !=""){
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
