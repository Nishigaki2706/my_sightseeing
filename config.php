<?php
// エラー表示あり
ini_set('display_errors', 1);
// 日本時間
date_default_timezone_set('Asia/Tokyo');
// URL/ディレクトリ設定
define('SPOT_URL', '/sightseeing/');
// データベースの接続情報
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'sightseeing');