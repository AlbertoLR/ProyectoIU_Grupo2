$(document).ready(function(){
    $("#profile").change(function(){
      var pro = $( "#profile" ).val();
      if(pro == "monitor"){
        var capa=document.getElementById("show");
        capa.style.visibility="visible";
        capa.style.display="block";
    }  else{
        var capa=document.getElementById("show");
        capa.style.visibility="hidden";
        capa.style.display="none";

      }
   });
});
