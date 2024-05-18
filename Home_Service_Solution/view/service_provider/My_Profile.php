<?php
global $backend_routes;
session_start();
global $routes;
require '../../routes.php';
require '../../Utils.php';

include '../../model/ServiceProviderRepo.php';

global $image_routes;
$logo_image = $image_routes['logo_icon'];


$Dashboard = $routes['service_provider_dashboard'];
$All_Requests = $routes['service_provider_all_requests'];
$Re_Schedule = $routes['service_provider_re_schedule'];
$My_Profile =  $routes['service_provider_my_profile'];


$Login_page = $routes['service_provider_login'];
$user_id = $_SESSION["user_id"];
$logoutController = $backend_routes['logout_controller'];
$My_Profile_Controller = $backend_routes['my_profile_controller'];

if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}

$TotalRequestCompleted = '';
$TotalIncome = '';
$AccountMode = '';
$UpcomingNextAppointment = '';



$service_provider_data = findServiceProviderByID($user_id);
$user_username = $service_provider_data['username'];
$user_password = $service_provider_data['password'];
$user_profile_type = $service_provider_data['profile_mode'];

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Service Solution -> Customer Dashboard</title>
    <link rel="stylesheet" href="/Home_Service_Solution/css/Customer_Dashboard.css">
    <link rel="stylesheet" href="/Home_Service_Solution/css/Service_Provider_Profile.css">
</head>
<body>
<div class="main_container">
    <div class="division_a">

        <div class="division_a">
            <div class="profile_card" style="margin-top: 103px;">
                <h2>My Profile</h2>
                <p>Email: <?php echo $user_username; ?></p>
                <p>Profile Type: <?php echo $user_profile_type; ?></p>
                <form action="">
                    <button type="submit">Apply for Pro Mode</button>
                </form>
            </div>
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
            <button onclick="reSchedule()">Re-Schedule</button>
            <button style="background-color: #ffffcc" onclick="myProfile()">My Profile</button>
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

