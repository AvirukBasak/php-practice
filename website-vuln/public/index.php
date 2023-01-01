<?php

function sha512sum($data) {
    return hash('sha512', $data);
}

function mkrandomstr() {
    return hash('md5', rand());
}

function set_data($key, $data) {
    if (!file_exists('../data')) mkdir('../data');
    if (file_exists("../data/$key")) return false;
    $file = fopen("../data/$key", 'wb');
    fwrite($file, $data);
    return true;
}

function get_data($key) {
    if (!file_exists('../data')) mkdir('../data');
    if (!file_exists("../data/$key")) return false;
    $file = fopen("../data/$key", "rb");
    return fread($file, filesize("../data/$key"));
}

function get_user($uid) {
    return array(
        'uname' => get_data("$uid.uname"),
        'phash' => get_data("$uid.phash"));
}

function save_user($uid, $uname, $passwd) {
    return set_data("$uid.uname", $uname)
        && set_data("$uid.phash", sha512sum($passwd));
}

function is_defined($arr, $key) {
    return isset($arr[$key]) && !empty(trim($arr[$key]));
}

define('FIVE_DAY_EXPIRY_TIME', time() + 5 * 24 * 3600);

$LOGGED_IN = false;
$MESSAGE = false;
$USER_NAME = '';

function main() {
    if (isset($_POST['uname']) && isset($_POST['passwd']) && isset($_POST['conf-passwd'])) {
        if (empty(trim($_POST['uname'])) || empty(trim($_POST['passwd'])) || empty(trim($_POST['conf-passwd']))) {
            $GLOBALS['MESSAGE'] = 'error: 1: empty form field';
            return;
        }
        if (is_defined($_COOKIE, 'uid')) {
            $GLOBALS['MESSAGE'] = 'error: 2: already logged in';
            return;
        }
        if ($_POST['passwd'] != $_POST['conf-passwd']) {
            $GLOBALS['MESSAGE'] = 'error: 3: passwords didn\'t match';
            return;
        }
        $uname = $_POST['uname'];
        $passwd = $_POST['passwd'];
        while (true) {
            $uid = mkrandomstr();
            if (!save_user($uid, $uname, $passwd))
                continue;
            setcookie('uid', $uid, FIVE_DAY_EXPIRY_TIME);
            break;
        }
        $GLOBALS['MESSAGE'] = "Logged in as $uname";
    } else if (!isset($_POST['uname']) && !isset($_POST['passwd']) && !isset($_POST['conf-passwd']))
        if (is_defined($_COOKIE, 'uid') && $user = get_user($_COOKIE['uid'])) {
            if (is_defined($_POST, 'logout'))
                if ($_POST['logout'] == 'true') {
                    setcookie('uid', $_COOKIE['uid'], time() -1);
                    return;
                } else $GLOBALS['MESSAGE'] = 'error: 4: malformed form submitted';
            $GLOBALS['LOGGED_IN'] = true;
            $GLOBALS['USER_NAME'] = $user['uname'];
        } else return;
    else $GLOBALS['MESSAGE'] = 'error: 5: malformed form submitted';
}

main();

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
  <title>Vuln</title>
  <style>
    * {
      font-family: monospace;
      font-size: 98%;
    }
    html, body {
      margin: 0;
    }
    div {
      padding: 25px;
      margin: 50px auto 20px;
      width: 320px;
      border: 1px solid #aaaaaa;
      border-radius: 10px;
      background-color: #dedede;
    }
    input {
      border: 1px solid #aaaaaa;
      border-radius: 10px;
      padding: 1px 7px 1px;
    }
    input.text {
      width: 220px;
      height: 25px;
      margin-bottom: 10px;
      outline: none;
    }
    input.button, button {
      min-width: 80px;
      height: 30px;
    }
    input.button:active {
      background-color: #dedede;
    }
  </style>
</head>
<body>
<?php if (!$LOGGED_IN && !$MESSAGE) { ?>
  <div id="login-div">
    <h3>Enter login details</h3>
    <form method="POST" action="/index.php">
      <label for="uname">Username:</label>
      <input class="text" id="uname" name="uname" type="text" placeholder="Enter username"/></br>
      <label for="passwd">Password:</label>
      <input class="text" id="passwd" name="passwd" type="password" placeholder="Enter password"/></br>
      <label for="conf-passwd">Confirm:&nbsp;</label>
      <input class="text" id="conf-passwd" name="conf-passwd" type="password" placeholder="Confirm password"/></br>
      <input class="button" id="submit" type="submit" value="Submit"/>&nbsp;
      <input class="button" id="reset" type="reset" value="Clear"/>
    </form>
  </div>
<?php } else if ($MESSAGE) { ?>
  <div id="message-div">
    <h3>Info</h3>
    <pre><?= $MESSAGE ?></pre>
    <form method="GET" action="/">
      <input class="button" id="reload" type="submit" value="Reload"/>
    </form>
  </div>
<?php } else { ?>
  <div id="loggedin-div">
    <h3>Info</h3>
    <pre>Welcome back, <?= $USER_NAME ?></pre>
    <form method="POST" action="/index.php">
      <input class="text" id="logout" name="logout" type="hidden" value="true"/>
      <input class="button" id="logout" type="submit" value="Logout"/>
    </form>
  </div>
<?php } ?>
</body>
</html>
