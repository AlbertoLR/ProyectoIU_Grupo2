$(document).ready(function(){
    $("#category").change(function(){
      var categor = $( "#category" ).val();
      if(categor!=""){
        var capa=document.getElementById("limpiar");
        capa.style.visibility="hidden";
        capa.style.display="none";

        var capa1=document.getElementById("extra");
        capa1.style.visibility="visible";
        capa1.style.display="block";

      }else{
        var capa=document.getElementById("limpiar");
        capa.style.visibility="visible";
        capa.style.display="block";

        var capa1=document.getElementById("extra");
        capa1.style.visibility="hidden";
        capa1.style.display="none";
      }
   });
});
