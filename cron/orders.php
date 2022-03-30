<?php

if (!$_SERVER["DOCUMENT_ROOT"]) {
    $_SERVER["DOCUMENT_ROOT"] = dirname(__DIR__, 4);
}
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/classes/general/csv_data.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Tq\Orders\OrderHistory;
use \Bitrix\Main\Loader;

Loader::includeModule('tq.orders');
$orderHistory = new OrderHistory();
$orderHistory->saveHistory();
