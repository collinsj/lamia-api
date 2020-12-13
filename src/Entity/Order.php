<?php

namespace App\Entity;

use App\Entity\Order\Item;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="order_flat")
 */
class Order extends AbstractEntity
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
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Order\Item", mappedBy="order", cascade={"persist", "remove"})
     */
    protected Collection $items;

    /**
     * Country Alpha-3 code
     *
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=3, nullable=false)
     */
    protected string $country;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=200, nullable=false)
     */
    protected string $email;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_format", type="string", length=50, nullable=false)
     */
    protected string $invoiceFormat;

    /**
     * @var bool
     *
     * @ORM\Column(name="email_invoice", type="boolean", nullable=false)
     */
    protected bool $emailInvoice;

    /**
     * @var float
     *
     * @ORM\Column(name="total_amount", type="float", nullable=false)
     */
    protected float $totalAmount;

    /**
     * @var DateTimeInterface
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected DateTimeInterface $orderDate;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceFormat(): string
    {
        return $this->invoiceFormat;
    }

    /**
     * @param string $invoiceFormat
     *
     * @return $this
     */
    public function setInvoiceFormat(string $invoiceFormat): self
    {
        $this->invoiceFormat = $invoiceFormat;

        return $this;
    }

    /**
     * @return bool
     */
    public function getEmailInvoice(): bool
    {
        return $this->emailInvoice;
    }

    /**
     * @param bool $emailInvoice
     *
     * @return $this
     */
    public function setEmailInvoice(bool $emailInvoice): self
    {
        $this->emailInvoice = $emailInvoice;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    /**
     * @param float $totalAmount
     *
     * @return $this
     */
    public function setTotalAmount(float $totalAmount): self
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getOrderDate(): DateTimeInterface
    {
        return $this->orderDate;
    }

    /**
     * @param DateTimeInterface $orderDate
     *
     * @return $this
     */
    public function setOrderDate(DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * @return ArrayCollection|Item[]
     */
    public function getItems(): ArrayCollection
    {
        return $this->items;
    }

    /**
     * @param Item $item
     *
     * @return $this
     */
    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setOrder($this);
        }

        return $this;
    }
}
