<?php

session_start();

if (!isset($_SESSION['access_granted']) || $_SESSION['access_granted'] !== true) {
    header("Location: Home_page.php");
    exit;
}


if (!isset($_SESSION['access_granted'])) {
    header("Location: Home_page.php");
    exit;
}
include "db.php";

/* ADD UNIT */
if(isset($_POST['add'])) {
    $unit = $_POST['unit'];
    $lcp = $_POST['lcp'];

    $conn->query("INSERT INTO honda_units (units, lcp) VALUES ('$unit', '$lcp')");
}

/* DELETE UNIT */
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM honda_units WHERE unit_id=$id");
}

/* UPDATE UNIT */
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $unit = $_POST['unit'];
    $lcp = $_POST['lcp'];

    $conn->query("UPDATE honda_units 
SET units='$unit', lcp='$lcp' 
WHERE unit_id='$id'");
}

/* GET EDIT DATA */
$editData = null;
if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM honda_units WHERE unit_id=$id");
    $editData = $res->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script>
(function () {
    history.pushState(null, null, location.href);

    window.addEventListener('popstate', function () {
        window.location.href = "Homepage.php";
    });
})();
</script>
<title>Access Page - Honda Units</title>

<style>
body{
  font-family: Arial;
  background:#f4f4f4;
  margin:0;
  padding:20px;
}

.container{
  max-width:800px;
  margin:auto;
  background:white;
  padding:20px;
  border-radius:10px;
  box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

input, button{
  width:100%;
  padding:10px;
  margin:5px 0;
}

button{
  background:red;
  color:white;
  border:none;
  cursor:pointer;
}

table{
  width:100%;
  border-collapse:collapse;
  margin-top:20px;
}

th, td{
  border:1px solid #ddd;
  padding:10px;
  text-align:center;
}

a{
  text-decoration:none;
  padding:5px 10px;
  border-radius:5px;
}

.edit{
  background:orange;
  color:white;
}

.delete{
  background:red;
  color:white;
}
</style>
</head>

<body>

<div class="container">
<div style="text-align:right; margin-bottom:10px;">
    <a href="logout.php" style="
        background:red;
        color:white;
        padding:8px 12px;
        border-radius:6px;
        text-decoration:none;
        font-size:14px;
    ">
        Logout
    </a>
</div>
<h2>Honda Units Management</h2>

<!-- ADD / EDIT FORM -->
<form method="POST">

<?php if($editData): ?>
    <input type="hidden" name="id" value="<?= $editData['unit_id'] ?>">
<?php endif; ?>

<input type="text" name="unit" placeholder="Motorcycle Unit"
value="<?= $editData['units'] ?? '' ?>" required>

<input type="number" name="lcp" placeholder="LCP"
value="<?= $editData['lcp'] ?? '' ?>" required>

<?php if($editData): ?>
    <button name="update">Update Unit</button>
    <a href="access_page.php">Cancel</a>
<?php else: ?>
    <button name="add">Add Unit</button>
<?php endif; ?>

</form>

<!-- TABLE LIST -->
<table>
<tr>
  <th>Unit</th>
  <th>LCP</th>
  <th>Actions</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM honda_units ORDER BY unit_id DESC");
while($row = $result->fetch_assoc()):
?>

<tr>
  <td><?= $row['units'] ?></td>
  <td>₱<?= number_format($row['lcp']) ?></td>
  <td>
    <a class="edit" href="?edit=<?= $row['unit_id'] ?>">Edit</a>
    <a class="delete" href="?delete=<?= $row['unit_id'] ?>" onclick="return confirm('Delete this unit?')">Delete</a>
  </td>
</tr>

<?php endwhile; ?>

</table>

</div>

</body>
</html>