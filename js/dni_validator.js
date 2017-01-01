  $("#dni").change(function(){
  var dni = document.getElementById("dni").value;
      var numero = dni.substr(0,dni.length-1);
      var letr = dni.substr(dni.length-1,1);
      var numero = numero % 23;
      var letra='TRWAGMYFPDXBNJZSQVHLCKET';
      letra=letra.substring(numero,numero+1);
     if (letra!=letr.toUpperCase()) {
        alert('Dni erroneo, la letra del NIF no se corresponde');
      }
  }
);
