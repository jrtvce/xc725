<?php
function real_ip()
{
    $ip = 'undefined';
    if (isset($_SERVER))
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        elseif (isset($_SERVER['HTTP_CLIENT_IP'])) $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    else
    {
        $ip = getenv('REMOTE_ADDR');
        if (getenv('HTTP_X_FORWARDED_FOR')) $ip = getenv('HTTP_X_FORWARDED_FOR');
        elseif (getenv('HTTP_CLIENT_IP')) $ip = getenv('HTTP_CLIENT_IP');
    }
    $ip = htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
    return $ip;
}

function get_os()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform = "Unknown OS Platform";
    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );
    foreach ($os_array as $regex => $value)
    {
        if (preg_match($regex, $user_agent))
        {
            $os_platform = $value;
        }
    }
    return $os_platform;
}

function Browser_type()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser = "Unknown Browser";
    $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/Trident/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/ubrowser/i' => 'UC Browser',
        '/mobile/i' => 'Handheld Browser'
    );
    foreach ($browser_array as $regex => $value)
    {
        if (preg_match($regex, $user_agent))
        {
            $browser = $value;
        }
    }
    return $browser;
}

function get_device()
{
    $tablet_browser = 0;
    $mobile_browser = 0;
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
    {
        $tablet_browser++;
    }
    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
    {
        $mobile_browser++;
    }
    if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']) , 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']))))
    {
        $mobile_browser++;
    }
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
    $mobile_agents = array(
        'w3c ',
        'acs-',
        'alav',
        'alca',
        'amoi',
        'audi',
        'avan',
        'benq',
        'bird',
        'blac',
        'blaz',
        'brew',
        'cell',
        'cldc',
        'cmd-',
        'dang',
        'doco',
        'eric',
        'hipt',
        'inno',
        'ipaq',
        'java',
        'jigs',
        'kddi',
        'keji',
        'leno',
        'lg-c',
        'lg-d',
        'lg-g',
        'lge-',
        'maui',
        'maxo',
        'midp',
        'mits',
        'mmef',
        'mobi',
        'mot-',
        'moto',
        'mwbp',
        'nec-',
        'newt',
        'noki',
        'palm',
        'pana',
        'pant',
        'phil',
        'play',
        'port',
        'prox',
        'qwap',
        'sage',
        'sams',
        'sany',
        'sch-',
        'sec-',
        'send',
        'seri',
        'sgh-',
        'shar',
        'sie-',
        'siem',
        'smal',
        'smar',
        'sony',
        'sph-',
        'symb',
        't-mo',
        'teli',
        'tim-',
        'tosh',
        'tsm-',
        'upg1',
        'upsi',
        'vk-v',
        'voda',
        'wap-',
        'wapa',
        'wapi',
        'wapp',
        'wapr',
        'webc',
        'winw',
        'winw',
        'xda ',
        'xda-'
    );
    if (in_array($mobile_ua, $mobile_agents))
    {
        $mobile_browser++;
    }
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']) , 'opera mini') > 0)
    {
        $mobile_browser++;
        //Check for tablets on opera mini alternative headers
        $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua))
        {
            $tablet_browser++;
        }
    }
    if ($tablet_browser > 0)
    {
        // do something for tablet devices
        return 'Tablet';
    }
    else if ($mobile_browser > 0)
    {
        // do something for mobile devices
        return 'Mobile';
    }
    else
    {
        // do something for everything else
        return 'Computer';
    }
}

///Use of Tor browser
function IsTorExitPoint()
{
    if (gethostbyname(ReverseIPOctets($_SERVER['REMOTE_ADDR']) . "." . $_SERVER['SERVER_PORT'] . "." . ReverseIPOctets($_SERVER['SERVER_ADDR']) . ".ip-port.exitlist.torproject.org") == "127.0.0.2")
    {
        return 'True';
    }
    else
    {
        return 'False';
    }
}
function ReverseIPOctets($inputip)
{
    $ipoc = explode(".", $inputip);
    return $ipoc[3] . "." . $ipoc[2] . "." . $ipoc[1] . "." . $ipoc[0];
}

//If geo ip fails so will script!!
//
//Get Geo IP
$ipl = real_ip();

$details = json_decode(file_get_contents("http://ip-api.com/json/{$ipl}"));
$country = $details->country;
$state = $details->regionName;
$city = $details->city;
$isp = $details->isp;
$loc = 'Lon: '.$details->lon.' Lat: '.$details->lat;

//User Details
date_default_timezone_set('America/Chicago');
$line = "---------------------------------------------" . "\n" . "[TOA] " . date('Y-m-d H:i:s') . "  [IPV6] " . real_ip() . "\n" . "[Country] " . $country . " [City] " . $city . " [State] " . $state . " [ISP] " . $isp . "\n" . " [Location] " . $loc . "\n" . "[UA] $_SERVER[HTTP_USER_AGENT]" . " [OS] " . get_os() . "\n" . " [Browser] " . Browser_type() . "\n" . " [Device] " . get_device() . "\n" . "[Tor Browser] " . IsTorExitPoint() . "\n";

//Write Daily Log
$logname1 = date("Ymd") . '.log';
if (file_exists('snoop/' . $logname))
{
    file_put_contents("snoop/" . $logname1 . "", $line . PHP_EOL, FILE_APPEND);
}
else
{
    file_put_contents("snoop/" . $logname1 . "", $line . PHP_EOL, FILE_APPEND);
}

?>
<style>
@import url("https://fonts.googleapis.com/css?family=Share+Tech+Mono|Montserrat:700");

* {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
    box-sizing: border-box;
    color: inherit;
}

body {
    background-image: radial-gradient( black 40%, #000954 99%);
    height: 100vh;
}

div {
    background: rgba(0, 0, 0, 0);
    width: 70vw;
    position: relative;
    top: 50%;
    transform: translateY(-50%);
    margin: 0 auto;
    padding: 30px 30px 10px;
    box-shadow: 0 0 150px -20px rgba(0, 0, 0, 0.5);
    z-index: 3;
}

P {
    font-family: "Share Tech Mono", monospace;
    color: #f5f5f5;
    margin: 0 0 20px;
    font-size: 17px;
    line-height: 1.2;
}

span {
    color: #F0DA00;
}

i {
    color: #36FE00;
}

div a {
    text-decoration: none;
}

b {
    color: #81a2be;
}

a {
    color: #FF2D00;
}

@keyframes slide {
    from {
        right: -100px;
        transform: rotate(360deg);
        opacity: 0;
    }
    to {
        right: 15px;
        transform: rotate(0deg);
        opacity: 1;
    }
}

</style>

<div>
<p><span></span><a>Access Unauthorised</a></p>
<p>$ <span>Time Of Arrival</span>: "<i><?php echo date('Y-m-d H:i:s') ?></i>"</p>
<p>$ <span>IP Address</span>: "<i><?php echo real_ip() ?></i>"</p>
<p>$ <span>Country</span>: "<i><?php echo $country ?></i>"</p>
<p>$ <span>State</span>: "<i><?php echo $state ?></i>"</p>
<p>$ <span>City</span>: "<i><?php echo $city ?></i>"</p>
<p>$ <span>Location</span>: "<i><?php echo $loc ?></i>"</p>
<p>$ <span>ISP</span>: "<i><?php echo $isp ?></i>"</p>
<p>$ <span>User Agent</span>: "<i><?php echo $_SERVER[HTTP_USER_AGENT] ?></i>"</p>
<p>$ <span>Operating System</span>: "<i><?php echo get_os() ?></i>"</p>
<p>$ <span>Browser</span>: "<i><?php echo Browser_type() ?></i>"</p>
<p>$ <span>Device</span>: "<i><?php echo get_device() ?></i>"</p>
<p>$ <span>Tor Browser</span>: "<i><?php echo IsTorExitPoint() ?></i>"</p>
<p>root@admin: ~$ <span>Log Session</span>: "<i>Success</i>"</p>

</div>
		
<script>
var str = document.getElementsByTagName('div')[0].innerHTML.toString();
var i = 0;
document.getElementsByTagName('div')[0].innerHTML = "";

setTimeout(function() {
    var se = setInterval(function() {
        i++;
        document.getElementsByTagName('div')[0].innerHTML = str.slice(0, i) + "|";
        if (i == str.length) {
            clearInterval(se);
            document.getElementsByTagName('div')[0].innerHTML = str;
        }
    }, 10);
},0);

</script>