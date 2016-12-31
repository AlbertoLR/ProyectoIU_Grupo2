$(document).ready(function(){
    $("#event").change(function(){
      var ev = $( "#event" ).val();
      if(ev!=""){
        var capa=document.getElementById("limpact");
        capa.style.visibility="hidden";
        capa.style.display="none";

      }else{
        var capa=document.getElementById("limpact");
        capa.style.visibility="visible";
        capa.style.display="block";

      }
   });
});
