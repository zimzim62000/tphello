<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WeaponRepository")
 */
class Weapon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $damage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WeaponUser", mappedBy="weapon")
     */
    private $weaponUsers;

    public function __construct()
    {
        $this->weaponUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDamage()
    {
        return $this->damage;
    }

    public function setDamage($damage): self
    {
        $this->damage = $damage;

        return $this;
    }

    /**
     * @return Collection|WeaponUser[]
     */
    public function getWeaponUsers(): Collection
    {
        return $this->weaponUsers;
    }

    public function addWeaponUser(WeaponUser $weaponUser): self
    {
        if (!$this->weaponUsers->contains($weaponUser)) {
            $this->weaponUsers[] = $weaponUser;
            $weaponUser->setWeapon($this);
        }

        return $this;
    }

    public function removeWeaponUser(WeaponUser $weaponUser): self
    {
        if ($this->weaponUsers->contains($weaponUser)) {
            $this->weaponUsers->removeElement($weaponUser);
            // set the owning side to null (unless already changed)
            if ($weaponUser->getWeapon() === $this) {
                $weaponUser->setWeapon(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
