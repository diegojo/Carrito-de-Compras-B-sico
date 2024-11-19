$('#agregar_carrito').click(function() {
    var recolect2 = $('#agregar_productos').serialize();
    //alert(recolect2);
    Swal.fire({
        title: "¿Estás Seguro?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
    $.ajax({
            url:'guardar/agregar_carrito.php',
            type:'POST',
            data:recolect2,
            success:function(respuesta2) {
                if(respuesta2 >= 0){
                Swal.fire({
                    title: "Se Agregó Correctamente",
                    icon: "success",
                }).then(function() {
                    window.location = "index.php";
                });
                }else{
                    Swal.fire({
                        title:"Sin Stock! Solo cuenta con" +respuesta2,
                        icon: "error"
                      });
                }
                $('#agregar_productos')[0].reset();
            }
        }); // ajax
        
    } else {
        
      }
    });
}); //function

function eliminar_pedido(arreglo){
    cadena = arreglo.split(',');
    //alert(cadena);
    var recolect3 =  cadena[0];
    //alert(recolect3);
Swal.fire({
    title: "Estas Seguro Que Desea Eliminar?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
        $.ajax({
            url:'eliminar/eliminar_pedido.php?idpreventa='+recolect3,
            type:'POST',
            data:recolect3,
            success:function(respuesta3) {
                if(respuesta3 >=0){
                    Swal.fire({
                        title: "Se Eliminó Correctamente",
                        icon: "success",
                        buttons: true,
                        dangerMode: true,
                    }).then(function() {
                        window.location = "index.php";
                    });
                    }else{
                        Swal.fire(''+respuesta3,"",{
                            icon: "error",
                        });
                    }
               
            }
        });   
    } else {
    }
  });

};