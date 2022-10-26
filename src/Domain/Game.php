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

    #[Column(name: 'starting_timer', type: 'string', unique: false, nullable: false)]
    private string $starting_timer;



    public function __construct(string $id_user, string $currents_cards, string $user_penality, string $starting_timer)
    {
        $this->id_user = $id_user;
        $this->currents_cards = $currents_cards;
        $this->user_penality = $user_penality;
        $this->starting_timer = $starting_timer;
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
    public function getStartingTimer(): string
    {
        return $this->starting_timer;
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
     * @param string $starting_timer
     */
    public function setStartingTimer(string $starting_timer): void
    {
        $this->starting_timer = $starting_timer;
    }





}
