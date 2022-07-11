<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    /**
     * @var int|null
     */
    private $maxPrice;
    /**
     * @var int|null
     */
    private $minSurface;

    /**
     * Get the value of maxPrice
     * * @Assert\Range(
     *      min = 10,
     *      max = 400,
     *      notInRangeMessage = "La surface doit être comprise entre {{ min }}m² et {{ max }}m²",
     * )
     * @return  int|null
     */ 
    public function getMaxPrice() : ?int
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of maxPrice
     *
     * @param  int|null  $maxPrice
     *
     * @return  self
     */ 
    public function setMaxPrice(int $maxPrice) : PropertySearch
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * Get the value of minSurface
     *
     * @return  int|null
     */ 
    public function getMinSurface() : ?int
    {
        return $this->minSurface;
    }

    /**
     * Set the value of minSurface
     *
     * @param  int|null  $minSurface
     *
     * @return  self
     */ 
    public function setMinSurface(int $minSurface) : PropertySearch
    {
        $this->minSurface = $minSurface;

        return $this;
    }
}