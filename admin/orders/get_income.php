<?php

require_once '../../database/connect.php';

$max_date = $_GET['days'];
$arr = [];

if ($max_date == -1) {
    $sql = "select 
    DATE_FORMAT(created_at, '%m') as date,
    sum(total_price) as income
    from orders
    where status = 3
    group by DATE_FORMAT(created_at, '%m')";

    $result = mysqli_query($connect, $sql);
    $today = date("m");

    for ($i = 1; $i <= $today; $i++) {
        if ($i < 10) {
            $key = "0".$i;
        }
        else {
            $key = $i;
        }
        $arr[$key] = 0;
    }

    foreach ($result as $each) {
        $arr[$each['date']] = (float)$each['income'];
    }

} else if ($max_date == -2) {
    $sql = "select 
    DATE_FORMAT(created_at, '%Y') as date,
    sum(total_price) as income
    from orders
    where DATE(created_at) >= CURDATE() - INTERVAL 10 YEAR and status = 3
    group by DATE_FORMAT(created_at, '%Y')";

    $result = mysqli_query($connect, $sql);
    $today = date("Y");

    $start_year = date("Y", strtotime("-10 year"));
    $current_year = date("Y");

    for ($i = $start_year; $i <= $current_year; $i++) {
        $key = $i;
        $arr[$key] = 0;
    }
    foreach ($result as $each) {
        $arr[$each['date']] = (float)$each['income'];
    }
} else {
    $sql = "select 
    DATE_FORMAT(created_at, '%e-%m') as date,
    sum(total_price) as income
    from orders
    where DATE(created_at) >= CURDATE() - INTERVAL $max_date DAY and status = 3
    group by DATE_FORMAT(created_at, '%e-%m')";

    $result = mysqli_query($connect, $sql);
    $today = date("d");

    if ($today < $max_date) {
        $days_last_month = $max_date - $today;
        $last_month = date("m", strtotime("-1 month"));
        $last_month_date = date("Y-m-d", strtotime("-1 month"));
        $max_day_last_month = date("t", strtotime($last_month_date));
        $start_date_last_month = $max_day_last_month - $days_last_month;
        for ($i = $start_date_last_month; $i <= $max_day_last_month; $i++) {
            $key = $i . "-" . $last_month;
            $arr[$key] = 0;
        }
        $start_date_current_month = 1;
    } else if ($today == $max_date) {
        $start_date_current_month = 1;
    } else {
        $start_date_current_month = $today - $max_date;
    }
    $current_month = date("m");
    for ($i = $start_date_current_month; $i <= $today; $i++) {
        $key = $i . "-" . $current_month;
        $arr[$key] = 0;
    }
    foreach ($result as $each) {
        $arr[$each['date']] = (float)$each['income'];
    }
}


mysqli_close($connect);

echo json_encode($arr);