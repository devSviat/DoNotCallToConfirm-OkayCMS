<?php

namespace Okay\Modules\Sviat\DoNotCallToConfirm\Backend\Controllers;

use Okay\Admin\Controllers\IndexAdmin;

/**
 * Контролер адмін панелі для модуля "Не телефонувати"
 */
class DoNotCallToConfirmAdmin extends IndexAdmin
{
    /**
     * Відображення сторінки налаштувань модуля
     */
    public function fetch(): void
    {
        $this->response->setContent($this->design->fetch('dont_call_admin.tpl'));
    }
}
