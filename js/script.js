
/**********************************************************************************
                            Data Table
**********************************************************************************/

$(document).ready(function() {
    $('#tVales').DataTable( {
        dom: 'Blfrtip',
        buttons: [
            {
                extend:'print',
                footer: true,
                text: 'Imprimir',
                message: 'REPORTE DE VALES DE GASOLINA',
                title: '',
                orientation: 'landscape',
                pageSize: 'LETTER'
            },
            {
                extend:'pdf',
                footer: true,
                message: 'REPORTE DE VALES DE GASOLINA',
                orientation: 'landscape',
                pageSize: 'LETTER'
            },
            {
                extend:'excel',
                footer: true,
            }
        ],

        "scrollY":        "250px",
        "scrollCollapse": false,
        "paging":         false,



        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 8 ).footer() ).html(
                '$'+pageTotal
            );
        }    
    });


    $('#tDocumentos').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend:'print',
                footer: true,
                text: 'Imprimir',
                message: 'REPORTE DE DOCUMENTOS DE VALES DE GASOLINA',
                title: '',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'pdf',
                footer: true,
                message: 'REPORTE DE DOCUMENTOS DE VALES DE GASOLINA',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'excel',
                footer: true,
            }
        ],

        "scrollY":        "300px",
        "scrollCollapse": false,
        "paging":         false,

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                '$'+pageTotal
            );
        }
    });


    $('#tRecargas').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend:'print',
                footer: true,
                text: 'Imprimir',
                message: 'REPORTE DE DOCUMENTOS DE VALES DE GASOLINA',
                title: '',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'pdf',
                footer: true,
                message: 'REPORTE DE DOCUMENTOS DE VALES DE GASOLINA',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'excel',
                footer: true,
            }
        ],

        "scrollY":        "300px",
        "scrollCollapse": false,
        "paging":         false,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '$'+pageTotal
            );
        }   
    });


    $('#tOrdenMedica').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend:'print',
                footer: true,
                text: 'Imprimir',
                message: 'REPORTE DE DOCUMENTOS DE VALES DE GASOLINA',
                title: '',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'pdf',
                footer: true,
                message: 'REPORTE DE ORDENES MEDICAS',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'excel',
                footer: true,
            }
        ],

        "scrollY":        "300px",
        "scrollCollapse": false,
        "paging":         false,
    });


    $('#tMedicamentos').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend:'print',
                footer: true,
                text: 'Imprimir',
                message: 'REPORTE DE DOCUMENTOS DE VALES DE GASOLINA',
                title: '',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'pdf',
                footer: true,
                message: 'REPORTE DE SOLICITUDES DE MEDICAMENTOS',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'excel',
                footer: true,
            }
        ],

        "scrollY":        "300px",
        "scrollCollapse": false,
        "paging":         false,

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 6 ).footer() ).html(
                '$'+pageTotal
            );
        }   
    });

    $('#tRefacciones').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend:'print',
                footer: true,
                text: 'Imprimir',
                message: 'REPORTE DE DOCUMENTOS DE VALES DE GASOLINA',
                title: '',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'pdf',
                footer: true,
                message: 'REPORTE DE SOLICITUDES DE REFACCIONES',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'excel',
                footer: true,
            }
        ],

        "scrollY":        "300px",
        "scrollCollapse": false,
        "paging":         false,
         "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '$'+pageTotal
            );
        }
    });

    $('#tLubricantes').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend:'print',
                footer: true,
                text: 'Imprimir',
                message: 'REPORTE DE DOCUMENTOS DE VALES DE GASOLINA',
                title: '',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'pdf',
                footer: true,
                message: 'REPORTE DE VALES DE LUBRICANTES',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'excel',
                footer: true,
            }
        ],

        "scrollY":        "300px",
        "scrollCollapse": false,
        "paging":         false,
         "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                '$'+pageTotal
            );
        }
    });

    $('#tStock').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend:'print',
                footer: true,
                text: 'Imprimir',
                message: 'REPORTE DE DOCUMENTOS DE VALES DE GASOLINA',
                title: '',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'pdf',
                footer: true,
                message: 'REPORTE DE MATERIAL EN STOCK',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'excel',
                footer: true,
            }
        ],

        "scrollY":        "300px",
        "scrollCollapse": false,
        "paging":         false,
    });

    $('#tEntradas').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend:'print',
                footer: true,
                text: 'Imprimir',
                message: 'REPORTE DE DOCUMENTOS DE VALES DE GASOLINA',
                title: '',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'pdf',
                footer: true,
                message: 'REPORTE DE ENTRADA DE MATERIALES A ALMACEN',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'excel',
                footer: true,
            }
        ],

        "scrollY":        "300px",
        "scrollCollapse": false,
        "paging":         false,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 7 ).footer() ).html(
                '$'+pageTotal
            );
        }
    });

    $('#tSalidas').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend:'print',
                footer: true,
                text: 'Imprimir',
                message: 'REPORTE DE DOCUMENTOS DE VALES DE GASOLINA',
                title: '',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'pdf',
                footer: true,
                message: 'REPORTE DE SOLICITUDES DE MATERIAL DE ALMACEN',
                orientation: 'portrait',
                pageSize: 'LETTER'
            },
            {
                extend:'excel',
                footer: true,
            }
        ],

        "scrollY":        "300px",
        "scrollCollapse": false,
        "paging":         false,
    });

    $('#tUsuarios').DataTable({});
} );


/**********************************************************************************
                            Check Usuarios
**********************************************************************************/
$(function(){
    $('body').on('change','#ver_vales', function(e){
        e.preventDefault();

        if($('#ver_vales').prop('checked')) 
        {
            document.getElementById("agregar_vales").disabled = false;
            document.getElementById("editar_vales").disabled = false;
            document.getElementById("eliminar_vales").disabled = false;
        }
        else
        {
            document.getElementById("agregar_vales").disabled = true;
            document.getElementById("editar_vales").disabled = true;
            document.getElementById("eliminar_vales").disabled = true;
        }
              
    });
});

$(function(){
    $('body').on('change','#ver_medicamentos', function(e){
        e.preventDefault();

        if($('#ver_medicamentos').prop('checked')) 
        {
            document.getElementById("agregar_medicamentos").disabled = false;
            document.getElementById("editar_medicamentos").disabled = false;
            document.getElementById("eliminar_medicamentos").disabled = false;
        }
        else
        {
            document.getElementById("agregar_medicamentos").disabled = true;
            document.getElementById("editar_medicamentos").disabled = true;
            document.getElementById("eliminar_medicamentos").disabled = true;
        }
              
    });
});

$(function(){
    $('body').on('change','#ver_insumos', function(e){
        e.preventDefault();

        if($('#ver_insumos').prop('checked')) 
        {
            document.getElementById("agregar_insumos").disabled = false;
            document.getElementById("editar_insumos").disabled = false;
            document.getElementById("eliminar_insumos").disabled = false;
        }
        else
        {
            document.getElementById("agregar_insumos").disabled = true;
            document.getElementById("editar_insumos").disabled = true;
            document.getElementById("eliminar_insumos").disabled = true;
        }
              
    });
});

$(function(){
    $('body').on('change','#ver_inventario', function(e){
        e.preventDefault();

        if($('#ver_inventario').prop('checked')) 
        {
            document.getElementById("agregar_inventario").disabled = false;
            document.getElementById("editar_inventario").disabled = false;
            document.getElementById("eliminar_inventario").disabled = false;
        }
        else
        {
            document.getElementById("agregar_inventario").disabled = true;
            document.getElementById("editar_inventario").disabled = true;
            document.getElementById("eliminar_inventario").disabled = true;
        }
              
    });
});

$(function(){
    $('body').on('change','#ver_usuarios', function(e){
        e.preventDefault();

        if($('#ver_usuarios').prop('checked')) 
        {
            document.getElementById("agregar_usuarios").disabled = false;
            document.getElementById("editar_usuarios").disabled = false;
            document.getElementById("eliminar_usuarios").disabled = false;
        }
        else
        {
            document.getElementById("agregar_usuarios").disabled = true;
            document.getElementById("editar_usuarios").disabled = true;
            document.getElementById("eliminar_usuarios").disabled = true;
        }
              
    });
});

/**********************************************************************************
                         Agregar Usuarios
**********************************************************************************/
$(function(){
    $('body').on('click','#btnSetUser', function(e){
        e.preventDefault();

        id       = $('#idUser').val();
        nombre   = $('#nombreUser').val();
        user     = $('#user').val();
        password = $('#passUser').val();


       
        ver_vales      = document.getElementById("ver_vales").checked;
        agregar_vales  = document.getElementById("agregar_vales").checked;
        editar_vales   = document.getElementById("editar_vales").checked;
        eliminar_vales = document.getElementById("eliminar_vales").checked;

        ver_medicamentos      = document.getElementById("ver_medicamentos").checked;
        agregar_medicamentos  = document.getElementById("agregar_medicamentos").checked;
        editar_medicamentos   = document.getElementById("editar_medicamentos").checked;
        eliminar_medicamentos = document.getElementById("eliminar_medicamentos").checked;

        ver_insumos      = document.getElementById("ver_insumos").checked;
        agregar_insumos  = document.getElementById("agregar_insumos").checked;
        editar_insumos   = document.getElementById("editar_insumos").checked;
        eliminar_insumos = document.getElementById("eliminar_insumos").checked;

        ver_inventario      = document.getElementById("ver_inventario").checked;
        agregar_inventario  = document.getElementById("agregar_inventario").checked;
        editar_inventario   = document.getElementById("editar_inventario").checked;
        eliminar_inventario = document.getElementById("eliminar_inventario").checked;

        ver_usuarios      = document.getElementById("ver_usuarios").checked;
        agregar_usuarios  = document.getElementById("agregar_usuarios").checked;
        editar_usuarios   = document.getElementById("editar_usuarios").checked;
        eliminar_usuarios = document.getElementById("eliminar_usuarios").checked;

        if(id!="" && nombre!="" && user!="" && password!="")
        {
            $.ajax({
                url:  $('#setUser').attr('action'),
                type: $('#setUser').attr('method'),
                data: {id:id, nombre:nombre, user:user, password:password, ver_vales:ver_vales, agregar_vales:agregar_vales,
                    editar_vales, eliminar_vales:eliminar_vales, ver_medicamentos:ver_medicamentos, agregar_medicamentos:agregar_medicamentos, 
                    editar_medicamentos:editar_medicamentos, eliminar_medicamentos:eliminar_medicamentos, ver_insumos:ver_insumos,agregar_insumos:agregar_insumos,
                    editar_insumos:editar_insumos, eliminar_insumos:eliminar_insumos, ver_inventario:ver_inventario, agregar_inventario:agregar_inventario,
                    editar_inventario:editar_inventario,eliminar_inventario:eliminar_inventario, ver_usuarios:ver_usuarios, agregar_usuarios:agregar_usuarios,
                    editar_usuarios:editar_usuarios, eliminar_usuarios:eliminar_usuarios},
                success: function(setVale)
                {
                    if(setVale =='true')
                    {
                        alert("Los datos han cargado correctamente");
                        $(location).attr('href','usuarios');
                    }
                    else
                    {
                        alert("Algo ha salido mal, por favor intente de nuevo.");
                        $(location).attr('href','usuarios');
                    }
                }
            });
        }
        else
        {
            alert("Por favor llene todos los campos")
        }           
    });
});


/**********************************************************************************
                            Botones
**********************************************************************************/


/********************************************
            Cancelar
*********************************************/
$(function(){
    $('body').on('click','#cancelar_vale', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'vales');         
    });
});


$(function(){
    $('body').on('click','#btnCancelUser', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'usuarios');         
    });
});

$(function(){
    $('body').on('click','#btnCancelOrden', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'ordenes_medicas');         
    });
});

$(function(){
    $('body').on('click','#cancelar_solicitud', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'refacciones');         
    });
});

$(function(){
    $('body').on('click','#cancelar_lubricante', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'vales_lubricantes');         
    });
});

$(function(){
    $('body').on('click','#cancelar_recarga', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'recargas');         
    });
});

$(function(){
    $('body').on('click','#btnCancelSM', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'medicamentos');         
    });
});

$(function(){
    $('body').on('click','#btnCancelINPapeleria', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'entradas_papeleria');         
    });
});
$(function(){
    $('body').on('click','#btnCancelINOrnato', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'entradas_ornato');         
    });
});
$(function(){
    $('body').on('click','#btnCancelINComputo', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'entradas_computo');         
    });
});

$(function(){
    $('body').on('click','#btnCancelOUTPapeleria', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'salidas_papeleria');         
    });
});

$(function(){
    $('body').on('click','#btnCancelOUTOrnato', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'salidas_ornato');         
    });
});

$(function(){
    $('body').on('click','#btnCancelOUTComputo', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'salidas_computo');         
    });
});

$(function(){
    $('body').on('click','#cancelar_documento', function(e){
        e.preventDefault();
        
        $(location).attr('href', 'documentos');         
    });
});


/********************************************
            Documentos
*********************************************/

$(function(){
    $('#tVales').on('click','#documento_vale', function(e){
        e.preventDefault();      

        folio_vale = $(this).parents("tr").find("td").eq(0).html(); 
        $(location).attr('href', 'nuevo_documento?folio='+folio_vale);
    });
});


/**********************************************************************************
                            Editar Vales
**********************************************************************************/

$(function(){
    $('body').on('click','#editar_vale', function(e){
        e.preventDefault();

        folio_vale = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'editar_vale?folio='+folio_vale);         
    });
});


$(function(){
    $('body').on('click','#updateVale a', function(e){
        e.preventDefault();

        folio        = $('#folio').val();
        folio_asoc   = $('#folio_asoc').val();
        fecha        = $('#fecha_vale').val();
        solicita     = $('#nombre').val();
        chofer       = $('#chofer').val();
        unidad       = $('#unidad').val();
        no_econ      = $('#no_econ').val();
        placas       = $('#placas').val();
        litros       = $('#litros').val();
        departamento = $('#departamento').val();
        km           = $('#km').val();
        gasolinera   = $('#gasolinera').val();
        descripcion  = $('#descripcion').val();


        if(folio!="" && fecha!="" && solicita!="" && chofer!="" && unidad!="" && no_econ!="" && placas!="" && litros!="" && departamento!="" && km!="" && gasolinera!="" && descripcion!="")
        {
            $.ajax({
                url:  $('#updateVale').attr('action'),
                type: $('#updateVale').attr('method'),
                data: {folio:folio, folio_asoc:folio_asoc, fecha:fecha, solicita:solicita, chofer:chofer, unidad:unidad, no_econ:no_econ, placas:placas, litros:litros, departamento:departamento, km:km, gasolinera:gasolinera, descripcion:descripcion},
                success: function(updateVale)
                {
                    if(updateVale =='true')
                    {
                        alert("Los datos han sido actualizados correctamente");
                        $(location).attr('href','vales');
                    }
                    else
                    {
                        alert("Algo ha salido mal, por favor intente de nuevo.");
                        $(location).attr('href','vales');
                    }
                }
            });
        }
        else
        {
            alert("Por favor llene todos los campos")
        }   
    });
});

/**********************************************************************************
                            Editar Usuarios
**********************************************************************************/

$(function(){
    $('body').on('click','#editarUser', function(e){
        e.preventDefault();

        id = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'editar_usuario?id='+id);         
    });
});


$(function(){
    $('body').on('click','#btnUpdateUser', function(e){
        e.preventDefault();

        id       = $('#idUser').val();
        nombre   = $('#nombreUser').val();
        user     = $('#user').val();
        password = $('#passUser').val();

        ver_vales      = document.getElementById("ver_vales").checked;       
        agregar_vales  = document.getElementById("agregar_vales").checked;
        editar_vales   = document.getElementById("editar_vales").checked;
        eliminar_vales = document.getElementById("eliminar_vales").checked;

        ver_medicamentos      = document.getElementById("ver_medicamentos").checked;
        agregar_medicamentos  = document.getElementById("agregar_medicamentos").checked;
        editar_medicamentos   = document.getElementById("editar_medicamentos").checked;
        eliminar_medicamentos = document.getElementById("eliminar_medicamentos").checked;

        ver_insumos      = document.getElementById("ver_insumos").checked;
        agregar_insumos  = document.getElementById("agregar_insumos").checked;
        editar_insumos   = document.getElementById("editar_insumos").checked;
        eliminar_insumos = document.getElementById("eliminar_insumos").checked;

        ver_inventario      = document.getElementById("ver_inventario").checked;
        agregar_inventario  = document.getElementById("agregar_inventario").checked;
        editar_inventario   = document.getElementById("editar_inventario").checked;
        eliminar_inventario = document.getElementById("eliminar_inventario").checked;

        ver_usuarios      = document.getElementById("ver_usuarios").checked;
        agregar_usuarios  = document.getElementById("agregar_usuarios").checked;
        editar_usuarios   = document.getElementById("editar_usuarios").checked;
        eliminar_usuarios = document.getElementById("eliminar_usuarios").checked;


        if(id!="" && nombre!="" && user!="" && password!="")
        {
            $.ajax({
                url:  $('#updateUsuario').attr('action'),
                type: $('#updateUsuario').attr('method'),
                data: {id:id, nombre:nombre, user:user, password:password, ver_vales:ver_vales, agregar_vales:agregar_vales,
                    editar_vales, eliminar_vales:eliminar_vales, ver_medicamentos:ver_medicamentos, agregar_medicamentos:agregar_medicamentos, 
                    editar_medicamentos:editar_medicamentos, eliminar_medicamentos:eliminar_medicamentos, ver_insumos:ver_insumos,agregar_insumos:agregar_insumos,
                    editar_insumos:editar_insumos, eliminar_insumos:eliminar_insumos, ver_inventario:ver_inventario, agregar_inventario:agregar_inventario,
                    editar_inventario:editar_inventario,eliminar_inventario:eliminar_inventario, ver_usuarios:ver_usuarios, agregar_usuarios:agregar_usuarios,
                    editar_usuarios:editar_usuarios, eliminar_usuarios:eliminar_usuarios},
                success: function(updateUser)
                {
                    if(updateUser =='true')
                    {
                        alert("Los datos han modificado correctamente");
                        $(location).attr('href','usuarios');
                    }
                    else
                    {
                        alert("Algo ha salido mal, por favor intente de nuevo.");
                        $(location).attr('href','usuarios');
                    }
                }
            });
        }
        else
        {
            alert("Por favor llene todos los campos")
        }   
    });
});


/**********************************************************************************
                            Editar Orden Medica
**********************************************************************************/

$(function(){
    $('body').on('click','#editar_orden', function(e){
        e.preventDefault();

        folio_vale = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'edit_orden_medica?folio='+folio_vale);         
    });
});


$(function(){
    $('body').on('click','#btnUpdateOrden', function(e){
        e.preventDefault();

        folio        = $('#folio_orden').val();
        fecha        = $('#fecha_orden').val();
        ficha        = $('#ficha').val();
        solicita     = $('#nombre_orden').val();
        categoria    = $('#categoria').val();
        contrato     = document.getElementById("contrato").value;
        personal     = $('#personal').val();
        beneficiario = $('#beneficiario').val();
        parentesco   = $('#parentesco').val();
        departamento = $('#departamento_orden').val();

        if(folio!="" && fecha!="" && ficha!="" && solicita!="" && categoria!="" && contrato!="" && personal!="" && beneficiario!="" && parentesco!="" && departamento!="")
        {
            $.ajax({
                url:  $('#updateOrdenMedica').attr('action'),
                type: $('#updateOrdenMedica').attr('method'),
                data: {folio:folio, fecha:fecha, ficha:ficha, solicita:solicita, categoria:categoria, contrato:contrato, personal:personal, beneficiario:beneficiario, parentesco:parentesco, departamento:departamento},
                success: function(updateOrden)
                {
                    if(updateOrden =='true')
                    {
                        alert("Los datos han sido actualizados correctamente");
                        $(location).attr('href','medicamentos');
                    }
                    else
                    {
                        alert("Algo ha salido mal, por favor intente de nuevo.");
                        $(location).attr('href','medicamentos');
                    }
                }
            });
        }
        else
        {
            alert("Por favor llene todos los campos")
        } 
    });
});


/**********************************************************************************
                            Editar Recarga Saldo
**********************************************************************************/

$(function(){
    $('body').on('click','#editar_recarga', function(e){
        e.preventDefault();

        folio_vale = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'editar_recarga?folio='+folio_vale);         
    });
});



/**********************************************************************************
                            Editar Solicitud Refacciones
**********************************************************************************/

$(function(){
    $('body').on('click','#editar_solicitud', function(e){
        e.preventDefault();

        folio_vale = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'editar_solicitud_refacciones?folio='+folio_vale);         
    });
});

/**********************************************************************************
                            Editar Vale Lubricante
**********************************************************************************/

$(function(){
    $('body').on('click','#editar_lubricante', function(e){
        e.preventDefault();

        folio = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'editar_vale_lubricante?folio='+folio);         
    });
});


/**********************************************************************************
                            Editar Solicitud Medicamento
**********************************************************************************/

$(function(){
    $('body').on('click','#editar_SM', function(e){
        e.preventDefault();

        folio = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'editar_solicitud_medicamento?folio='+folio);         
    });
});

/**********************************************************************************
                            Editar Entradas
**********************************************************************************/

$(function(){
    $('body').on('click','#editar_entrada_papeleria', function(e){
        e.preventDefault();

        folio_vale = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'editar_entrada_papeleria?folio='+folio_vale);         
    });
});


$(function(){
    $('body').on('click','#editar_entrada_ornato', function(e){
        e.preventDefault();

        folio_vale = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'editar_entrada_ornato?folio='+folio_vale);         
    });
});


$(function(){
    $('body').on('click','#editar_entrada_computo', function(e){
        e.preventDefault();

        folio_vale = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'editar_entrada_computo?folio='+folio_vale);         
    });
});

/**********************************************************************************
                            Editar Salidas
**********************************************************************************/

$(function(){
    $('body').on('click','#editar_salida_papeleria', function(e){
        e.preventDefault();

        folio_vale = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'editar_salida_papeleria?folio='+folio_vale);         
    });
});

$(function(){
    $('body').on('click','#editar_salida_ornato', function(e){
        e.preventDefault();

        folio_vale = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'editar_salida_ornato?folio='+folio_vale);         
    });
});

$(function(){
    $('body').on('click','#editar_salida_computo', function(e){
        e.preventDefault();

        folio_vale = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'editar_salida_computo?folio='+folio_vale);         
    });
});

/**********************************************************************************
                            Editar Documentos
**********************************************************************************/

$(function(){
    $('body').on('click','#editar_documento', function(e){
        e.preventDefault();

        folio_vale = $(this).parents("tr").find("td").eq(0).html();      

        $(location).attr('href', 'editar_documento?folio='+folio_vale);         
    });
});


/**********************************************************************************
                            Imprimir Vales
**********************************************************************************/

$(function(){
    $('body').on('click','#imprimir_vale', function(e){
        e.preventDefault();
        
        folio_vale = $(this).parents("tr").find("td").eq(0).html();   

       $(location).attr('href', 'vista_previa_vale?folio='+folio_vale);         
    });
});

/**********************************************************************************
                            Imprimir Orden Medica
**********************************************************************************/

$(function(){
    $('body').on('click','#imprimir_orden', function(e){
        e.preventDefault();
        
        folio_vale = $(this).parents("tr").find("td").eq(0).html();   

       $(location).attr('href', 'vista_previa_orden_medica?folio='+folio_vale);         
    });
});

/**********************************************************************************
                            Imprimir Solicitud Refacciones
**********************************************************************************/

$(function(){
    $('body').on('click','#imprimir_solicitud', function(e){
        e.preventDefault();
        
        folio_vale = $(this).parents("tr").find("td").eq(0).html();   

       $(location).attr('href', 'vista_previa_solicitud?folio='+folio_vale);         
    });
});

/**********************************************************************************
                            Imprimir Vale Lubricantes
**********************************************************************************/

$(function(){
    $('body').on('click','#imprimir_vale_lubricante', function(e){
        e.preventDefault();
        
        folio = $(this).parents("tr").find("td").eq(0).html();   

       $(location).attr('href', 'vista_previa_lubricante?folio='+folio);         
    });
});


/**********************************************************************************
                            Imprimir Vale Lubricantes
**********************************************************************************/

$(function(){
    $('body').on('click','#imprimir_SM', function(e){
        e.preventDefault();
        
        folio = $(this).parents("tr").find("td").eq(0).html();   

       $(location).attr('href', 'vista_previa_solicitud_medicamentos?folio='+folio);         
    });
});

/**********************************************************************************
                    Imprimir Comprobante de Salida
**********************************************************************************/

$(function(){
    $('body').on('click','#imprimir_salida_papeleria', function(e){
        e.preventDefault();
        
        folio = $(this).parents("tr").find("td").eq(0).html();   

       $(location).attr('href', 'vista_previa_salida_papeleria?folio='+folio);         
    });
});

$(function(){
    $('body').on('click','#printValeDetail', function(e){
        e.preventDefault();

        window.print();        
    });
});

$(function(){
    $('body').on('click','#imprimir_salida_ornato', function(e){
        e.preventDefault();
        
        folio = $(this).parents("tr").find("td").eq(0).html();   

       $(location).attr('href', 'vista_previa_salida_ornato?folio='+folio);         
    });
});



$(function(){
    $('body').on('click','#imprimir_salida_computo', function(e){
        e.preventDefault();
        
        folio = $(this).parents("tr").find("td").eq(0).html();   

       $(location).attr('href', 'vista_previa_salida_computo?folio='+folio);         
    });
});



/**********************************************************************************
                           Eliminar Usuarios
**********************************************************************************/

$(function(){
    $("body").on('click','#deleteUser', function(e){
        e.preventDefault();

        nombre = $(this).parents("tr").find("td").eq(1).html();
        usuario = $(this).parents("tr").find("td").eq(2).html();

        respuesta = confirm("Desea eliminar al usuario: " + nombre);

        if (respuesta) {
            ur = $("#deleteUsuario").val();
            $.ajax({
                url: ur,
                type: 'POST',
                data: {usuario:usuario},               
                success:function(eliminarUsuario){
                    if(eliminarUsuario == 'true')
                    {
                        alert("El usuario se ha borrado correctamente");

                        $(location).attr('href', 'usuarios');
                    }
                    else
                    {
                        alert("Error al intentar borrar el archivo, intente de nuevo");
                        $(location).attr('href', 'usuarios');
                    }
                }
            });
        }
        else
        {
            $(location).attr('href', 'usuarios');
        }         
    });
});

/**********************************************************************************
                           Tabla Refacciones
**********************************************************************************/

$(function(){
    $("body").on('click','#plusCeld', function(e){
        e.preventDefault();

       // var keyCode = e.keyCode || e.which; 
        
        var fila_insumos =
                         
            '<tr><td><input type="text" class="form-control" name="cantidad_refacciones[]" id="cantidad_refacciones" ></td>'+
            '<td><input type="text" class="form-control"  name="concepto_refacciones[]" id="concepto_refacciones"></td>'+     
            '<td><input type="text" class="form-control"  name="precio_unitario[]" id="precio_unitario"></td>'+
            '<td><input type="text" class="form-control"  name="importe_refacciones[]" id="importe_refacciones" disabled></td>'+
            '<td><i class="fa fa-plus-circle fa-lg" id="plusCeld"></i></td>'+'<td><i class="fa fa-minus-circle fa-lg" id="minusCeld"></i></td></tr>';  

       // if (keyCode == 9)
        //{
           $('#table_refacciones').append(fila_insumos);
           //document.getElementById('cantidad_refacciones[]').focus();
        //}      
    });
});

$(function(){
    $("body").on('keyup','#precio_unitario', function(e){
        e.preventDefault();

        cantidad =  $(this).parents('tr').find("#cantidad_refacciones").val();        
        punit    = $(this).parents('tr').find("#precio_unitario").val();
        importe  = cantidad * punit;

        $(this).parents('tr').find("#importe_refacciones").val(importe); 

        /*sub = document.getElementById('total_refacciones').value;

        if (sub == 0)
        {
            document.getElementById('total_refacciones').value=importe;
        }
        if (sub !=0)
        {
            total = parseInt(importe)+parseInt(sub);
            document.getElementById('total_refacciones').value=total;
        }*/
    });
});

$(function(){
    $("body").on('keyup','#cantidad_refacciones', function(e){
        e.preventDefault();

        cantidad =  $(this).parents('tr').find("#cantidad_refacciones").val();        
        punit    = $(this).parents('tr').find("#precio_unitario").val();
        importe  = cantidad * punit;

        $(this).parents('tr').find("#importe_refacciones").val(importe); 
        document.getElementById('total_refacciones').value;
    });
});


$(function(){
    $("body").on('click','#minusCeld', function(e){
        e.preventDefault();

       $(this).closest('tr').remove();
    });
});


/**********************************************************************************
                           Tabla Lubricantes
**********************************************************************************/

$(function(){
    $("body").on('click','#plusLubricante', function(e){
        e.preventDefault();

       // var keyCode = e.keyCode || e.which; 
        
        var fila_insumos =
                         
            '<tr><td><input type="text" class="form-control" name="cantidad_Lubricante[]" id="cantidad_Lubricante"></td>'+
            '<td><input type="text" class="form-control"  name="concepto_Lubricante[]" id="concepto_Lubricante"></td>'+
            '<td><input type="text" class="form-control"  name="precio_unitario_lubricante[]" id="precio_unitario_lubricante"></td>'+ 
            '<td><input type="text" class="form-control"  name="importe_Lubricante[]" id="importe_Lubricante" disabled></td>'+    
            '<td><i class="fa fa-plus-circle fa-lg" id="plusLubricante"></i></td>'+'<td><i class="fa fa-minus-circle fa-lg" id="minusLubricante"></i></td></tr>';  

       // if (keyCode == 9)
        //{
           $('#table_Lubricantes').append(fila_insumos);
           //document.getElementById('cantidad_refacciones[]').focus();
        //}      
    });
});

$(function(){
    $("body").on('keyup','#precio_unitario_lubricante', function(e){
        e.preventDefault();

        cantidad =  $(this).parents('tr').find("#cantidad_Lubricante").val();        
        punit    = $(this).parents('tr').find("#precio_unitario_lubricante").val();
        importe  = cantidad * punit;

        $(this).parents('tr').find("#importe_Lubricante").val(importe); 
    });
});

$(function(){
    $("body").on('keyup','#cantidad_Lubricante', function(e){
        e.preventDefault();

        cantidad =  $(this).parents('tr').find("#cantidad_Lubricante").val();        
        punit    = $(this).parents('tr').find("#precio_unitario_lubricante").val();
        importe  = cantidad * punit;

        $(this).parents('tr').find("#importe_Lubricante").val(importe); 
    });
});


$(function(){
    $("body").on('click','#minusLubricante', function(e){
        e.preventDefault();

       $(this).closest('tr').remove();
    });
});

/**********************************************************************************
                           Tabla Medicamentos
**********************************************************************************/

$(function(){
    $("body").on('click','#plsC', function(e){
        e.preventDefault();

       // var keyCode = e.keyCode || e.which; 
        
        var fila_insumos =
                         
            '<tr><td><input type="text" class="form-control" name="cantidad_medicamentos[]" id="cantidad_refacciones" ></td></td>'+
            '<td><input type="text" class="form-control"  name="medicamento[]" id="concepto_refacciones"></td>'+     
            '<td><input type="text" class="form-control"  name="precio_unitario[]" id="precio_unitario"></td>'+
            '<td><input type="text" class="form-control"  name="importe_medicamentos[]" id="importe_refacciones" disabled></td>'+
            '<td><i class="fa fa-plus-circle fa-lg" id="plusCeld"></i></td>'+'<td><i class="fa fa-minus-circle fa-lg" id="minusCeld"></i></td></tr>';  

       // if (keyCode == 9)
        //{
           $('#table_refacciones').append(fila_insumos);
           //document.getElementById('cantidad_refacciones[]').focus();
        //}      
    });
});

$(function(){
    $("body").on('keyup','#precio_unitario', function(e){
        e.preventDefault();

        cantidad =  $(this).parents('tr').find("#cantidad_refacciones").val();        
        punit    = $(this).parents('tr').find("#precio_unitario").val();
        importe  = cantidad * punit;

        $(this).parents('tr').find("#importe_refacciones").val(importe); 

        /*sub = document.getElementById('total_refacciones').value;

        if (sub == 0)
        {
            document.getElementById('total_refacciones').value=importe;
        }
        if (sub !=0)
        {
            total = parseInt(importe)+parseInt(sub);
            document.getElementById('total_refacciones').value=total;
        }*/
    });
});

$(function(){
    $("body").on('keyup','#cantidad_refacciones', function(e){
        e.preventDefault();

        cantidad =  $(this).parents('tr').find("#cantidad_refacciones").val();        
        punit    = $(this).parents('tr').find("#precio_unitario").val();
        importe  = cantidad * punit;

        $(this).parents('tr').find("#importe_refacciones").val(importe); 
        document.getElementById('total_refacciones').value;
    });
});


$(function(){
    $("body").on('click','#minusCeld', function(e){
        e.preventDefault();

       $(this).closest('tr').remove();
    });
});


/**********************************************************************************
                           Tabla Salidas
**********************************************************************************/

$(function(){
    $("body").on('click','#plusOutPapeleria', function(e){
        e.preventDefault();

       // var keyCode = e.keyCode || e.which; 
        
        var fila_insumos =
                         
            '<tr><td><input type="text" class="form-control" name="codigo[]" id="codigo_salida_papeleria"></td>'+
            '<td><input type="text" class="form-control" name="descripcion[]" id="descripcion_salida"></td>'+
            '<td><input type="text" class="form-control" id="cantidad_salida_papeleria" disabled></td>'+ 
            '<td><input type="text" class="form-control" name="cantidad[]" id="cantidad_solicitada_papeleria"></td>'+    
            '<td class="btnRefacciones"><i class="fa fa-plus-circle fa-lg" id="plusOutPapeleria"></i>&nbsp; &nbsp;<i class="fa fa-minus-circle fa-lg" id="minusOut"></i></td></tr>';  

       // if (keyCode == 9)
        //{
           $('#table_OutsPapeleria').append(fila_insumos);
           //document.getElementById('cantidad_refacciones[]').focus();
        //}      
    });
});

$(function(){
    $("body").on('keyup','#codigo_salida_papeleria', function(e){
        e.preventDefault();

         //$(this).parents('tr').find("#descripcion_salida").val('hola');

        //function getTimeAJAX() {

            //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    

            codigo = $(this).val(); 
            var producto = $.ajax({

                url: 'consulta_stock_papeleria?codigo='+ codigo, //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
            }).responseText;

            document.getElementById("producto").value = producto;
            
            var des = document.getElementById("producto").value;
            
            $(this).parents('tr').find("#descripcion_salida").val(des);

            var cantidad = $.ajax({

                url: 'consulta_cantidad_stock_papeleria?codigo='+ codigo, //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
            }).responseText;

            document.getElementById("cantidad_sol_papeleria").value = cantidad;
            
            var des = document.getElementById("cantidad_sol_papeleria").value;
            
            $(this).parents('tr').find("#cantidad_salida_papeleria").val(des);
    
    });
});

$(function(){
    $("body").on('click','#plusOutOrnato', function(e){
        e.preventDefault();

       // var keyCode = e.keyCode || e.which; 
        
        var fila_insumos =
                         
            '<tr><td><input type="text" class="form-control" name="codigo[]" id="codigo_salida_ornato"></td>'+
            '<td><input type="text" class="form-control" name="descripcion[]" id="descripcion_salida"></td>'+
            '<td><input type="text" class="form-control" id="cantidad_salida_ornato" disabled></td>'+ 
            '<td><input type="text" class="form-control" name="cantidad[]" id="cantidad_solicitada_ornato"></td>'+    
            '<td class="btnRefacciones"><i class="fa fa-plus-circle fa-lg" id="plusOutOrnato"></i>&nbsp; &nbsp;<i class="fa fa-minus-circle fa-lg" id="minusOut"></i></td></tr>';  

       // if (keyCode == 9)
        //{
           $('#table_OutsOrnato').append(fila_insumos);
           //document.getElementById('cantidad_refacciones[]').focus();
        //}      
    });
});


$(function(){
    $("body").on('keyup','#codigo_salida_ornato', function(e){
        e.preventDefault();

         //$(this).parents('tr').find("#descripcion_salida").val('hola');

        //function getTimeAJAX() {

            //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    

            codigo = $(this).val(); 
            var producto = $.ajax({

                url: 'consulta_stock_ornato?codigo='+ codigo, //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
            }).responseText;

            document.getElementById("producto").value = producto;
            
            var des = document.getElementById("producto").value;
            
            $(this).parents('tr').find("#descripcion_salida").val(des);

            var cantidad = $.ajax({

                url: 'consulta_cantidad_stock_ornato?codigo='+ codigo, //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
            }).responseText;

            document.getElementById("cantidad_sol_ornato").value = cantidad;
            
            var des = document.getElementById("cantidad_sol_ornato").value;
            
            $(this).parents('tr').find("#cantidad_salida_ornato").val(des);
    
    });
});

$(function(){
    $("body").on('click','#plusOutComputo', function(e){
        e.preventDefault();

       // var keyCode = e.keyCode || e.which; 
        
        var fila_insumos =
                         
            '<tr><td><input type="text" class="form-control" name="codigo[]" id="codigo_salida_computo"></td>'+
            '<td><input type="text" class="form-control" name="descripcion[]" id="descripcion_salida"></td>'+
            '<td><input type="text" class="form-control" id="cantidad_salida_computo" disabled></td>'+ 
            '<td><input type="text" class="form-control" name="cantidad[]" id="cantidad_solicitada_computo"></td>'+    
            '<td class="btnRefacciones"><i class="fa fa-plus-circle fa-lg" id="plusOutComputo"></i>&nbsp; &nbsp;<i class="fa fa-minus-circle fa-lg" id="minusOut"></i></td></tr>';  

       // if (keyCode == 9)
        //{
           $('#table_OutsComputo').append(fila_insumos);
           //document.getElementById('cantidad_refacciones[]').focus();
        //}      
    });
});


$(function(){
    $("body").on('keyup','#codigo_salida_computo', function(e){
        e.preventDefault();

         //$(this).parents('tr').find("#descripcion_salida").val('hola');

        //function getTimeAJAX() {

            //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    

            codigo = $(this).val(); 
            var producto = $.ajax({

                url: 'consulta_stock_computo?codigo='+ codigo, //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
            }).responseText;

            document.getElementById("producto").value = producto;
            
            var des = document.getElementById("producto").value;
            
            $(this).parents('tr').find("#descripcion_salida").val(des);

            var cantidad = $.ajax({

                url: 'consulta_cantidad_stock_computo?codigo='+ codigo, //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
            }).responseText;

            document.getElementById("cantidad_sol_computo").value = cantidad;
            
            var des = document.getElementById("cantidad_sol_computo").value;
            
            $(this).parents('tr').find("#cantidad_salida_computo").val(des);
    
    });
});


$(function(){
    $("body").on('keyup','#cantidad_solicitada_papeleria', function(e){
        e.preventDefault();

        cantidad_solicitada = $(this).val();   
        stock = $(this).parents('tr').find("#cantidad_salida_papeleria").val();

        cantidad_solicitada = parseInt(cantidad_solicitada);
        stock = parseInt(stock);

        if (cantidad_solicitada > stock)
        {
            alert("Actualmente no cuenta con la cantidad solicitada, por favor verifique");
        }
    });
});

$(function(){
    $("body").on('keyup','#cantidad_solicitada_ornato', function(e){
        e.preventDefault();

        cantidad_solicitada = $(this).val();   
        stock = $(this).parents('tr').find("#cantidad_salida_ornato").val();

        cantidad_solicitada = parseInt(cantidad_solicitada);
        stock = parseInt(stock);

        if (cantidad_solicitada > stock)
        {
            alert("Actualmente no cuenta con la cantidad solicitada, por favor verifique");
        }
    });
});

$(function(){
    $("body").on('keyup','#cantidad_solicitada_computo', function(e){
        e.preventDefault();

        cantidad_solicitada = $(this).val();   
        stock = $(this).parents('tr').find("#cantidad_salida_computo").val();

        cantidad_solicitada = parseInt(cantidad_solicitada);
        stock = parseInt(stock);

        if (cantidad_solicitada > stock)
        {
            alert("Actualmente no cuenta con la cantidad solicitada, por favor verifique");
        }
    });
});

$(function(){
    $("body").on('click','#minusOut', function(e){
        e.preventDefault();

       $(this).closest('tr').remove();
    });
});



/**********************************************************************************
                           Tabla Entrdas
**********************************************************************************/


$(function(){
    $("body").on('keyup','#codigo_entrada_papeleria', function(e){
        e.preventDefault();

            //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    

            codigo = $(this).val(); 
            var producto = $.ajax({

                url: 'consulta_stock_papeleria?codigo='+ codigo, //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
            }).responseText;

            document.getElementById("concepto_entrada_papeleria").value = producto;
    });
});

$(function(){
    $("body").on('keyup','#codigo_entrada_ornato', function(e){
        e.preventDefault();

            //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    

            codigo = $(this).val(); 
            var producto = $.ajax({

                url: 'consulta_stock_ornato?codigo='+ codigo, //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
            }).responseText;

            document.getElementById("concepto_entrada_ornato").value = producto;
    });
});

$(function(){
    $("body").on('keyup','#codigo_entrada_computo', function(e){
        e.preventDefault();

            //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    

            codigo = $(this).val(); 
            var producto = $.ajax({

                url: 'consulta_stock_computo?codigo='+ codigo, //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
            }).responseText;

            document.getElementById("concepto_entrada_computo").value = producto;
    });
});
/**********************************************************************************
                        Efectos Botones Sidebar
**********************************************************************************/

$(function(){
    var cambio = false;
    $('.nav li a').each(function(index) {
        if(this.href.trim() == window.location){
            $(this).parent().addClass("active");
            cambio = true;
        }
    });
    
});  


$(function(){
    $('.submenu').click(function(e){
        e.preventDefault();

        if ($(this).hasClass('active')) 
        {
            $(this).removeClass('active');
            $(this).children('ul').slideUp();
        }
        else
        {
            $('.sidebar li ul').slideUp();
            $('.sidebar li').removeClass('active');
            $(this).addClass('active');
            $(this).children('ul').slideDown ();
        }
    });
});



$(function(){
    $('.sidebar').on('click','#dir_refacciones', function(e){
        e.preventDefault();
        
       $(location).attr('href', 'refacciones'); 
       $('.dir_refacciones').addClass('active');
    });
});

$(function(){
    $('.sidebar').on('click','#dir_lubricantes', function(e){
        e.preventDefault();
        
       $(location).attr('href', 'vales_lubricantes');         
    });
});

$(function(){
    $('.sidebar').on('click','#dir_vales', function(e){
        e.preventDefault();
        
       $(location).attr('href', 'vales'); 
    });
});

$(function(){
    $('.sidebar').on('click','#dir_recargas', function(e){
        e.preventDefault();
        
       $(location).attr('href', 'recargas');         
    });
});


$(function(){
    $('.sidebar').on('click','#dir_ordenes', function(e){
        e.preventDefault();
        
       $(location).attr('href', 'ordenes_medicas'); 
    });
});

$(function(){
    $('.sidebar').on('click','#dir_medicamentos', function(e){
        e.preventDefault();
        
       $(location).attr('href', 'medicamentos');         
    });
});


$(function(){
    $('.sidebar').on('click','#dir_stock_papeleria', function(e){
        e.preventDefault();
        
       $(location).attr('href', 'stock_papeleria');         
    });
});


$(function(){
    $('.sidebar').on('click','#dir_stock_ornato', function(e){
        e.preventDefault();
        
       $(location).attr('href', 'stock_ornato'); 
    });
});

$(function(){
    $('.sidebar').on('click','#dir_stock_computo', function(e){
        e.preventDefault();
        
       $(location).attr('href', 'stock_computo');         
    });
});

/*$( document ).ready(function() {
    var total = 0;
    $("#tVales tr").find('td:eq(7)').each(function () {

          codigo = $(this).html();

          valor = parseFloat(codigo);
             total += valor;
    })
     $('#total').val(total);
});*/


/*function SumarColumna() {
 
    // asumiendo que tabla es la referencia de la tabla que contiene las descripciones;
    // y la cuarta celda de cada fila es el sutbotal;
    var total = 0;
    for(var i = 0; tVales.rows[i]; i++)
    total += Number(tVales.rows[i].cells[7].innerHTML);
    alert(total);
}   */