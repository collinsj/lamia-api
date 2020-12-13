<?php

namespace App\Entity\Order;

use App\Entity\AbstractEntity;
use App\Entity\Order;
use App\Entity\Product;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="order_item")
 */
class Item extends AbstractEntity
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="items")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected Order $order;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected Product $product;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    protected int $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="base_price", type="float", nullable=false)
     */
    protected float $basePrice;

    /**
     * @var int
     *
     * @ORM\Column(name="tax_percentage", type="smallint", nullable=false)
     */
    protected int $taxPercentage;

    /**
     * @var float
     *
     * @ORM\Column(name="total_base_price", type="float", nullable=false)
     */
    protected float $totalBasePrice;

    /**
     * @var DateTimeInterface
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected DateTimeInterface $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getBasePrice(): ?float
    {
        return $this->basePrice;
    }

    public function setBasePrice(float $basePrice): self
    {
        $this->basePrice = $basePrice;

        return $this;
    }

    public function getTaxPercentage(): ?int
    {
        return $this->taxPercentage;
    }

    public function setTaxPercentage(int $taxPercentage): self
    {
        $this->taxPercentage = $taxPercentage;

        return $this;
    }

    public function getTotalBasePrice(): ?float
    {
        return $this->totalBasePrice;
    }

    public function setTotalBasePrice(float $totalBasePrice): self
    {
        $this->totalBasePrice = $totalBasePrice;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
