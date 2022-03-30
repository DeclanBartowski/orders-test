<?php


namespace Tq\Orders;


class SaveCSV
{
    public function SaveHistory($arOrders)
    {
        if (!$_SERVER["DOCUMENT_ROOT"]) {
            $_SERVER["DOCUMENT_ROOT"] = dirname(__DIR__, 4);
        }
        require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/classes/general/csv_data.php");
        $date = reset($arOrders)['DATE_PAYED'];
        $path = sprintf('/upload/payed_orders_%s.csv', FormatDate('d.m.Y', $date));
        $filePath = sprintf('%s%s', $_SERVER["DOCUMENT_ROOT"], $path);
        $fp = fopen($filePath, 'w+');
        @fclose($fp);
        $csvFile = new \CCSVData('R', false);
        $csvFile->SetDelimiter(';');
        $csvFile->SetFirstHeader(true);
        $csvFile->SaveFile($filePath, ['ID', 'Дата оплаты', 'Сумма заказа']);
        foreach ($arOrders as $arOrder) {
            $csvFile->SaveFile($filePath, [
                $arOrder['ID'],
                FormatDate('d.m.Y H:i:s', $arOrder['DATE_PAYED']),
                $arOrder['PRICE'],
            ]);
        }
        return $path;
    }

}