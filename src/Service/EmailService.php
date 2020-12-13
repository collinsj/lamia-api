<?php

namespace App\Service;

use App\Entity\Order;

class EmailService
{
    /**
     * @var InvoiceService
     */
    private InvoiceService $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * @param Order $order
     */
    public function sendOrderConfirmationEmail(Order $order): void
    {
        //TODO Implement full functionality
        // $content = $this->invoiceService->generateInvoice($order);
        // send $content via some smtp email client
    }
}
