<?php


namespace Tq\Orders;


use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
use Bitrix\Main\Loader;

Loader::includeModule('highloadblock');

class HLHistory
{
    private $hlCode = 'PayedOrders';

    public function saveHlHistory($arFields)
    {
        $hlBlock = HLBT::getList([
            'filter' => [
                'NAME' => $this->hlCode
            ],
            'limit' => 1
        ])->fetch();
        $entity = HLBT::compileEntity($hlBlock);
        $entityDataClass = $entity->getDataClass();
        $rsData = $entityDataClass::getList([
            'select' => ['ID', 'UF_DATE'],
            'filter' => ['UF_DATE' => $arFields['UF_DATE']]
        ]);
        $item = $rsData->fetch();
        if ($item) {
            $entityDataClass::update($item['ID'], $arFields);
        } else {
            $entityDataClass::add($arFields);
        }
    }
}