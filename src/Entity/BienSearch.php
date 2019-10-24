<?php


namespace App\Entity;


class BienSearch
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
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return BienSearch
     */
    public function setMaxPrice(int $maxPrice): BienSearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * @param int|null $minSurface
     * @return BienSearch
     */
    public function setMinSurface(int $minSurface): BienSearch
    {
        $this->minSurface = $minSurface;
        return $this;
    }





}