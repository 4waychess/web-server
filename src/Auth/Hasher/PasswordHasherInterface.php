<?php declare(strict_types=1);
/**
 * The adless and forever free 4 player chess server.
 *
 * @license <https://github.com/4waychess/web-server/blob/master/license>.
 * @link    <https://github.com/4waychess/web-server>.
 */

namespace FourWayChess\Auth\Hasher;

/**
 * The password hasher interface.
 */
interface PasswordHasherInterface
{
    /**
     * Compute the user's passwod hash.
     *
     * @param string $password The user's password.
     *
     * @return string|false Returns the hashed password, or false on failure. 
     */
    public function compute(string $password): string|false;

    /**
     * Verifies that a password matches a hash.
     *
     * @param string $password The user's password.
     * @param string $hash     A hash created by self::compute().
     *
     * @return bool Returns true if the password and hash match, or false otherwise. 
     */
    public function verify(string $password, string $hash): bool;

    /**
     * Checks if the given hash matches the options of the hasher.
     *
     * @param string $hash A hash created by self::compute().
     *
     * @return bool Returns true if the hash should be rehashed to match the current
     *              hasher algo and options, or false otherwise. 
     */
    public function needsRehash(string $hash): bool;
}
