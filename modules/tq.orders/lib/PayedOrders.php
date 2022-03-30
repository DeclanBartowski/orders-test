<?php

namespace Tq\Orders;

use \Bitrix\Sale\Order;

class PayedOrders
{
    public function getPayedOrderList()
    {
        $prevDate = date('d.m.Y', strtotime('-1 days'));
        $dbRes = Order::getList([
            'select' => ['ID', 'DATE_PAYED', 'PRICE'],
            'filter' => [
                'PAYED' => 'Y',
                '>=DATE_PAYED' => sprintf('%s 00:00:00', $prevDate),
                '<=DATE_PAYED' => sprintf('%s 23:59:59', $prevDate),
            ],
            'order' => ['ID' => 'DESC'],
        ]);

        return $dbRes->fetchAll();
    }

}