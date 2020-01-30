<?php


namespace App\Interfaces;


/**
 * Interface UserInterface
 * @package App\Interfaces
 */
interface UserInterface
{
    public function getUsername(): string ;

    public function getEmail(): string ;

    public function getPassword(): string ;
}