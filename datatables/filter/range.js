/**
 * Filter a column on a specific date range. Note that you will likely need 
 * to change the id's on the inputs and the columns in which the start and 
 * end date exist.
 *
 *  @name Date range filter
 *  @summary Filter the table based on two dates in different columns
 *  @author _guillimon_
 *
 *  @example
 *    $(document).ready(function() {
 *        var table = $('#example').DataTable();
 *         
 *        // Add event listeners to the two range filtering inputs
 *        $('#min').keyup( function() { table.draw(); } );
 *        $('#max').keyup( function() { table.draw(); } );
 *    } );
 */
$.fn.dataTableExt.afnFiltering.push(
    function( oSettings, aData, iDataIndex ) {
        var iFini = document.getElementById('min').value;
        var iFfin = document.getElementById('max').value;
        var iStartDateCol = 1;
        var iEndDateCol = 1;
 
        iFini=iFini.substring(6,10) + iFini.substring(3,5)+ iFini.substring(0,2);
        iFfin=iFfin.substring(6,10) + iFfin.substring(3,5)+ iFfin.substring(0,2);
 
        var datofini=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
        var datoffin=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);
 
        if ( iFini === "" && iFfin === "" )
        {
            return true;
        }
        else if ( iFini <= datofini && iFfin === "")
        {
            return true;
        }
        else if ( iFfin >= datoffin && iFini === "")
        {
            return true;
        }
        else if (iFini <= datofini && iFfin >= datoffin)
        {
            return true;
        }
        return false;
    }
);

$(document).ready(function() {
      var tVales = $('#tVales').DataTable();
 
      // Add event listeners to the two range filtering inputs
      $('#min').keyup( function() { tVales.draw(); } );
      $('#max').keyup( function() { tVales.draw(); } );

      var tRecargas = $('#tRecargas').DataTable();
 
      // Add event listeners to the two range filtering inputs
      $('#min').keyup( function() { tRecargas.draw(); } );
      $('#max').keyup( function() { tRecargas.draw(); } );

       var tOrdenMedica = $('#tOrdenMedica').DataTable();
 
      // Add event listeners to the two range filtering inputs
      $('#min').keyup( function() { tOrdenMedica.draw(); } );
      $('#max').keyup( function() { tOrdenMedica.draw(); } );

      var tMedicamentos = $('#tMedicamentos').DataTable();
 
      // Add event listeners to the two range filtering inputs
      $('#min').keyup( function() { tMedicamentos.draw(); } );
      $('#max').keyup( function() { tMedicamentos.draw(); } );

      var tRefacciones = $('#tRefacciones').DataTable();
 
      // Add event listeners to the two range filtering inputs
      $('#min').keyup( function() { tRefacciones.draw(); } );
      $('#max').keyup( function() { tRefacciones.draw(); } );

      var tLubricantes = $('#tLubricantes').DataTable();
 
      // Add event listeners to the two range filtering inputs
      $('#min').keyup( function() { tLubricantes.draw(); } );
      $('#max').keyup( function() { tLubricantes.draw(); } );

      var tLubricantes = $('#tEntradas').DataTable();
 
      // Add event listeners to the two range filtering inputs
      $('#min').keyup( function() { tLubricantes.draw(); } );
      $('#max').keyup( function() { tLubricantes.draw(); } );
  } );