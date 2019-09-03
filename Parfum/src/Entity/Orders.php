<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $orderDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OderLine", mappedBy="orders")
     */
    private $oderLines;

    public function __construct()
    {
        $this->oderLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * @return Collection|OrderLine[]
     */
    public function getOderLines(): Collection
    {
        return $this->oderLines;
    }

    public function addOderLine(OrderLine $oderLine): self
    {
        if (!$this->oderLines->contains($oderLine)) {
            $this->oderLines[] = $oderLine;
            $oderLine->setOrders($this);
        }

        return $this;
    }

    public function removeOderLine(OrderLine $oderLine): self
    {
        if ($this->oderLines->contains($oderLine)) {
            $this->oderLines->removeElement($oderLine);
            // set the owning side to null (unless already changed)
            if ($oderLine->getOrders() === $this) {
                $oderLine->setOrders(null);
            }
        }

        return $this;
    }
}
