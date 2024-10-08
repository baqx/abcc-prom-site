<?php
function getuserid($uname)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE username ='$uname'");
    while ($row = mysqli_fetch_assoc($sql)) {
        $ret = $row['id'];
    }
    return $ret;
}
function getcat($cid)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT * FROM vote_categories WHERE id =$cid");
    while ($row = mysqli_fetch_assoc($sql)) {
        $ret = $row['name'];
    }
    return $ret;
}
function isverified($id)
{
    global $conn;
    $guq = mysqli_query($conn, "SELECT badge FROM users WHERE id=$id");
    while ($guqr = mysqli_fetch_array($guq)) {
        $rrr = $guqr['badge'];
    }
    if ($rrr == 1) {
        $ret = "<?xml version='1.0' encoding='utf-8'?>
<svg width='16px' height='16px' viewBox='0 0 24 24' fill='gold' xmlns='http://www.w3.org/2000/svg'>
<rect width='16' height='16' fill='none'/>
<path fill-rule='evenodd' clip-rule='evenodd' d='M9.55879 3.6972C10.7552 2.02216 13.2447 2.02216 14.4412 3.6972L14.6317 3.96387C14.8422 4.25867 15.1958 4.41652 15.5558 4.37652L16.4048 4.28218C18.3156 4.06988 19.9301 5.68439 19.7178 7.59513L19.6235 8.44415C19.5835 8.8042 19.7413 9.15774 20.0361 9.36831L20.3028 9.55879C21.9778 10.7552 21.9778 13.2447 20.3028 14.4412L20.0361 14.6317C19.7413 14.8422 19.5835 15.1958 19.6235 15.5558L19.7178 16.4048C19.9301 18.3156 18.3156 19.9301 16.4048 19.7178L15.5558 19.6235C15.1958 19.5835 14.8422 19.7413 14.6317 20.0361L14.4412 20.3028C13.2447 21.9778 10.7553 21.9778 9.55879 20.3028L9.36831 20.0361C9.15774 19.7413 8.8042 19.5835 8.44414 19.6235L7.59513 19.7178C5.68439 19.9301 4.06988 18.3156 4.28218 16.4048L4.37652 15.5558C4.41652 15.1958 4.25867 14.8422 3.96387 14.6317L3.6972 14.4412C2.02216 13.2447 2.02216 10.7553 3.6972 9.55879L3.96387 9.36831C4.25867 9.15774 4.41652 8.8042 4.37652 8.44414L4.28218 7.59513C4.06988 5.68439 5.68439 4.06988 7.59513 4.28218L8.44415 4.37652C8.8042 4.41652 9.15774 4.25867 9.36831 3.96387L9.55879 3.6972ZM15.7071 9.29289C16.0976 9.68342 16.0976 10.3166 15.7071 10.7071L11.8882 14.526C11.3977 15.0166 10.6023 15.0166 10.1118 14.526L8.29289 12.7071C7.90237 12.3166 7.90237 11.6834 8.29289 11.2929C8.68342 10.9024 9.31658 10.9024 9.70711 11.2929L11 12.5858L14.2929 9.29289C14.6834 8.90237 15.3166 8.90237 15.7071 9.29289Z' fill='gold'/>
</svg>";
    } else {
        $ret = null;
    }
    return $ret;
}

function getip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}



function getuser($id, $row)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT $row AS result FROM users WHERE id=$id");
    while ($roww = mysqli_fetch_array($sql)) {
        $ret = $roww['result'];
    }
    return $ret;
}

//Function to check if password is correct
function passcorr($password)
{
    global $conn;
    global $myid;
    $opass = getuser($myid, "password");
    $pass = md5("$password");
    if ($pass == $opass) {
        return "correct";
    } else {
        return "wrong";
    }
}


function msg_encrypt($input)
{
    // Store the cipher method   
    $ciphering_value = "AES-128-CTR";
    // Store the encryption key  
    $encryption_key = "abcc";
    // Use openssl_encrypt() function   
    $encryption_value = openssl_encrypt($input, $ciphering_value, $encryption_key);
    return $encryption_value;
}

function msg_decrypt($input)
{
    // Store the cipher method   
    $ciphering_value = "AES-128-CTR";
    $decryption_key = "abcc";
    // Use openssl_decrypt() function to decrypt the data  
    $decryption_value = openssl_decrypt($input, $ciphering_value, $decryption_key);
    // Display the decrypted string as an original data  
    return $decryption_value;
}




function get_comm_gravatar($email, $s = 100, $d = 'wavatar', $r = 'g', $img = false, $atts = array())
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

if (isset($_SESSION['myid'])) {
    $myid = $_SESSION['myid'];
    $queryusersql = mysqli_query($conn, "SELECT * FROM users WHERE id=$myid");
    while ($queryusersqlrow = mysqli_fetch_array($queryusersql)) {
        $myusername = strtolower($queryusersqlrow['username']);
        $myid = $queryusersqlrow['id'];
        $avatar = get_comm_gravatar("$myusername@explora.top");
    }
}
