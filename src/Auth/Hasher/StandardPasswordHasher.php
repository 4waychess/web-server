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

use InvalidArgumentException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * The password hasher.
 */
final class StandardPasswordHasher extends AbstractPasswordHasher implements PasswordHasherInterface
{
    use PasswordLengthChecker;

    /** @var array The password hasher options. */
    private array $options = [];

    /**
     * Construct a new password hasher.
     *
     * @param int|string $passwordAlgo The password hasher algorithm to use.
     * @param array      $options      The password hasher options.
     *
     * @return void Returns nothing.
     */
    public function __construct(public int | string $passwordAlgo, array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $this->options = $resolver->resolve($options);
    }

    /**
     * Compute a new hash.
     *
     * @param string $password The password to hash.
     *
     * @return null|string Returns the hashed password.
     */
    public function compute(string $password): ?string
    {
        if ($this->isPasswordTooLong($password)) {
            throw new InvalidArgumentException('The password supplied is too long.');
        }

        return password_hash($password, $this->passwordAlgo, $this->options);
    }

    /**
     * Verify the password matches the hash provided.
     *
     * @param string $password The password check.
     * @param string $hash     The hash to check against.
     *
     * @return bool Returns true if the password matches the given hash else return false.
     */
    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Determine if the hash needs a rehash.
     *
     * @param string $hash The hash to check.
     *
     * @return bool Returns true if the hash needs a rehash and false if not.
     */
    public function needsRehash(string $hash): bool
    {
        return password_needs_rehash($hash, $this->passwordAlgo, $this->options);
    }

    /**
     * Configure the hasher options.
     *
     * @param OptionsResolver The symfony options resolver.
     *
     * @return void Returns nothing.
     */
    private function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'memory_cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
            'time_cost'   => PASSWORD_ARGON2_DEFAULT_TIME_COST,
            'threads'     => PASSWORD_ARGON2_DEFAULT_THREADS,
            'cost'        => 12,
        ]);
        $resolver->setAllowedTypes('memory_cost', 'int');
        $resolver->setAllowedTypes('time_cost', 'int');
        $resolver->setAllowedTypes('threads', 'int');
        $resolver->setAllowedTypes('cost', 'int');
    }
}
