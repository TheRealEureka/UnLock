<?php /** @noinspection PhpPropertyOnlyWrittenInspection */
namespace App\Domain;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'game')]
final class Game
{

    #[Id, Column(name: 'id', type: 'integer'), GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(name: 'id_user', type: 'integer', unique: true, nullable: false)]
    private int $id_user;

    #[Column(name: 'currents_cards', type: 'string', unique: false, nullable: false)]
    private string $currents_cards;

    #[Column(name: 'user_penality', type: 'string', unique: false, nullable: false)]
    private string $user_penality;

    #[Column(name: 'user_time', type: 'string', unique: false, nullable: false)]
    private string $user_time;



    public function __construct(string $id_user, string $currents_cards, string $user_penality, string $user_time)
    {
        $this->id_user = $id_user;
        $this->currents_cards = $currents_cards;
        $this->user_penality = $user_penality;
        $this->user_time = $user_time;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @return string
     */
    public function getCurrentsCards(): string
    {
        return $this->currents_cards;
    }

    /**
     * @return string
     */
    public function getUserPenality(): string
    {
        return $this->user_penality;
    }

    /**
     * @return string
     */
    public function getUserTime(): string
    {
        return $this->user_time;
    }

    /**
     * @param string $currents_cards
     */
    public function setCurrentsCards(string $currents_cards): void
    {
        $this->currents_cards = $currents_cards;
    }

    /**
     * @param string $user_penality
     */
    public function setUserPenality(string $user_penality): void
    {
        $this->user_penality = $user_penality;
    }

    /**
     * @param string $user_time
     */
    public function setUserTime(string $user_time): void
    {
        $this->user_time = $user_time;
    }





}
