<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var ArrayCollection
     */
    private $options;

    /**
     * @var float|null
     */
    private $lat;

    /**
     * @var float|null
     */
    private $lng;

    /**
     * @var integer|null
     */
    private $distance;

    /**
     * @var string|null
     */
    private $city_search;

    /**
     * @var string|null
     */
    private $address_search;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

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

    /**
     * Get the value of options
     *
     * @return  ArrayCollection
     */ 
    public function getOptions() : ArrayCollection
    {
        return $this->options;
    }

    /**
     * Set the value of options
     *
     * @param  ArrayCollection  $options
     *
     * @return  self
     */ 
    public function setOptions(ArrayCollection $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get the value of lat
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * Set the value of lat
     */
    public function setLat($lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get the value of lng
     */
    public function getLng(): ?float
    {
        return $this->lng;
    }

    /**
     * Set the value of lng
     */
    public function setLng($lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get the value of distance
     */
    public function getDistance(): ?int
    {
        return $this->distance;
    }

    /**
     * Set the value of distance
     */
    public function setDistance($distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get the value of city_search
     */
    public function getCitySearch(): ?string
    {
        return $this->city_search;
    }

    /**
     * Set the value of city_search
     */
    public function setCitySearch($city_search): self
    {
        $this->city_search = $city_search;

        return $this;
    }

    /**
     * Get the value of address_search
     */
    public function getAddressSearch(): ?string
    {
        return $this->address_search;
    }

    /**
     * Set the value of address_search
     */
    public function setAddressSearch($address_search): self
    {
        $this->address_search = $address_search;

        return $this;
    }
}