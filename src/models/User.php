<?php declare(strict_types=1);

namespace App\models;

use ncryptf\Token;

final class User
{
    public $id;
    public $email;
    public $password;

    private static $users = [
        // c0rect h0rs3 b@tt3y st@Pl3
        'clara.oswald@example.com' => [
            'password' => '$argon2i$v=19$m=1024,t=2,p=2$MGh1eGhJYTIwTWU0TUoybA$3a4LT/3mj3mzuY5Nj9HHv/y+6timGJQEGcd/2AtQYP',
            'id' => 1
        ]
    ];

    public function __construct(int $id, string $email, string $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Returns an Token object for the user
     * @return Token
     */
    public function getToken() : Token
    {
        return new Token(
            'x2gMeJ5Np0CcKpZav+i9iiXeQBtaYMQ/yeEtcOgY3J',
            'LRSEe5zHb1aq20Hr9te2sQF8sLReSkO8bS1eD/9LDM8',
            \base64_decode('f2mTaH9vkZZQyF7SxVeXDlOSDbVwjUzhdXv2T/YYO8k='),
            \base64_decode('7v/CdiGoEI7bcj7R2EyDPH5nrCd2+7rHYNACB+Kf2FMx405und2KenGjNpCBPv0jOiptfHJHiY3lldAQTGCdqw=='),
            \strtotime('+4 hours')
        );
    }

    /**
     * Returns a user if it exists
     * @param string $email
     * @return User
     */
    public static function findByEmail(string $email) :? User
    {
        if (isset(static::$users[$email])) {
            $user = static::$users[$email];
            return new static($user['id'], $email, $user['password']);
        }

        return null;
    }
}
