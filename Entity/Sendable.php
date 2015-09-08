<?php

namespace Lpi\KernelBundle\Entity;


interface Sendable
{
    public function prepareForSending();

    public function getEmail();
}