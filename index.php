<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta name="google-signin-client_id"
          content="934160535722-g8j8u21oa4o1hqdrbfh20b5v0r5i96vn.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
    <title>Firebase Login</title>
</head>
<body>

<?php
    if (isset($_SESSION['USER_ID'])) {
?>
    <a href="javascript:void(0)" onclick="logout()">Logout</a>
<?php
    } else {
?>
    <div class="g-signin2" data-onsuccess="gmailLogIn"></div>
<?php
    }
?>


<script>
    function logout() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut();

        jQuery.ajax({
            url: 'logout.php',
            success: function (response) {
                window.location.href = "index.php";
            }
        });
    }

    function onLoad() {
        gapi.load('auth2', function () {
            gapi.auth2.init();
        });
    }

    function gmailLogIn(userInfo) {
        var userProfile = userInfo.getBasicProfile();

        jQuery.ajax({
            url: 'login_check.php',
            type: 'post',
            data: 'user_id=' + userProfile.getId() + '&name=' + userProfile.getName() + '&image=' + userProfile.getImageUrl() + '&email=' + userProfile.getEmail(),
            success: function (response) {
                window.location.href = "index.php";
            }
        });
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
