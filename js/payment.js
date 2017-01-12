$(document).ready(function(){
    $("#payment").change(function(){
      var ac = $( "#payment" ).val();
      if(ac!=""){
        var capa=document.getElementById("limpiar");
        capa.style.visibility="hidden";
        capa.style.display="none";

      }else{
        var capa=document.getElementById("limpiar");
        capa.style.visibility="visible";
        capa.style.display="block";

      }
   });
});
