<?php
 include '../connect.php';
 $user_id = filterRequest('user_id');
 $where = "notification_user_id = '$user_id' ORDER BY notification_date DESC";
 getAllData('notifications',$where);
;?>