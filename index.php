<?php include("config/conexion.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>

    <!-- Select 2 -->
	<link rel="stylesheet" type="text/css" href="select2/css/select2.css">
    <script src="select2/jquery-3.1.1.min.js"></script>
    <script src="select2/js/select2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<h5>DETALLE DE PRODUCTOS</h5>
<script>
    $(document).ready(function(){
    $("#descripcion").select2({
    minimumInputLength: 0,
    width: '100%',
    ajax: {
        url:'consulta_pedidos.php',
        dataType: 'json',
        type: "GET",
        delay: 250,
        quietMillis: 50,
        data: function (term) {
            return {
                term: term.term
            };
        },
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    var str = '';
                    return {
                        text: item.descripcion+'  Stock ' +item.cantidad_stock,
                        id: item.idservicio,
                        descripcion: item.descripcion,
                        precio: item.precio,
                        stock: item.cantidad_stock,
                        idservicio: item.idservicio                            
                    }
                })
            };
        }
    },
    placeholder: 'Digite el Nombre del Producto',
    closeOnSelect: true
    });
    $('#descripcion').on('select2:select', function (e) {
        const item = e.params.data;
        if(parseFloat(item.stock)<=0){
            Swal.fire("Sin Stock!", "Este Producto NO cuenta con Stock Disponible!", "error");
            return 0;
        } else {
        var descripcion =  item.descripcion;
        var precio = item.precio;
        var cantidad = 1;
        var subtotal = precio ;
        var idservicio =  item.idservicio;
        var stock =  item.stock;
            cadena = "<tr>";
            cadena=cadena + "<td>" + "<input type='number' class='form-control txtcantidad_tabla_venta' id='cantidad_"+item.id+"' name='cantidad[]' min='1'  max='"+item.stock+"'  value='1'/></td>";
            cadena=cadena + "<td>" + "<input type='hidden' readonly='true' class='form-control txtcantidad_tabla_venta' id='descripcion' name='descripcion[]' value='"+item.descripcion+"'/>"+item.descripcion+"</td>";
            cadena=cadena + "<td>" + " <select  id='guardicion_"+item.id+"' name='guardicion[]' class='form-control txtcantidad_tabla_venta'><option value=' ' >Selecciona guardicion</option>";
            cadena=cadena + "<?php $stmt = Conexion::conectar()->prepare('SELECT *  from guardicion ') ?>";
            cadena=cadena + " <?php $stmt->execute(); ?>"; 
            cadena=cadena + "<?php $va=1; ?>";
            cadena=cadena + "<?php foreach ($stmt->fetchAll() as $row) { ?>";
            cadena=cadena + " <option value='<?php echo $row['descripcion_guardicion'] ?>' > <?php echo $row['descripcion_guardicion'] ?></option>";
            cadena=cadena + " <?php } ?></select></td>";
            cadena=cadena + "<td>" + "<input type='text' class='form-control txtcantidad_tabla_venta' id='precio_"+item.id+"' name='precio[]' value='"+item.precio+"'/></td>"
            cadena=cadena + "<td>" + "<a class=' txtcantidad_tabla_venta2' id='eliminar_"+item.id+"' > <i class='fa fa-trash' style='font-size:25px;color:red'></i> ELIMINAR</a></td>";
            cadena=cadena + "<input type='hidden' readonly='true' class='form-control txtcantidad_tabla_venta' id='totalcobrar_"+item.id+"' name='totalcobrar[]'value='"+item.precio+"'/>"
            cadena=cadena + "<input type='hidden' class='form-control txtcantidad_tabla_venta' id='idservicio_"+item.id+"' name='idservicio[]' value='"+item.idservicio+"' />";
            cadena=cadena + "<input type='hidden' class='form-control txtcantidad_tabla_venta' id='total_stock_"+item.id+"' name='total_stock[]' value='"+item.stock+"' />";
            $("#tablas_venta tbody").append(cadena);
            selector = document.getElementById("select_venta["+item.id+"]");
            for ( i = 1; i <= descripcion ; i++){
            selector.options[i] = new Input(i,i);
            }
            item.id++;
            $("#tablas_venta").on('change','.txtcantidad_tabla_venta',function(){
                let id = $(this).attr("id");
                id = id.split("_");
                id = id[1];
                let c = parseFloat($("#cantidad_"+id).val());
                let p = parseFloat($("#precio_"+id).val());
                $("#totalcobrar_"+id).val((c*p).toFixed(2));
            });                                                        
            $("#tablas_venta").on('click','.txtcantidad_tabla_venta2',function(){
                let id = $(this).attr("id");
                id = id.split("_");
                id = id[1];
                $("#eliminar_"+id).parent().parent().remove(); 
            });                                           
        }
    });
});
</script>
<form class=""name="agregar_productos" id="agregar_productos" method="post">
<label class="col-md-12">Selecione su Producto<span class="required">*</span></label> <br><br>
    <div class="col-md-12 ">
        <select  id="descripcion"  >
        
        </select>   
    </div>
<br>
    <div class="col-md-12 ">
        <label class=" col-md-12">Items <span class="required">*</span></label> <br><br>
        <div class="card-box table-responsive">
            <table  id="tablas_venta" class="table table-striped" border="1">
            <thead>
                <tr>
                <td> <b>CANT</b> </td>
                <td> <b>Descripcion</b> </td>
                <td> <b>Guarnición</b> </td>
                <td> <b>Precio</b> </td>
                <td> <b>Acción</b> </td>
                </tr>
            </thead>
            <tbody>
            </tbody>
            </table> 
        </div>
    </div>
</form>
    <p class="text-center">
        <input type="submit"  id="agregar_carrito" name="agregar_carrito" class="btn btn-primary" value="Agregar Carrito">
    </p>

    <label class=" col-md-12">CARRITO DE COMPRAS <span class="required">*</span></label> <br><br>
    <table  id="tablas_venta2" class="table table-striped"  border="1">
        <thead>
            <tr>
                <td> <b>Item</b> </td>
                <td> <b>CANT</b> </td>
                <td> <b>Descripcion</b> </td>
                <td> <b>Precio</b> </td>
                <td> <b>SubTotal</b> </td>
                <td> <b>Acción</b></td>
            </tr>

        </thead>
        <tbody>
            <?php
                $stmt = Conexion::conectar()->prepare("SELECT * FROM preventa ");
                    $stmt->execute();
                        $va=1;
                            foreach ($stmt->fetchAll() as $r) { 
                                $arreglo = $r["idpreventa"].",".$r["idservicio"].",".$r["descripcion"].",".$r["cantidad"].",".$r["precio"].",".$r["totalcobrar"];  
                                echo '<tr>';
                                echo '<td>'.$va++.'</td>';
                                echo '<td>'.$r["cantidad"].'</td>';
                                echo '<td>'.$r["descripcion"].'</td>';
                                echo '<td>'.$r["precio"].'</td>';
                                echo '<td>'.$r["totalcobrar"].'</td>';
                                ?>
                                 <td align='center'>
                                    <a  onclick="eliminar_pedido('<?php echo $arreglo ?>')">
                                        Eliminar</a>
                                  </td>
                                <?php
                                echo '</tr>';
                            }
            ?>
        </tbody>

    </table>
   
    
    <script src="js/agregar_carrito.js"></script>
</body>
</html>