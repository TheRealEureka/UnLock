<?php /** @noinspection PhpPropertyOnlyWrittenInspection */
namespace App\Domain;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'card')]
final class Card
{
    #[Id, Column(name: 'id', type: 'integer'), GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(name: 'numCarte', type: 'string', unique: true, nullable: false)]
    private string $numCarte;

    #[Column(name: 'image', type: 'string', unique: true, nullable: false)]
    private string $image;

    #[Column(name: 'image_back', type: 'string', unique: true, nullable: true)]
    private string $image_back;

    #[Column(name: 'type', type: 'string', unique: false, nullable: true)]
    private string $type;

    #[Column(name: 'use', type: 'string', unique: false, nullable: true)]
    private string $use;

    #[Column(name: 'require', type: 'string', unique: false, nullable: true)]
    private string $require;



    public function __construct(int $numCarte, int $type, string $image, string $use, string $imgae_back=null)
    {
        $this->numCarte = $numCarte;
        $this->type = $type;
        $this->image = $image;
        $this->image_back = $imgae_back;
        $this->use = $use;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getNumCarte(): int
    {
        return $this->numCarte;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getImage(): string
    {
        return $this->image;
    }
    public function getImageBack(): string
    {
        return $this->image_back;
    }
    public function getUse(): string
    {
        return $this->use;
    }
    public function getRequire(): string
    {
        return $this->require;
    }
}
