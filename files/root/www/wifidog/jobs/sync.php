#!/usr/bin/php-cli -q
<?php
// include 'simple_html_dom.php';
// $gwAddress = trim(shell_exec('uci get wifidog.settings.gateway_host'));
// $gwPort = trim(shell_exec('uci get wifidog.settings.gatewayport'));
// $html = file_get_html("http://{$gwAddress}:{$gwPort}/wifidog/status");
// foreach ($html->find('pre') as $element) {
// 	echo $element->innertext;
// }
$db = new PDO('sqlite:/tmp/wifidog.sqlite3');
$gwMac = preg_replace('/(.+)HWaddr (.+)/i', '${2}', trim(shell_exec('ifconfig br-lan | grep HWaddr')));
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec("UPDATE connections SET expires_on = datetime('now', 'localtime'), updated_at = datetime('now', 'localtime') WHERE used_on is not null and updated_at <= datetime(datetime('now','localtime'), '-5 minutes') and expires_on > datetime('now', 'localtime')");
$gateway = $db->query("SELECT * FROM gateways WHERE id = '1'")->fetch(PDO::FETCH_ASSOC);
$users = $db->query("SELECT * FROM users WHERE updated_at > datetime(datetime('now','localtime'), '-5 minutes')")->fetchAll(PDO::FETCH_ASSOC);
$connections = $db->query("SELECT * FROM connections WHERE used_on is not null and updated_at > datetime(datetime('now','localtime'), '-5 minutes')")->fetchAll(PDO::FETCH_ASSOC);
$data = array('gw_id' => $gwMac, 'gateway' => $gateway, 'users' => $users, 'connections' => $connections);
$data_string = json_encode($data);
$db = null;
// echo $data_string;

$ch = curl_init('http://392a21d6.ngrok.com/portal/sync.json');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);

$result = curl_exec($ch);
// var_dump($result);
$response = curl_getinfo( $ch );
// var_dump($response);
curl_close ( $ch );
?>