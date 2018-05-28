<?php
require_once('init.php');


if(isset($_POST['update']) && isset($_GET['id'])){
  $id = $_GET['id'];
  $primaryphone = $_POST['primaryphone'];
  $secondaryphone = $_POST['secondaryphone'];
  $mobilephone = $_POST['mobilephone'];
  $name = $_POST['name'];

  $sql = "UPDATE users SET name='$name', primaryphone='$primaryphone', secondaryphone='$secondaryphone', mobilephone='$mobilephone' WHERE id=$id";

  if ($conn->query($sql) === TRUE) {

  } else {
    echo "Error updating record: " . $conn->error;
  }
}

if(isset($_POST['delete']) && isset($_GET['id'])){

  $id = $_GET['id'];
  $sql = "DELETE FROM users WHERE id=$id";

  if ($conn->query($sql) === TRUE) {

  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

$sql = "SELECT * FROM users";
$get_users = $conn->query($sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <link REL="SHORTCUT ICON" HREF="https://msmcrm.morgensternmarketing.com/layouts/vlayout/skins/images/favicon.ico">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Morgenstern PBX Directory</title>
</head>
<body>
  <div class="container py-5">
    <div class="row">
      <div class="col-12">
        <h1>Morgenstern Directory</h1>
      </div>
    </div>
    <div class="row py-3">
      <div class="col-12">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Show Contacts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Add Contact</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <?php if ($get_users->num_rows > 0) { ?>
              <table id="contact_table" class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Contact Name</th>
                    <th>Primary Phone</th>
                    <th>Secondary Phone</th>
                    <th>Mobile Phone</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // output data of each row
                  $counter = 1;
                  while($row_user = $get_users->fetch_assoc()) {
                    echo "<tr>
                    <form action='index.php?id=". $row_user["id"]."' method='POST'>
                    <td>" .$counter. "</td>
                    <td><div class='invisible font-size-0'>" . $row_user["name"]. "</div><input type='text' id='cname' value='" . $row_user["name"]. "' name='name' class='form-control'></td>
                    <td><div class='invisible font-size-0'>" . $row_user["primaryphone"]. "</div><input type='text' id='primarynum' value='" . $row_user["primaryphone"]. "' name='primaryphone' class='form-control'></td>
                    <td><div class='invisible font-size-0'>" . $row_user["secondaryphone"]. "</div><input type='text' id='secondaryphone' value='" . $row_user["secondaryphone"]. "' name='secondaryphone' class='form-control'></td>
                    <td><div class='invisible font-size-0'>" . $row_user["mobilephone"]. "</div><input type='text' id='mobilephone' value='" . $row_user["mobilephone"]. "' name='mobilephone' class='form-control'></td>
                    <td class='text-center' style='width:100px;'>
                    <input type='submit' name='update' id='updatebtn' class='btn btn-primary fa d-inline-block' value='&#xf0c7;'>
                    <input type='submit' name='delete' id='deletebtn' class='btn btn-danger fa d-inline-block' value='&#xf2ed;'>
                    </td>
                    </form>
                    </tr>";
                    $counter++;
                  }

                  ?>
                </tbody>
              </table>
              <?php
            } else {
              echo "0 results";
            }
            ?>
          </div>
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="card card-body bg-light">
              <div class="alert alert-success d-none" id='alertsuccess' role="alert">
                Contact successfully added
              </div>
              <div class="alert alert-danger d-none" id='alertfail' role="alert">
                Contact insertion failed. Try again.
              </div>
    
              <form action="insert-data.php" method="post">
           
                <div class="form-group">
                  <label for="contactname">Contact Name</label>
                  <input type="text" class="form-control" name="contactname" id="contactname_ins" placeholder="Enter name here" required>
                </div>
                <div class="form-group">
                  <label for="primaryphone">Primary phone</label>
                  <input type="text" class="form-control" name="primaryphone" id="primaryphone_ins" placeholder="Enter primary phone">
                </div>
                <div class="form-group">
                  <label for="secondaryphone">Secondary Phone</label>
                  <input type="text" class="form-control" name="secondaryphone" id="secondaryphone_ins" placeholder="Enter secondary phone">
                </div>
                <div class="form-group">
                  <label for="mobphone">Mobile Phone</label>
                  <input type="text" class="form-control" name="mobphone" id="mobphone_ins" placeholder="Enter mobile phone">
                </div>
                <button type="submit" class="btn btn-primary" name="insert-data" id="insert-data">Save Contact</button>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

  <script>
  $(document).ready(function() {
    $('#contact_table').DataTable({
       "columnDefs": [
          { "orderable": false, "targets": 5 }
        ],

    });
    $('#contact_table_length').append("<a href='<?=$url?>' class='btn btn-primary ml-2'>Refresh</a>");

    $("input#deletebtn").click(function(e){
         if(!confirm('Are you sure?')){
            e.preventDefault();
            return false;
        }
        return true;
    });

  });

  let searchParams = new URLSearchParams(window.location.search);

  if(searchParams.has('action') && searchParams.has('status')){

    if(searchParams.get('action') == 'insert' && searchParams.get('status') == 'ok'){
      $('#nav-home-tab').removeClass('active show');
      $('#nav-home').removeClass('active show');
      $('#nav-profile-tab').addClass('active show');
      $('#nav-profile').addClass('active show');
      $('#alertsuccess').removeClass('d-none');
    }

    if(searchParams.get('action') == 'insert' && (searchParams.get('status') == 'err_db' || searchParams.get('status') == 'e_fields')){
      $('#nav-home-tab').removeClass('active show');
      $('#nav-home').removeClass('active show');
      $('#nav-profile-tab').addClass('active show');
      $('#nav-profile').addClass('active show');
      $('#alertfail').removeClass('d-none');
    }
  }

  </script>
</body>
</html>
