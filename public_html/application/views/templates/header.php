<!doctype html>
<html>
<head>
<title>Link Wise</title>
<link href="/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/linkwise.js"></script>
<link href="/jqueryui/jquery-ui-1.10.2.custom.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/jqueryui/jquery-ui-1.10.2.custom.js"></script>
</head>
<body>

<div id="fb-root"></div>
<script>
    // Additional JS functions here
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '447748618615363', // App ID
            channelUrl : '//www.linkwise.org/channel.html', // Channel File
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml      : true  // parse XFBML
        });
        

        FB.getLoginStatus(function(response) {
            console.log('response = ' + response);
            if (response.status === 'connected') {
                alert("you are in");
            } else if (response.status === 'not_authorized') {
                alert("not authorized");
            } else {
                alert("not logged in " + response.status);
            }
        });

    };

    function login() {
        FB.login(function(response) {
            if (response.authResponse) {
                window.location = "/welcome/fblogin";
            } else {
                // cancelled
            }
        });
    }

    function logout() {
        FB.logout(function(response) {
           // window.location = "http://www.linkwise.org/welcome/signout";
 //           signOutInit();
        });
    }

    function testAPI() {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function(response) {
            alert('Good to see you, ' + response.name + '.');
        });
    }

    function addInvites() {
        var friends = document.getElementById("friends");

        FB.api('/me/friends', function(response) {
            for (var i = 0; i < 5; i++) {
                var f = response.data[i];
                var li = document.createElement("li");
                friends.appendChild(li);
                var a = document.createElement("a");
                a.href = "http://www.facebook.com/" + f.id;
                a.innerHTML = f.name;
                li.appendChild(a);
            }
        });
    }

    // Load the SDK Asynchronously
    (function(d, debug){
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
        ref.parentNode.insertBefore(js, ref);
    }(document, /*debug*/ false));


    $(document).ready(function(){
        $(".subscribe_button").click(subscribeEvent);
        $(".unsubscribe_button").click(unsubscribeEvent);
        $("#sidedatepicker").datepicker({onSelect:pickDate});
        $("#createdatepicker").datepicker();
    });
</script>

<?php         date_default_timezone_set("America/Los_Angeles"); ?>
<!-- start header -->
<div id="header">
    <div id="headercontainer">
        <div id="logo">
            <a href="/">Link Wise</a>
        </div>
        <?php require_once APPPATH . 'libraries/facebook.php';
                   $facebook = new Facebook(array(
                                      'appId'  => '447748618615363',
                                      'secret' => '3730fc514f13b5723c186152acdc1ef0',
                                      'cookie' => true
                                 ));

                    $userId = $facebook->getUser();
                    if ($userId) {
                        error_log(print_r($userId, true));
                        $userInfo = $facebook->api('/' . $userId);
                         error_log(print_r($userInfo, true));
                    }
//                    else error_log('no user id');
        ?>
        <div id="menu">
            <ul>
                <?php if (get_uid()) { ?>
                    <li><?= $user_name ?></li>
                <?php } else { ?>
                    <li><a id="login" href="/user/signon" onclick="login">Sign On</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<div id="wrapper">
	<div id="page">
