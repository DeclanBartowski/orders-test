<?php


namespace Tq\Orders;


class OrderHistory
{

    public function saveHistory()
    {
        $payedOrderInfo = new PayedOrders();
        $arOrders = $payedOrderInfo->getPayedOrderList();
        if ($arOrders) {
            $CSVHistory = new SaveCSV();
            $path = $CSVHistory->SaveHistory($arOrders);
            $HLHistory = new HLHistory();
            $HLHistory->saveHlHistory([
                'UF_DATE' => date('d.m.Y'),
                'UF_LINK' => $path,
                'UF_QUANTITY' => count($arOrders),
                'UF_SUM' => array_sum(array_column($arOrders, 'PRICE'))
            ]);
        }
    }
}