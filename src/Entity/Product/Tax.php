<?php

namespace App\Entity\Product;

use App\Entity\AbstractEntity;
use App\Entity\Product;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product_tax")
 */
class Tax extends AbstractEntity
{
    /**
     * @var Product
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected Product $product;

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="country", type="string", length=3, nullable=false)
     */
    protected string $country;

    /**
     * @var int
     *
     * @ORM\Column(name="percentage", type="smallint", nullable=false)
     */
    protected int $percentage;

    /**
     * @var DateTimeInterface
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected DateTimeInterface $createdAt;

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPercentage(): int
    {
        return $this->percentage;
    }

    public function setPercentage(int $percentage): self
    {
        $this->percentage = $percentage;

        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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
