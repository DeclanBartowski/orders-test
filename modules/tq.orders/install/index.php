<?php

use Bitrix\Main\Context;
use Bitrix\Main\EventManager;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class Tq_orders extends CModule
{
    var $MODULE_ID = 'tq.orders';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $PARTNER_NAME;
    var $PARTNER_URI;

    protected $module_path;
    protected $root_dir;

    /**
     * $_SERVER
     * @var
     */
    private $server;

    public function __construct()
    {
        $arModuleVersion = array();

        include(__DIR__ . '/version.php');

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = Loc::getMessage('TQ_ORDERS_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage("TQ_ORDERS_MODULE_DESCRIPTION");
        $this->PARTNER_NAME = Loc::getMessage("TQ_ORDERS_MODULE_PARTNER_NAME");
        $this->PARTNER_URI = Loc::getMessage("TQ_ORDERS_MODULE_PARTNER_URI");
        $this->module_path = dirname(__DIR__);
        $this->root_dir = (strpos($this->module_path, '/local/') !== false ? 'local' : 'bitrix');
        $this->server = Context::getCurrent()->getServer();
    }

    /**
     * Установка модуля
     */
    public function DoInstall()
    {
        global $APPLICATION;

        RegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile('Установка модуля ' . $this->MODULE_ID,
            $this->module_path . "/install/step.php");
    }

    /**
     * Удаление модуля
     */
    public function DoUninstall()
    {
        global $APPLICATION;
        UnRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile('Деинсталляция модуля ' . $this->MODULE_ID,
            $this->module_path . "/install/unstep.php");
    }

}