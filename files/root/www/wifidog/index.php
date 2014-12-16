<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

// date_default_timezone_set('Asia/Chongqing');
$app = new \Slim\Slim();
$app->gwAddress = trim(shell_exec('uci get wifidog.settings.gateway_host'));
$app->gwPort = trim(shell_exec('uci get wifidog.settings.gatewayport'));
$app->gwName = trim(shell_exec('uci get wifidog.settings.gateway_hostname'));
$app->timeLimit = trim(shell_exec('uci get wifidog.settings.client_time_limit'));
$app->gwMac = preg_replace('/(.+)HWaddr (.+)/i', '${2}', trim(shell_exec('ifconfig br-lan | grep HWaddr')));
$app->gwId = str_replace(':', '', $app->gwMac);

$app->get('/hello/:name', function ($name) use ($app) {
	echo "Hello, ".$name."<br>";
});

$app->get('/login', function () use ($app) {
	$db = $app->dao;
	parse_str($app->environment['QUERY_STRING']);
	$isReturnUser = $app->getCookie('is_return_user');
	// $user = $db->query("SELECT * FROM users WHERE mac = '{$mac}'");

	if(!$isReturnUser) {
		// echo 'mac was not found.';
		$app->render('touch.php', array('mac' => $mac, 'title' => $app->gwName));
	}
	else {
		$app->render('touch.php', array('title' => $app->gwName));
	}

	$db = null;
});

$app->post('/users', function() use ($app) {
	$db = $app->dao;
	$params = $app->request->post();
	$user = $db->query("SELECT * FROM users WHERE phone = '{$params['phone']}'")->fetch();

	if(!$user) {
		$db->exec("INSERT INTO users (phone, mac)
					VALUES ('{$params['phone']}', '{$params['mac']}')");
	}
	else {
		$db->exec("UPDATE users SET mac = '{$params['mac']}', updated_at = datetime('now', 'localtime') WHERE id = {$user['id']}");
	}

	$db = null;
	$app->setCookie('is_return_user', true, '365 days');
	$app->halt(200, '{ "error": "" }');
});

$app->get('/portal', function() use ($app) {
	$app->render('show.php', array('title' => $app->gwName, 'id' => $app->gwId));
});

$app->get('/portal/touch', function() use ($app) {
	$db = $app->dao;
	$uuid = $app->uuid;
	$id = $app->uuid;
	$offset = $app->timeLimit;
	$db->exec("INSERT INTO connections (id, token, expires_on)
					VALUES ('{$id}', '{$uuid}', datetime(datetime('now','localtime'), '+{$offset} minutes'))");
	$db = null;
	$app->redirect("http://{$app->gwAddress}:{$app->gwPort}/wifidog/auth?token={$uuid}");
});

$app->get('/ping', function () use ($app) {
	$db = $app->dao;
	parse_str($app->environment['QUERY_STRING']);
	$db->exec("UPDATE gateways SET sys_uptime = {$sys_uptime}, sys_load = {$sys_load}, sys_memfree = {$sys_memfree}, wifidog_uptime = {$wifidog_uptime}, last_seen = datetime('now','localtime'), updated_at = datetime('now','localtime') WHERE id = 1");
	$db = null;
	$app->halt(200, 'Pong');
});

$app->get('/auth', function () use ($app) {
	$auth = 0;
	$db = $app->dao;
	parse_str($app->environment['QUERY_STRING']);
	$connection = $db->query("SELECT * FROM connections WHERE token = '{$token}'")->fetch();

	if (!$connection) {
		$auth = 6;
	}
	else {
		switch ($stage) {
			case 'login':
				$expires_on = $connection['expires_on'];
				echo (strtotime($expires_on) < strtotime('now')); 

				if ($connection['used_on'] != '' || ($expires_on != '' && strtotime($expires_on) < strtotime('now'))) {
					// Tried to login with used or expired token
					$auth = 6;
				} else {
					# Login normal
					$db->exec("UPDATE connections SET used_on = datetime('now', 'localtime'), updated_at = datetime('now', 'localtime') WHERE id = '{$connection['id']}'");
					$auth = 1;
				}
				
				break;
			
			case 'counters':
				$expires_on = $connection['expires_on'];

				if ($expires_on == '' || strtotime($expires_on) > strtotime('now')) {
					$db->exec("UPDATE connections SET ip = '{$ip}', mac = '{$mac}', incoming_bytes = {$incoming}, outgoing_bytes = {$outgoing}, updated_at = datetime('now', 'localtime') WHERE id = '{$connection['id']}'");
					$auth = 1;
				}

				break;
			
			case 'logout':
				$db->exec("UPDATE connections SET expires_on = datetime('now', 'localtime'), updated_at = datetime('now', 'localtime') WHERE id = '{$connection['id']}'");
				break;
			
			default:
				# code...
				break;
		}
	}

	$db = null;
	$app->halt(200, "Auth: {$auth}");
});

$app->get('/cnzz/:id', function ($id) use ($app) {
	$app->render('701.html');
});

$app->get('/info', function () use ($app) {
	phpinfo();
});

$app->get('/list_images', function () use ($app) {
	if ($handle = opendir('./assets/ads')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            echo "$entry\n";
        }
    }

    closedir($handle);
}
});

$app->dao = function () use ($app) {
	$db = null;

	try {
		$db = new PDO('sqlite:/tmp/wifidog.sqlite3');
		//$db->setAttribute(PDO::ATTR_ERRMODE,
		//                      PDO::ERRMODE_EXCEPTION);
		$result = $db->query('SELECT * FROM gateways');

		if(!$result) {
			// echo "gateways was not existed.";
			$db->exec("CREATE TABLE IF NOT EXISTS gateways (
						id INTEGER PRIMARY KEY,
						sys_uptime INTEGER DEFAULT 0,
						sys_load INTEGER DEFAULT 0,
						sys_memfree INTEGER DEFAULT 0,
						wifidog_uptime INTEGER DEFAULT 0,
						last_seen DATETIME,
						created_at DATETIME DEFAULT (datetime('now','localtime')),
						updated_at DATETIME DEFAULT (datetime('now','localtime')))");

			$db->exec("CREATE TABLE IF NOT EXISTS connections (
						id VARCHAR(255) PRIMARY KEY,
						token VARCHAR(255),
						expires_on DATETIME,
						used_on DATETIME,
						ip VARCHAR(255),
						mac VARCHAR(255),
						incoming_bytes INTEGER DEFAULT 0,
						outgoing_bytes INTEGER DEFAULT 0,
						created_at DATETIME DEFAULT (datetime('now','localtime')),
						updated_at DATETIME DEFAULT (datetime('now','localtime')))");

			$db->exec("CREATE TABLE IF NOT EXISTS users (
						id INTEGER PRIMARY KEY AUTOINCREMENT,
						mac VARCHAR(255),
						phone VARCHAR(255),
						created_at DATETIME DEFAULT (datetime('now','localtime')),
						updated_at DATETIME DEFAULT (datetime('now','localtime')))");

			$db->exec("INSERT INTO gateways (id) VALUES (1)");
		}
		//var_dump($result);
		//echo count($result);
	}
	catch(PDOException $e) {
		echo $e->getMessage();
		$db = null;
	}

	return $db;
};
$app->uuid = function() {
	return exec('uuidgen');
};

$app->run();