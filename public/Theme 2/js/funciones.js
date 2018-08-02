
    categorias();
    function agregarexistencias(idproducto,idsucursal,existencia,idexistencia,tr){
        //alert(idproducto+" y el id se sucursal es "+idsucursal+" y agregamos "+existencia);
        var trow=tr;
        
        var parametros = {
            "idexistencia":idexistencia,
            "idproducto": idproducto,
            "idsucursal":idsucursal,
            "existencia":existencia,
            "_token": $('input[name="_token"]').val(),
        };
        $.ajax({
            data: parametros,
            url: 'json/existencia',
            method: 'POST',
            beforeSend: function () {

            },
            success: function (response) {
                //alert(response);
                if(response=="true"){
                    
                    trow.parent().parent().addClass("table-success");
                    trow.parent().parent().next().find(".data-exis").focus();
                    trow.prop('disabled', true);
                    $.Notification.notify('success', 'top right', "Exito", "Existencia agregada exitosamente a la sucursal");
                }
                
                
            }
        });
    }
    function existencias(idproducto) {
        var parametros = {
            "idproducto": idproducto,
        };
        $.ajax({
            data: parametros,
            url: 'json/sucursales/' + idproducto,
            method: 'get',
            beforeSend: function () {

            },
            success: function (response) {
                var tbody="";
                response.forEach(function (res, index) {
                    tbody += '<tr><td>'+res.nombre+'</td><td>'+res.existencia+'</td><td><input type="number" data-idexistencia="'+res.idexistencia+'" data-idsucursal="'+res.idsucursal+'" class="form-control data-exis"></td></tr>';
                    $("#existencias").html(tbody);
                });
            }
        });

    }
    function categorias(idcategoria) {
        $.ajax({
            url: 'json/categorias',
            type: 'get',
            success: function (response) {
                var cat = '<option value="">Sin Categoria</option>';
                response.forEach(function (res, index) {
                    if (idcategoria == res.idcategoria) {
                        var s = "selected";
                    } else {
                        var s = "";
                    }
                    cat += '<option ' + s + ' value="' + res.idcategoria + '">' + res.nombre + '</option>';
                    $("#categorias").html(cat);
                });
            }
        });
    }
    function create() {
        $("#frmTitle").text("Agregar Producto");
        $("#metodo").val("create");
        $("#idproducto").val(0);
        $("#codigo").val("");
        $("#nombre").val("");
        $("#costo").val("");
        $("#venta").val("");
        $("#caducidad").val("");
        $("#ganancia").val("");
        $("#existencias").html('<tr><td colspan="3">Primero registre el producto</td></tr>');
        categorias();
    }
    function buscar(codigo) {
        $("#scod").val("");
        if (codigo == "") {
            create();
            return false;
        }
        var parametros = {
            "codigo": codigo
        };
        $.ajax({
            data: parametros,
            url: 'busqueda/' + codigo,
            type: 'get',
            beforeSend: function () {
                //$("#resultado").html("Procesando, espere por favor...");
            },
            success: function (response) {
                if (!response[0]["find"]) {
                    create();
                    categorias();
                    $("#codigo").val(codigo);
                    
                } else {
                    $("#idproducto").val(response[0]["idproducto"]);
                    $("#metodo").val("update");
                    $("#frmTitle").text("Modificar Información del Producto");
                    $("#codigo").val(response[0]["barra"]);
                    $("#nombre").val(response[0]["nombre"]);
                    $("#costo").val(response[0]["costo"]);
                    $("#venta").val(response[0]["venta"]);
                    $("#caducidad").val(response[0]["caducidad"]);
                    ganancia();
                    categorias(response[0]["idcategoria"]);
                    existencias(response[0]["idproducto"]);
                }
            }
        });
    }
    function ganancia() {
        $("#ganancia").val($("#venta").val() - $("#costo").val());
    }
    function guardarproducto() {
        var r = 0;
        $.each($('.required'), function () {
            if ($(this).val() == "") {
                swal({
                    title: "Campo Requerido",
                    text: "El campo " + $('label[for="' + $(this).attr("id") + '"]').text() + " es requerido",
                    type: 'warning',
                    confirmButtonClass: 'btn btn-secondary mt-2'
                });
                r = 1;
                return false;
            }
        });
        if (r == 0) {
            var parametros = {
                "metodo": $("#metodo").val(),
                "idproducto": $("#idproducto").val(),
                "barra": $("#codigo").val(),
                "nombre": $("#nombre").val(),
                "costo": $("#costo").val(),
                "venta": $("#venta").val(),
                "caducidad": $("#caducidad").val(),
                "idcategoria": $("#categorias").val(),
                "_token": $('input[name="_token"]').val(),
            };
            $.ajax({
                data: parametros,
                url: '../productos',
                method: 'post',
                beforeSend: function () {

                },
                success: function (response) {
                    if (response[0]['error'] == 0) {
                        buscar(response[0]['codigo']);
                        $.Notification.notify('success', 'top right', response[0]['title'], response[0]['msg']);
                    } else {

                        swal({
                            title: response[0]['title'],
                            text: response[0]['msg'],
                            type: 'error',
                            confirmButtonClass: 'btn btn-secondary mt-2'
                        });
                    }
                }
            });
        }
    }
    
    $("#agsave").click(function () {
        guardarproducto();
    });
    $("#costo").keyup(function () {
        ganancia()
    });
    $("#venta").keyup(function () {
        ganancia();
    });
    $("#scod").keypress(function (event) {
        if (event.which == 13) {
            buscar($("#scod").val());
        }
    });
    $("#sbcod").click(function (event) {
        buscar($("#scod").val());
    });

$('body').on("change",".data-exis",function(){
    var tr=$(this);
    agregarexistencias($("#idproducto").val(),$(this).data("idsucursal"),$(this).val(),$(this).data("idexistencia"),tr);
});

var dtLang = {
    "decimal": "",
    "emptyTable": "No hay datos",
    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
    "infoFiltered": "(Filtro de _MAX_ total registros)",
    "infoPostFix": "",
    "thousands": ",",
    "lengthMenu": "Mostrar _MENU_ registros",
    "loadingRecords": "Cargando...",
    "processing": "Procesando...",
    "search": "Buscar:",
    "zeroRecords": "No se encontraron coincidencias",
    "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar orden de columna ascendente",
        "sortDescending": ": Activar orden de columna desendente"
    }
}

//Buttons examples
var table = $('#productos').DataTable({
    lengthChange: false,
    buttons: [/*'copy',*/ 'excel', 'pdf'],
    language: dtLang,
});
table.buttons().container().appendTo('#productos_wrapper .col-md-6:eq(0)');
