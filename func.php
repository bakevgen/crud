<?php
include 'config.php';

$name = $_POST['name'];
$author = $_POST['author'];
$year = $_POST['year'];

// Create

if (isset($_POST['submit'])) {
	$sql = ("INSERT INTO `books`(`name`, `author`, `year`) VALUES(?,?,?)");
	$query = $pdo->prepare($sql);
	$query->execute([$name, $author, $year]);
	$success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Данные успешно отправлены!</strong> Вы можете закрыть это сообщение.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	
}

// Read

$sql = $pdo->prepare("SELECT * FROM `books`");
$sql->execute();
$result = $sql->fetchAll();

// Update
$edit_name = $_POST['edit_name'];
$edit_author = $_POST['edit_author'];
$edit_year = $_POST['edit_year'];
$get_id = $_GET['id'];
if (isset($_POST['edit-submit'])) {
	$sqll = "UPDATE books SET name=?, author=?, year=? WHERE id=?";
	$querys = $pdo->prepare($sqll);
	$querys->execute([$edit_name, $edit_author, $edit_year, $get_id]);
	header('Location: '. $_SERVER['HTTP_REFERER']);
}

// DELETE
if (isset($_POST['delete_submit'])) {
	$sql = "DELETE FROM books WHERE id=?";
	$query = $pdo->prepare($sql);
	$query->execute([$get_id]);
	header('Location: '. $_SERVER['HTTP_REFERER']);
}
