<?php


namespace App\Entity;


class BienSearch
{
    /**
     * @var int
     */
    public $page;
    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     */
    private $minSurface;

    /**
     * @var string|null
     */
    private $title;

    /**
     * @var int|null
     */
    private $rentMax;

    /**
     * @var string|null
     */
    private $postalCode;

    /**
     * @var string|null
     */
    private $activite;


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

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return BienSearch
     */
    public function setTitle(string $title): BienSearch
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRentMax(): ?int
    {
        return $this->rentMax;
    }

    /**
     * @param int|null $rentMax
     * @return BienSearch
     */
    public function setRentMax(int $rentMax): BienSearch
    {
        $this->rentMax = $rentMax;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string|null $postalCode
     * @return BienSearch
     */
    public function setPostalCode(string $postalCode): BienSearch
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActivite(): ?string
    {
        return $this->activite;
    }

    /**
     * @param string|null $activite
     * @return BienSearch
     */
    public function setActivite(string $activite): BienSearch
    {
        $this->activite = $activite;
        return $this;
    }





}
