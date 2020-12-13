<?php

namespace App\Controller\Api\V1;

use App\Controller\BaseController;
use App\Service\EmailService;
use App\Service\InvoiceService;
use App\Service\OrderService;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1")
 */
class OrderController extends BaseController
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var EmailService
     */
    private EmailService $emailService;

    /**
     * @var InvoiceService
     */
    private InvoiceService $invoiceService;

    public function __construct(LoggerInterface $logger, EmailService $emailService, InvoiceService $invoiceService)
    {
        $this->logger = $logger;
        $this->emailService = $emailService;
        $this->invoiceService = $invoiceService;
    }

    /**
     * @Route("/order/create", name="api_v1_order_create", methods={"POST"})
     *
     * @param Request $request
     * @param OrderService $orderService
     *
     * @return Response|JsonResponse
     */
    public function create(Request $request, OrderService $orderService)
    {
        try {
            $data = $this->getRequestContent($request);

            $order = $orderService->create($data);

            //commit changes to database
            $this->getDoctrine()->getManager()->flush();

            if ($order->getEmailInvoice()) {
                $this->emailService->sendOrderConfirmationEmail($order);
                return $this->respondSuccess();
            } else {
                return $this->respondSuccess($this->invoiceService->generateInvoice($order));
            }
        } catch (Exception $e) {
            $this->logger->error($e);

            return $this->respondError();
        }
    }
}
