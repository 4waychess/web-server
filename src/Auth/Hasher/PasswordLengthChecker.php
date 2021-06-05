<?php

declare(strict_types=1);
/**
 * The adless and forever free 4 player chess server.
 *
 * @license <https://github.com/4waychess/web-server/blob/master/license>.
 *
 * @link    <https://github.com/4waychess/web-server>.
 */

namespace FourWayChess\Auth\Hasher;

/**
 * The password length checker.
 */
trait PasswordLengthChecker
{
    /**
     * Check to see if a password is too long.
     *
     * @param string $password The user's password.
     *
     * @return bool Returns true if the password is too long
     *              else return false.
     */
    public function isPasswordTooLong(string $password): bool
    {
        return strlen($password) > 69;
    }
}
