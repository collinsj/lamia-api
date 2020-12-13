<?php

namespace App\Service;

use App\Util\ProductHelper;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Base class for app services
 */
abstract class AbstractService
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;

    /**
     * @var ProductHelper
     */
    protected ProductHelper $productHelper;

    public function __construct(EntityManagerInterface $entityManager, ProductHelper $productHelper)
    {
        $this->entityManager = $entityManager;
        $this->productHelper = $productHelper;
    }

    /**
     * @param object $entity
     */
    protected function save(object $entity): void
    {
        if (!$this->entityManager->contains($entity)) {
            $this->entityManager->persist($entity);
        }
    }

    /**
     * @param object $entity
     */
    protected function delete(object $entity): void
    {
        $this->entityManager->remove($entity);
    }
}
