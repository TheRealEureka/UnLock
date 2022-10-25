<?php /** @noinspection PhpPropertyOnlyWrittenInspection */
namespace App\Domain;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'user')]
final class User
{
    #[Id, Column(name: 'id', type: 'integer'), GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(name: 'username', type: 'string', unique: true, nullable: false)]
    private string $username;

    #[Column(name: 'password', type: 'string', unique: false, nullable: false)]
    private string $password;




    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT);

    }
    public function getId() : int{
        return $this->id;
    }
    public function getUsername() : string{
        return $this->username;
    }

    public function checkPassword($pass) : bool {
        return password_verify($pass, $this->password);
    }

}
