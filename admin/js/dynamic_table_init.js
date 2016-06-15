function fnFormatDetails ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table class="table-bordered mytab table-condensed" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;width:100%;text-align:center">';
   // sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';

   //<td>'+aData[2]+' '+aData[4]+'</td>


   sOut += '<tr><h5><b>Paid By :</b></h5></tr>';
    sOut += '<tr><th style="width:10%;">Name</th><th style="width:10%;">Contact No</th><th style="width:10%;">Email</th><th style="width:10%;">Apt No</th><th style="width:10%;">Street</th><th style="width:10%;">State</th><th style="width:10%;">City</th><th style="width:10%;">Zip Code</th><th style="width:10%;">Account No</th><th style="width:10%;">Transaction Date</th></tr>';
    sOut += '<tr><td>'+aData[2]+'</td><td>'+aData[9]+'</td><td>'+aData[10]+'</td><td>'+aData[11]+'</td><td>'+aData[12]+'</td><td>'+aData[13]+'</td><td>'+aData[14]+'</td><td>'+aData[15]+'</td><td>'+aData[16]+'</td><td>'+aData[17]+'</td></tr>';
  //  sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
    sOut += '</table> <table class="table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;width:100%;text-align:center">';
     sOut += '<tr><h5><b>Paid To :</b></h5></tr>';
    sOut += '<tr><th style="width:10%;">Name</th><th style="width:10%;">Contact No</th><th style="width:10%;">Email</th><th style="width:10%;">Apt No</th><th style="width:10%;">Street</th><th style="width:10%;">State</th><th style="width:10%;">City</th><th style="width:10%;">Zip Code</th><th style="width:20%;">Expected Payment Date</th></tr>';
    sOut += '<tr><td>'+aData[3]+'</td><td>'+aData[18]+'</td><td>'+aData[19]+'</td><td>'+aData[20]+'</td><td>'+aData[21]+'</td><td>'+aData[22]+'</td><td>'+aData[23]+'</td><td>'+aData[24]+'</td><td>'+aData[25]+'</td></tr>';
  //  sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {
  $('.print1').click(function(){
window.location.href="printmytable.php";
});

    $('#dynamic-table').dataTable( {
        "aaSorting": [[ 1, "asc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    nCloneTd.innerHTML = '<img src="images/details_open.png">';
   /* nCloneTd.css({'vertical-align':'middle','width':'10%'});*/
   // nCloneTd.className = "center";
    nCloneTd.className = "mytd";
$('.mytd').css('width','10% !important');
    $('#hidden-table-info thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

    $('#hidden-table-info tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#hidden-table-info').dataTable( {
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $(document).on('click','#hidden-table-info tbody td img',function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
        }
    } );
} );