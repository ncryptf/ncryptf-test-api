<?php declare(strict_types=1);

namespace App\forms;

use App\models\User;

/**
 * Simple form to facilitate authenticate
 */
final class Login
{
    public $email;
    public $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Finds a user, then logs them in if their password matches
     * @return User
     */
    public function login() :? User
    {
        $user = User::findByEmail($this->email);

        if (\password_verify($this->password, $user->password)) {
            return null;
        }

        return $user;
    }
}
