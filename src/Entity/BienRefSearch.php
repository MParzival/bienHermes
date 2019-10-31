<?php


namespace App\Entity;


class BienRefSearch
{
    /**
     * @var int|null
     */
    private $numero;

    /**
     * @return int|null
     */
    public function getNumero(): ?int
    {
        return $this->numero;
    }

    /**
     * @param int|null $numero
     * @return BienRefSearch
     */
    public function setNumero(int $numero): BienRefSearch
    {
        $this->numero = $numero;
        return $this;
    }


}