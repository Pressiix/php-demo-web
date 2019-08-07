<?php 
  include_once("nav.php"); 
  include_once("assets/DataTableAsset.php"); 
  include_once("helpers/UserData.php");
  $tile = "User List";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
 <title><?= $tile; ?></title>
 <link rel="stylesheet" href="css/custom-datatable.css">
 <link rel="stylesheet" href="css/loader.css">
 <link rel="stylesheet" href="css/form-modal.css">
 <style>
    .dataTables_wrapper .dt-buttons {
      float:right;
      height:50px;
    }
    td:nth-child(2) {
  width: 100px;
  max-width: 100px;
}
  </style>
</head>
<script type="text/javascript">
/** CUSTOMIZE DATATABLE ********/
    $(document).ready(function() {
      var table = $('#demo-table').DataTable( {
          columnDefs: [
              { orderable: false, "targets": 4 }
          ],
          orderCellsTop: true,
          fixedHeader: true,ordering:true,
          bLengthChange : true,
          dom: 'Bfrtip',
          buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 4, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                  columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                },
              //-------------------------- 
              customize : function(doc) {
                doc.styles['td:nth-child(2)'] = { 
                  width: '100px',
                  'max-width': '100px'
                }
              }
            },
            'colvis',
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                },
                title: 'User Data',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:350; left:220;" />'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            } 
        ]
        } );

      $('#demo-table thead tr:eq(1) th').each( function (i) {
        
        if($(this).text() != "Action" )
        {
          var title = $(this).text();
          $(this).html( '<input type="text" placeholder="Search '+title+'" autocomplete="off">' );
  
          $( 'input', this ).on( 'keyup change', function () {
              if ( table.column(i).search() !== this.value ) {
                  table
                      .column(i)
                      .search( this.value )
                      .draw();
              }
          } );
        }
        else
        {
          var title = "";
          $(this).html('<a href="user_list.php" data-toggle="modal" data-target="#create-user-modal" class="btn btn-success" role="button" style="border-radius: 18px;width:70px;"><span class="glyphicon glyphicon-plus"></span></a>');
        }
      } );
    } );
</script>
<?php 
 if(isset($_SESSION['Username']) && isset($_SESSION['Status']) && $_SESSION['Status'] == 'ADMIN')
 {  
    $result = UserData::findOnlyUser();
    $user_name =  array_column($result,'Username');
    $user_id = array_column($result,'UserID');
      
?>
      <body onload="myFunction()" style="margin:0;font-family: 'Comic Sans MS', cursive, sans-serif;">
      <div class="container col-md-12 text-left">
          <h2>&nbsp<b>User Data</b></h2>
          <h5>&nbsp<?= date('l j F Y'); ?></h5>
      </div>
    <!-- CREATE USER MODAL -->
      <div class="modal fade" id="create-user-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="font-family: 'Comic Sans MS', cursive, sans-serif;display: none;">
    	  <div class="modal-dialog">
				<div class="formmodal-container" style="background-color:#98464D;">
					<h1 style="color:white;">Create User</h1><br>
				  <form  method="post" action="create_user.php" name="create-user-form" id="create-user-form">
              <input name="createFirstname" type="text" placeholder="First name" id="createFirstname" autocomplete="off" required>
              <input name="createLastname" type="text" placeholder="Last name" id="createLastname" autocomplete="off" required>
              <input name="createUsername" type="text" placeholder="Username" id="createUsername" autocomplete="off" required>  
              <input name="createPassword" type="password" placeholder="Password" id="createPassword" autocomplete="off" 
                    pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Password must contain number and letter, and at least 8 or more characters" required>
                    <br/>
              <select name="createStatus" id="createStatus" class="selectBox col-md-12" style="height:44px;font-family: 'Comic Sans MS', cursive, sans-serif;" required>
                <option value="" hidden>Add Role</option>
                <option value="ADMIN">ADMIN</option>
                <option value="USER">USER</option>
              </select>
              <?php
              if($user_name){
                foreach($user_name as $username)
                {
                  echo '<input type="hidden" name="user_name[]" value="'. $username. '">';
                }
              }
              ?>
              <br/><br/><br/>
              <input type="submit" id="create-user-submit" name="create-user-submit" value="Create" class="btn btn-success" style="border-radius: 18px;">
          </form>
				</div>
			</div>
      </div>

          <div id="loader"></div>
          <div style="display:block;" id="myDiv" class="animate-bottom" style="display: none;text-align: center;">
          <div class="container-fluid col-md-12">
          <table class="table table-hover text-center" id="demo-table" >
              <thead class="thead-red">
                <tr class="d-flex">
                  <th>ID</th>
                  <th>Full Name</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
                <tr class="search-header">
                  <th>ID</th>
                  <th>Full Name</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
<?php 
        foreach($result as $user)
        { 
?>
                    <tr class="d-flex">
                      <td class="col-md-1"><?= $user["UserID"]; ?></td>
                      <td class="col-md-2"><?= $user["Name"]; ?></td>
                      <td class="col-md-2"><?= $user["Username"]; ?></td>
                      <td class="col-md-2"><?= $user["Status"]; ?></td>
                      <td class="col-md-2">
                        <a href="#edit-user-modal<?= $user["UserID"];?>" data-toggle="modal" class="btn btn-warning" role="button" style="border-radius: 18px;width:70px;"><span class="glyphicon glyphicon-pencil"></span></a>
                        &nbsp 
                        <a href="delete_user.php?UserID=<?= $user["UserID"]; ?>" id="delete" class="btn btn-danger" role="button" onclick="beforeDelete()" style="border-radius: 18px;width:70px;"><span class="glyphicon glyphicon-trash"></span></a>
                      </td>
                    </tr>
          <!-- EDIT USER MODAL -->
              <div class="modal fade text-left" id="edit-user-modal<?= $user["UserID"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="font-family: 'Comic Sans MS', cursive, sans-serif;display: none;">
                      <div class="modal-dialog">
                      <div class="formmodal-container" style="background-color:#98464D;">
                        <h1 style="color:white;">Edit user</h1>
                        <form  method="post" action="edit_user.php">
                           <h5 style="color:white;">Name</h5>
                            <input name="editName" type="text" placeholder="Name" id="editName" value="<?= $user["Name"]; ?>" required autocomplete="off">
                            <h5 style="color:white;">Username</h5>
                            <input name="disableEditUserName" type="text" placeholder="Username" id="disableEditUserName" value="<?= $user["Username"]; ?>" required disabled>  
                            <input name="editUsername" type="hidden" placeholder="Username" id="editUsername" value="<?= $user["Username"]; ?>" required>
                            <h5 style="color:white;">Password</h5>
                            <input name="editPassword" type="password" placeholder="Password" id="editPassword" value="<?= $user["Password"]; ?>"
                                  pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Password must contain number and letter, and at least 8 or more characters" required>
                                  <br/>
                            <h5 style="color:white;">Role</h5>   
                            <select name="editStatus" id="editStatus" class="selectBox col-md-12" style="height:44px;font-family: 'Comic Sans MS', cursive, sans-serif;" required>
                              <option value="" hidden style="color:#cbcfd6;"><?= $user["Status"]; ?></option>
                              <option value="ADMIN">ADMIN</option>
                              <option selected="selected" value="USER">USER</option>
                            </select>
                            <input type="hidden" name="UserID" value="<?= $user["UserID"]; ?>">
                            <br/><br/><br/><br/>
                            <input type="submit" name="Submit" value="Save" class="btn btn-success" style="border-radius: 18px;">
                        </form>
                      </div>
                    </div>
                    </div>
<?php       
        } 
?>
              </tbody>
            </table>
          </div>
          </div>
      </body>
<?php 
  }
else
{
  function myException($exception) {
    echo "<div class=\"container-fluid text-center\"><h2><b style=\"color:red;\">Exception:</b> " . $exception->getMessage()."</h2><div>";
  }
  
  set_exception_handler('myException');
  
  throw new Exception('Sorry!, You are not allow to access this page');
}
?>
</html>