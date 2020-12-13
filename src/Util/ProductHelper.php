<?php

namespace App\Util;

use App\Entity\Product;
use App\Repository\ProductRepository;

class ProductHelper
{
    /**
     * @var ProductRepository
     */
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param Product $product
     * @param string $countryCode
     *
     * @return int
     */
    public function getTaxPercentage(Product $product, string $countryCode): int
    {
        return (int)$this->productRepository->getProductTax($product, $countryCode);
    }

    /**
     * @param Product $product
     * @param string $countryCode
     *
     * @return float
     */
    public function getPriceInclTax(Product $product, string $countryCode): float
    {
        $tax = $this->getTaxPercentage($product, $countryCode);

        $price = $product->getUnitPrice() + ($product->getUnitPrice() * ($tax / 100));

        return round($price, 2);
    }
}
