<?php

namespace Okay\Modules\Sviat\DoNotCallToConfirm\Init;

use Okay\Core\Modules\AbstractInit;
use Okay\Core\Modules\EntityField;
use Okay\Entities\OrdersEntity;
use Okay\Helpers\OrdersHelper;
use Okay\Modules\Sviat\DoNotCallToConfirm\Extenders\FrontExtender;

class Init extends AbstractInit
{
    public function install(): void
    {
        $this->setBackendMainController('DoNotCallToConfirmAdmin');

        $this->migrateEntityField(
            OrdersEntity::class,
            new EntityField('dont_call')->setTypeTinyInt(1)->setDefault(0)
        );
    }

    public function init(): void
    {
        $this->registerBackendController('DoNotCallToConfirmAdmin');
        $this->addBackendControllerPermission('DoNotCallToConfirmAdmin', 'orders');

        $this->registerEntityField(OrdersEntity::class, 'dont_call');

        $this->registerChainExtension(
            [OrdersHelper::class, 'finalCreateOrderProcedure'],
            [FrontExtender::class, 'saveDontCall']
        );
    }
}
