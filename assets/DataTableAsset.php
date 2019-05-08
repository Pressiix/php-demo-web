<!--- DataTable Assets -->
<!--- CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap.min.css">
<!--- Javascript -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

<script type="text/javascript">
/** MIN MAX ********/  
  $.fn.dataTable.ext.search.push(
      function( settings, data, dataIndex ) {
          var min = parseInt( $('#min').val(), 10 );
          var max = parseInt( $('#max').val(), 10 );
          var age = parseFloat( data[3] ) || 0; // use data for the age column
  
          if ( ( isNaN( min ) && isNaN( max ) ) ||
              ( isNaN( min ) && age <= max ) ||
              ( min <= age   && isNaN( max ) ) ||
              ( min <= age   && age <= max ) )
          {
              return true;
          }
          return false;
      }
  );

  /***** Loader animation *****/
    function myFunction() 
    {
      setTimeout(showPage, 1000);
    }

    function showPage() 
    {
      document.getElementById("loader").style.display = "none";
      document.getElementById("myDiv").style.display = "inline-block";
    }

    //******* SHOW MESSAGE AFTER ACTION *******/
    $(window).bind("load", function() 
    {
      var qd = {};
      if (location.search)
      {
        location.search.substr(1).split("&").forEach(function(item) {var s = item.split("="), k = s[0], v = s[1] && decodeURIComponent(s[1]); (qd[k] = qd[k] || []).push(v)})
      } 
      if(typeof qd.message !== 'undefined')
      {
        alert(qd.message);
      }
    });

    /** Question before delete user ********/
    function beforeDelete() {
      var href = $(this).attr('href');
      var r = confirm("Are you sure you want to delete ?");
      if(r == true)
      {
        window.location.href = document.getElementById("delete").href;
      }
      else{
        event.preventDefault();
      }
    }
  </script>

<style>
     select > option {
      color: #7c7979;
      text-align-last:center;
      padding-right: 45%;
    } 
    input[type="number"],input ,select {
      height:40px;
      text-align:center;
      text-align-last:center;
    }
  </style>