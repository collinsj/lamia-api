<?php

namespace App\Service;

use App\Entity\Order;
use App\Entity\Product;
use DateTime;
use Exception;

class OrderService extends AbstractService
{
    /**
     * @param array $data
     *
     * @return Order
     * @throws Exception
     */
    public function create(array $data): Order
    {
        $order = (new Order())->fill($data)->setOrderDate(new DateTime());
        $orderTotalAmount = 0;

        foreach ($data['products'] as $productData) {
            /** @var Product $product */
            $product = $this->entityManager->getRepository(Product::class)->find($productData['id'] ?? null);
            if ($product && isset($productData['quantity'])) {
                $quantity = (int)$productData['quantity'];
                $taxPercentage = $this->productHelper->getTaxPercentage($product, $data['country']);
                $basePrice = $this->productHelper->getPriceInclTax($product, $data['country']);
                $totalBasePrice = $quantity * $basePrice;

                $orderItem = (new Order\Item())
                    ->setProduct($product)
                    ->setBasePrice($basePrice)
                    ->setQuantity($productData['quantity'])
                    ->setTaxPercentage($taxPercentage)
                    ->setTotalBasePrice($totalBasePrice)
                    ->setCreatedAt(new DateTime());

                $orderTotalAmount += $totalBasePrice;

                $order->addItem($orderItem);
            }
        }

        $order->setTotalAmount($orderTotalAmount);

        $this->save($order);

        return $order;
    }
}
