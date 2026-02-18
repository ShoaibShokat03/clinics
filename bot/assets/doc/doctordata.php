<?php
$insert = false;
$update = false;
$delete = false;

$servername = "localhost";
$username = "root";
$password = "";
$database = "hospital_bot";

// Connect to the database
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
}

// DELETE operation
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM `doctors` WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);
    if($result) $delete = true;
}

// POST (INSERT / UPDATE) 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['idEdit'])) {
        // UPDATE
        $id = intval($_POST['idEdit']);
        $name = mysqli_real_escape_string($conn, $_POST["nameEdit"]);
        $specialty = mysqli_real_escape_string($conn, $_POST["specialtyEdit"]);
        $phone = mysqli_real_escape_string($conn, $_POST["phoneEdit"]);
        $department_id = intval($_POST["departmentEdit"]);

        $sql = "UPDATE `doctors` SET `name`='$name', `specialty`='$specialty', `phone`='$phone', `department_id`=$department_id  WHERE `id`=$id";
        $result = mysqli_query($conn, $sql);
        if($result) $update = true;
        else echo "Update failed: ".mysqli_error($conn);
    } else {
        // INSERT
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $specialty = mysqli_real_escape_string($conn, $_POST["specialty"]);
        $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
        $department_id = intval($_POST["department"]);

        if(empty($name) || empty($specialty) || empty($phone) || empty($department_id)){
            echo "Please fill in all fields.";
        } else {
            $sql = "INSERT INTO `doctors` (`name`,`specialty`,`phone`,`department_id`) 
                    VALUES ('$name','$specialty','$phone',$department_id)";
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
  <title>Doctors - Manage</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Doctors</a>
</nav>

<div class="container mt-3">
<?php if($insert) echo "<div class='alert alert-success'>Doctor added successfully!</div>"; ?>
<?php if($update) echo "<div class='alert alert-success'>Doctor updated successfully!</div>"; ?>
<?php if($delete) echo "<div class='alert alert-info'>Doctor deleted successfully!</div>"; ?>
</div>

<div class="modal fade" id="addDoctorModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="doctordata.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Add Doctor</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>

          <div class="form-group">
            <label>Specialty</label>
            <input type="text" class="form-control" name="specialty" required>
          </div>

          <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" name="phone" required>
          </div>

          <div class="form-group">
            <label>Department</label>
            <select class="form-control" name="department" required>
              <option value="">Select Department</option>
              <?php
                $dept_sql = "SELECT * FROM department";
                $dept_result = mysqli_query($conn, $dept_sql);
                while($dept = mysqli_fetch_assoc($dept_result)){
                  echo "<option value='".$dept['id']."'>".$dept['name']."</option>";
                }
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Doctor</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="doctor.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Edit Doctor</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="idEdit" id="idEdit">

          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" id="nameEdit" name="nameEdit" required>
          </div>

          <div class="form-group">
            <label>Specialty</label>
            <input type="text" class="form-control" id="specialtyEdit" name="specialtyEdit" required>
          </div>

          <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" id="phoneEdit" name="phoneEdit" required>
          </div>

          <div class="form-group">
            <label>Department</label>
            <select class="form-control" id="departmentEdit" name="departmentEdit" required>
              <option value="">Select Department</option>
              <?php
                $dept_sql = "SELECT * FROM department";
                $dept_result = mysqli_query($conn, $dept_sql);
                while($dept = mysqli_fetch_assoc($dept_result)){
                  echo "<option value='".$dept['id']."'>".$dept['name']."</option>";
                }
              ?>
            </select>
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

<div class="container my-4">
    <p>hi</p> 
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>S.No</th>
        <th>Name</th>
        <th>Specialty</th>
        <th>Phone</th>
        <th>Department</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    // This is the section that fetches and displays data.
    // It will appear empty if the database table is empty.
    $sql = "SELECT d.*, dept.name AS department_name 
              FROM doctors d 
              LEFT JOIN department dept ON d.department_id = dept.id";
    $result = mysqli_query($conn, $sql);
    $sno = 1;
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
            <th>{$sno}</th>
            <td>{$row['name']}</td>
            <td>{$row['specialty']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['department_name']}</td>
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

<button id="addDoctorBtn" class="btn btn-success" 
        style="position: fixed; bottom: 30px; right: 30px; border-radius: 50%; font-size: 24px; width: 60px; height: 60px;">
  +
</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
  $('#myTable').DataTable();
});

// Floating Add Button
document.getElementById('addDoctorBtn').addEventListener('click', function(){
  $('#addDoctorModal').modal('show');
});

// Edit Modal
const nameEdit = document.getElementById('nameEdit');
const specialtyEdit = document.getElementById('specialtyEdit');
const phoneEdit = document.getElementById('phoneEdit');
const departmentEdit = document.getElementById('departmentEdit');
const idEdit = document.getElementById('idEdit');

Array.from(document.getElementsByClassName('edit')).forEach((element) => {
  element.addEventListener("click", (e) => {
    const tr = e.target.closest('tr');
    nameEdit.value = tr.children[1].innerText;
    specialtyEdit.value = tr.children[2].innerText;
    phoneEdit.value = tr.children[3].innerText;
    let dept = tr.children[4].innerText;
    // select correct option
    for (let option of departmentEdit.options) {
      if(option.text === dept){
        option.selected = true;
        break;
      }
    }
    idEdit.value = e.target.id;
    $('#editModal').modal('show');
  });
});

// Delete Button
Array.from(document.getElementsByClassName('delete')).forEach((element) => {
  element.addEventListener("click", (e) => {
    const id = e.target.id.substr(1);
    if(confirm("Are you sure you want to delete this doctor?")){
      window.location = `doctor.php?delete=${id}`;
    }
  });
});
</script>
</body>
</html>