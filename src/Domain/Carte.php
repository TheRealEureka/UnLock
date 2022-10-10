<?php

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'cartes')]
final class Carte
{
    #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'integer', unique: true, nullable: false)]
    private string $numCarte;

    #[Column(type: 'integer', unique: true, nullable: false)]
    private string $type;

    #[Column(type: 'string', unique: true, nullable: false)]
    private string $cheminImage;


    public function __construct(int $numCarte, int $type, string $cheminImage)
    {
        $this->numCarte = $numCarte;
        $this->type = $type;
        $this->cheminImage = $cheminImage;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumCarte(): int
    {
        return $this->numCarte;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getCheminImage(): string
    {
        return $this->cheminImage;
    }
}