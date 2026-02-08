<?php

namespace Okay\Modules\Sviat\DoNotCallToConfirm\Extenders;

use Okay\Core\Modules\Extender\ExtensionInterface;
use Okay\Core\Request;
use Okay\Core\EntityFactory;
use Okay\Entities\OrdersEntity;

/**
 * Розширення для фронтенду: зберігає значення чекбокса "Не телефонувати" при створенні замовлення
 */
class FrontExtender implements ExtensionInterface
{
    private Request $request;
    private OrdersEntity $ordersEntity;

    /**
     * @param Request $request
     * @param EntityFactory $entityFactory
     */
    public function __construct(Request $request, EntityFactory $entityFactory)
    {
        $this->request = $request;
        $this->ordersEntity = $entityFactory->get(OrdersEntity::class);
    }

    /**
     * Зберігає значення чекбокса "Не телефонувати" після створення замовлення
     *
     * @param mixed $result
     * @param object $order
     * @return void
     */
    public function saveDontCall($result, $order): void
    {
        $value = (int) ($this->request->post('dont_call') !== null);
        $this->ordersEntity->update($order->id, ['dont_call' => $value]);
    }
}
