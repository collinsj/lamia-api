<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @param Product $product
     * @param string $countryCode
     *
     * @return int
     */
    public function getProductTax(Product $product, string $countryCode): int
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT t.percentage
                 FROM App\Entity\Product\Tax t
                 WHERE
                 t.product = :product
                 AND
                 t.country = :country'
            )->setParameters(['product' => $product->getId(), 'country' => $countryCode]);
        try {
            return $query->getSingleScalarResult();
        } catch (Exception $e) {
            return 0;
        }
    }
}
