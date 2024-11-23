<?php

include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';

$act = (isset($_GET['act']) ? $_GET['act'] : '');
// สร้างเงื่อนไขเรียกใช่ไฟล์
if ($act == 'add') {
    include 'faculty_form_add.php';
} else if ($act == 'delete') {
    include 'faculty_delete.php';
} else if ($act == 'edit') {
    include 'faculty_form_edit.php';
} else {
    include 'faculty_list.php';
}
include 'up-Down.php';
include 'footer.php';
