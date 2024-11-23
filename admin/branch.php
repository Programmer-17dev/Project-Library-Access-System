<?php

include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';

$act = (isset($_GET['act']) ? $_GET['act'] : '');
// สร้างเงื่อนไขเรียกใช่ไฟล์
if ($act == 'add') {
    include 'branch_form_add.php';
} else if ($act == 'delete') {
    include 'branch_delete.php';
} else if ($act == 'edit') {
    include 'branch_form_edit.php';
} else {
    include 'branch_list.php';
}
include 'up-Down.php';
include 'footer.php';
