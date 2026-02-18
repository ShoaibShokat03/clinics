<?php  
$insert = false;
$update = false;
$delete = false;

$servername = "localhost";
$username = "root";
$password = "";
$database = "hospital_bot";

// Connect to database
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
}

// DELETE
if(isset($_GET['delete'])){
  $id = intval($_GET['delete']);
  $sql = "DELETE FROM `patients` WHERE `id` = $id";
  $result = mysqli_query($conn, $sql);
  if($result) $delete = true;
}

// POST (INSERT / UPDATE)
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['idEdit'])) {
        // UPDATE
        $id = intval($_POST['idEdit']);
        $name = mysqli_real_escape_string($conn, $_POST["nameEdit"]);
        $phone = mysqli_real_escape_string($conn, $_POST["phoneEdit"]);
        $address = mysqli_real_escape_string($conn, $_POST["addressEdit"]);
        $gender = mysqli_real_escape_string($conn, $_POST["genderEdit"]);
        $dob = mysqli_real_escape_string($conn, $_POST["dobEdit"]);

        $sql = "UPDATE `patients` SET `name`='$name', `phone`='$phone', `address`='$address', `gender`='$gender', `dob`='$dob' WHERE `id`=$id";
        $result = mysqli_query($conn, $sql);
        if($result) $update = true;
        else echo "Update failed: ".mysqli_error($conn);
    } else {
        // INSERT
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
        $address = mysqli_real_escape_string($conn, $_POST["address"]);
        $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
        $dob = mysqli_real_escape_string($conn, $_POST["dob"]);

        if(empty($name) || empty($phone) || empty($address) || empty($gender) || empty($dob)){
            echo "Please fill in all fields.";
        } else {
            $sql = "INSERT INTO `patients` (`name`,`phone`,`address`,`gender`,`dob`) VALUES ('$name','$phone','$address','$gender','$dob')";
            $result = mysqli_query($conn, $sql);
            if($result) $insert = true;
            else echo "Insert failed: ".mysqli_error($conn);
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>iPatients - Manage Patients</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">iPatients</a>
</nav>

<!-- Alerts -->
<div class="container mt-3">
<?php if($insert) echo "<div class='alert alert-success'>Patient added successfully!</div>"; ?>
<?php if($update) echo "<div class='alert alert-success'>Patient updated successfully!</div>"; ?>
<?php if($delete) echo "<div class='alert alert-info'>Patient deleted successfully!</div>"; ?>
</div>

<!-- Add Patient Modal -->
<div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="data.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Add Patient</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>

          <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" class="form-control" name="dob" required>
          </div>

          <div class="form-group">
            <label>Gender</label>
            <select class="form-control" name="gender" required>
              <option value="">Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" name="phone" required>
          </div>

          <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="address" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Patient</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Patient Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="data.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Edit Patient</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="idEdit" id="idEdit">

          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" id="nameEdit" name="nameEdit" required>
          </div>

          <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" class="form-control" id="dobEdit" name="dobEdit" required>
          </div>

          <div class="form-group">
            <label>Gender</label>
            <select class="form-control" id="genderEdit" name="genderEdit" required>
              <option value="">Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" id="phoneEdit" name="phoneEdit" required>
          </div>

          <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" id="addressEdit" name="addressEdit" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Patients Table -->
<div class="container my-4">
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>S.No</th>
        <th>Name</th>
        <th>DOB</th>
        <th>Gender</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $sql = "SELECT * FROM `patients`";
      $result = mysqli_query($conn, $sql);
      $sno = 1;
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
          <th>{$sno}</th>
          <td>{$row['name']}</td>
          <td>{$row['dob']}</td>
          <td>{$row['gender']}</td>
          <td>{$row['phone']}</td>
          <td>{$row['address']}</td>
          <td>
            <button class='edit btn btn-sm btn-primary' id='{$row['id']}'>Edit</button>
            <button class='delete btn btn-sm btn-danger' id='d{$row['id']}'>Delete</button>
          </td>
        </tr>";
        $sno++;
      }
    ?>
    </tbody>
  </table>
</div>

<!-- Floating Add Button -->
<button id="addPatientBtn" class="btn btn-success" 
        style="position: fixed; bottom: 30px; right: 30px; border-radius: 50%; font-size: 24px; width: 60px; height: 60px;">
  +
</button>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
  $('#myTable').DataTable();
});

// Floating Add Button opens Add Modal
document.getElementById('addPatientBtn').addEventListener('click', function(){
  $('#addPatientModal').modal('show');
});

// Edit modal
const nameEdit = document.getElementById('nameEdit');
const phoneEdit = document.getElementById('phoneEdit');
const dobEdit = document.getElementById('dobEdit');
const genderEdit = document.getElementById('genderEdit');
const addressEdit = document.getElementById('addressEdit');
const idEdit = document.getElementById('idEdit');

Array.from(document.getElementsByClassName('edit')).forEach((element) => {
  element.addEventListener("click", (e) => {
    const tr = e.target.closest('tr');
    nameEdit.value = tr.children[1].innerText;
    dobEdit.value = tr.children[2].innerText;
    genderEdit.value = tr.children[3].innerText;
    phoneEdit.value = tr.children[4].innerText;
    addressEdit.value = tr.children[5].innerText;
    idEdit.value = e.target.id;
    $('#editModal').modal('show');
  });
});

// Delete button
Array.from(document.getElementsByClassName('delete')).forEach((element) => {
  element.addEventListener("click", (e) => {
    const id = e.target.id.substr(1);
    if(confirm("Are you sure you want to delete this patient?")){
      window.location = `index.php?delete=${id}`;
    }
  });
});
</script>
</body>
</html>
