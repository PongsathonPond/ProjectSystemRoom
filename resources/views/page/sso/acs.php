File: acs.php <br/>
Detail: Used to process user info after login successfull, and then continue to your code.<br/>
<hr/>
<?php
echo "<pre>";

echo "<b>== Sample SSO-ACS ==</b>\n\n";

echo "<b>-- 0) Attributes in \$_POST['CPE_SSO_login_info'] variable-- </b>\n\n";
var_dump($_POST);
echo "<hr/>\n";

echo "<b>-- 1) Convert \$_POST['CPE_SSO_login_info'] from base64 format to text (JSON format)-- </b>\n\n";

$text = base64_decode(isset($_POST["CPE_SSO_login_info"])) ? $_POST['CPE_SSO_login_info'] : '';

var_dump($text);
echo "<hr/>\n";

echo "<b>-- 2) Convert JSON formatted text to JSON data type-- </b>\n\n";
$login_info = json_decode($text);
var_dump($login_info);
echo "<hr/>\n";

echo "<b>-- 3) Example attributes of user info-- </b>\n\n";

if (isset($login_info->login)) {
    echo "Login: " . $login_info->login . "\n";
}

if (isset($login_info->personalId)) {
    echo "PersonalId: " . $login_info->personalId . "\n";
}

echo "</pre>";