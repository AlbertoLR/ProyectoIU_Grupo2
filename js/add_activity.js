$(document).ready(function(){
    $("#activit").change(function(){
      var ac = $( "#activit" ).val();
      if(ac!=""){
        var capa=document.getElementById("limpev");
        capa.style.visibility="hidden";
        capa.style.display="none";

      }else{
        var capa=document.getElementById("limpev");
        capa.style.visibility="visible";
        capa.style.display="block";

      }
   });
});
