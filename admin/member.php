<?php

include 'header.php';
include 'navbar.php';
include 'sidebar_menu.php';

$act = (isset($_GET['act']) ? $_GET['act'] : '');
// สร้างเงื่อนไขเรียกใช่ไฟล์
if ($act == 'add') {
    include 'member_form_add.php';
} else if ($act == 'delete') {
    include 'member_delete.php';
} else if ($act == 'edit') {
    include 'member_form_edit.php';
} else {
    include 'member_list.php';
}

include 'up-Down.php';
include 'footer.php';