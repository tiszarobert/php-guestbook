<?php
include('guestbook.class.php');
$guestbook = new GuestBook();
if(isset($_POST['list']))$guestbook->List();
if(isset($_POST['save']))$guestbook->Save($_POST['name'],$_POST['message']);
?>