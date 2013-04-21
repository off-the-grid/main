<?php

ob_start(); // Turning on output buffering to avoid HTML characters...

session_start();

include_once '../db/GenericDAO.php';

include_once '../classes/Group.php';
include_once '../classes/Person.php';


$group = new Group();
$group->name = $_POST['colony_name'];

$groupDAO = GenericDAO::getInstanceForTable("Group");
$groupDAO->create($group);

$population = $_POST['population'];

for ($i = 0; $i < $population; $i++) {
    $group->persons[$i] = new Person($group->id, $i);
}

$_SESSION['colony_id'] = $group->id;

ob_end_clean(); // ... (even spaces between PHP directives) before header() call

header("Location: ../html/skills_repartition.php");

?>
