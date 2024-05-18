<?php
global $backend_routes;
session_start();
global $routes;
require '../../routes.php';
require '../../Utils.php';

include '../../model/OrderRepo.php';
include '../../model/AppointmentRepo.php';

global $image_routes;
$logo_image = $image_routes['logo_icon'];


$Dashboard = $routes['service_provider_dashboard'];
$All_Requests = $routes['service_provider_all_requests'];
$Re_Schedule = $routes['service_provider_re_schedule'];
$My_Profile =  $routes['service_provider_my_profile'];


$Login_page = $routes['service_provider_login'];
$user_id = $_SESSION["user_id"];
$logoutController = $backend_routes['logout_controller'];
$Re_Schedule_Controller = $backend_routes['re_schedule_controller'];



if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}

$TotalRequestCompleted = '';
$TotalIncome = '';
$AccountMode = '';
$UpcomingNextAppointment = '';


$order_id = -1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['re_schedule_id'];
}

$appointment_data = findAppointmentByOrderIDAndServiceProviderID($order_id, $user_id);


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Service Solution -> Customer Dashboard</title>
    <link rel="stylesheet" href="/Home_Service_Solution/css/Customer_Dashboard.css">
    <link rel="stylesheet" href="/Home_Service_Solution/css/Re_Schedule_Form.css">
</head>
<body>
<div class="main_container">
    <div class="division_a">

        <div class="form_container">
            <form action="<?php echo $Re_Schedule_Controller; ?>" style="margin-top: 138px;" method="post">
                <label for="re_schedule_date">Select Date:</label>
                <input hidden type="number" value="<?php echo $order_id;?>" name="re_schedule_id" id="re_schedule_id" />
                <input type="date" value="<?php if(isset($appointment_data['date'])){echo $appointment_data['date'];}else{echo '';}?>" id="re_schedule_date" name="re_schedule_date">
                <button type="submit">Re-Schedule IT</button>
            </form>
        </div>

    </div>
    <div class="division_b">
        <header class="navbar">
            <div class="logo">
                <img src="/Home_Service_Solution/view/static/image/1hss.png" style="border-radius: 50%;" alt="Logo">
            </div>
        </header>

    </div>
    <div class="division_d">
        <div class="left_panel">
            <button onclick="goToDashboard()">Dashboard</button>
            <button onclick="goToAllRequests()">Requests</button>
            <button style="background-color: #ffffcc" onclick="reSchedule()">Re-Schedule</button>
            <button onclick="myProfile()">My Profile</button>
            <button onclick="logout()">Logout</button>
        </div>
    </div>
</div>

<script>
    function goToDashboard() {
        window.location.href = "<?php echo $Dashboard; ?>";
    }

    function goToAllRequests() {
        window.location.href = "<?php echo $All_Requests; ?>";
    }

    function reSchedule() {
        window.location.href = "<?php echo $Re_Schedule; ?>";
    }

    function myProfile() {
        window.location.href = "<?php echo $My_Profile; ?>";
    }

    function logout() {
        window.location.href = "<?php echo $logoutController; ?>";
    }
</script>

</body>
</html>
