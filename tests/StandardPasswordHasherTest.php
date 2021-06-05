<?php

declare(strict_types=1);
/**
 * The adless and forever free 4 player chess server.
 *
 * @license <https://github.com/4waychess/web-server/blob/master/license>.
 *
 * @link    <https://github.com/4waychess/web-server>.
 */

namespace FourWayChess\Tests;

use FourWayChess\Auth\Hasher\StandardPasswordHasher as PasswordHasher;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Test the standard password hasher.
 */
class StandardPasswordHasherTest extends TestCase
{
    /**
     * @return void Returns nothing.
     */
    public function testBcryptConstruction(): void
    {
        $hasher = new PasswordHasher(PASSWORD_BCRYPT);
        $this->assertEquals(PASSWORD_BCRYPT, $hasher->passwordAlgo);
    }

    /**
     * @return void Returns nothing.
     */
    public function testArgon2iConstruction(): void
    {
        $hasher = new PasswordHasher(PASSWORD_ARGON2I);
        $this->assertEquals(PASSWORD_ARGON2I, $hasher->passwordAlgo);
    }

    /**
     * @return void Returns nothing.
     */
    public function testArgon2idConstruction(): void
    {
        $hasher = new PasswordHasher(PASSWORD_ARGON2ID);
        $this->assertEquals(PASSWORD_ARGON2ID, $hasher->passwordAlgo);
    }

    /**
     * @return void Returns nothing.
     */
    public function testBcryptException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $hasher = new PasswordHasher(PASSWORD_BCRYPT);
        $this->assertEquals(PASSWORD_BCRYPT, $hasher->passwordAlgo);
        $password = $hasher->compute('eP&=Mj]Vb],h$=Z@]LaK{b%V@M`(HY6"$Nd5UB]YjC^.BSuZM~J~LpY9nt\'8"Y{^bSA3{PqL(');
    }

    /**
     * @return void Returns nothing.
     */
    public function testBcryptCompute(): void
    {
        $hasher = new PasswordHasher(PASSWORD_BCRYPT);
        $this->assertEquals(PASSWORD_BCRYPT, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testArgon2iCompute(): void
    {
        $hasher = new PasswordHasher(PASSWORD_ARGON2I);
        $this->assertEquals(PASSWORD_ARGON2I, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testArgon2idCompute(): void
    {
        $hasher = new PasswordHasher(PASSWORD_ARGON2ID);
        $this->assertEquals(PASSWORD_ARGON2ID, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testBcryptVerify(): void
    {
        $hasher = new PasswordHasher(PASSWORD_BCRYPT);
        $this->assertEquals(PASSWORD_BCRYPT, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
        $this->assertTrue(!$hasher->verify('incorrect', $password));
        $this->assertTrue($hasher->verify('password', $password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testArgon2iVerify(): void
    {
        $hasher = new PasswordHasher(PASSWORD_ARGON2I);
        $this->assertEquals(PASSWORD_ARGON2I, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
        $this->assertTrue(!$hasher->verify('incorrect', $password));
        $this->assertTrue($hasher->verify('password', $password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testArgon2idVerify(): void
    {
        $hasher = new PasswordHasher(PASSWORD_ARGON2ID);
        $this->assertEquals(PASSWORD_ARGON2ID, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
        $this->assertTrue(!$hasher->verify('incorrect', $password));
        $this->assertTrue($hasher->verify('password', $password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testBcrypt2Argon2iRehash(): void
    {
        $hasher = new PasswordHasher(PASSWORD_BCRYPT);
        $this->assertEquals(PASSWORD_BCRYPT, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
        $hasher2 = new PasswordHasher(PASSWORD_ARGON2I);
        $this->assertEquals(PASSWORD_ARGON2I, $hasher2->passwordAlgo);
        $this->assertTrue($hasher2->needsRehash($password));
        $password = $hasher2->compute('password');
        $this->assertTrue(is_string($password));
        $this->assertTrue(!$hasher2->needsRehash($password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testBcrypt2Argon2idRehash(): void
    {
        $hasher = new PasswordHasher(PASSWORD_BCRYPT);
        $this->assertEquals(PASSWORD_BCRYPT, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
        $hasher2 = new PasswordHasher(PASSWORD_ARGON2ID);
        $this->assertEquals(PASSWORD_ARGON2ID, $hasher2->passwordAlgo);
        $this->assertTrue($hasher2->needsRehash($password));
        $password = $hasher2->compute('password');
        $this->assertTrue(is_string($password));
        $this->assertTrue(!$hasher2->needsRehash($password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testArgon2i2BcryptRehash(): void
    {
        $hasher = new PasswordHasher(PASSWORD_ARGON2I);
        $this->assertEquals(PASSWORD_ARGON2I, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
        $hasher2 = new PasswordHasher(PASSWORD_BCRYPT);
        $this->assertEquals(PASSWORD_BCRYPT, $hasher2->passwordAlgo);
        $this->assertTrue($hasher2->needsRehash($password));
        $password = $hasher2->compute('password');
        $this->assertTrue(is_string($password));
        $this->assertTrue(!$hasher2->needsRehash($password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testArgon2i2Argon2idRehash(): void
    {
        $hasher = new PasswordHasher(PASSWORD_ARGON2I);
        $this->assertEquals(PASSWORD_ARGON2I, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
        $hasher2 = new PasswordHasher(PASSWORD_ARGON2ID);
        $this->assertEquals(PASSWORD_ARGON2ID, $hasher2->passwordAlgo);
        $this->assertTrue($hasher2->needsRehash($password));
        $password = $hasher2->compute('password');
        $this->assertTrue(is_string($password));
        $this->assertTrue(!$hasher2->needsRehash($password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testArgon2id2BcryptRehash(): void
    {
        $hasher = new PasswordHasher(PASSWORD_ARGON2ID);
        $this->assertEquals(PASSWORD_ARGON2ID, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
        $hasher2 = new PasswordHasher(PASSWORD_BCRYPT);
        $this->assertEquals(PASSWORD_BCRYPT, $hasher2->passwordAlgo);
        $this->assertTrue($hasher2->needsRehash($password));
        $password = $hasher2->compute('password');
        $this->assertTrue(is_string($password));
        $this->assertTrue(!$hasher2->needsRehash($password));
    }

    /**
     * @return void Returns nothing.
     */
    public function testArgon2id2Argon2iRehash(): void
    {
        $hasher = new PasswordHasher(PASSWORD_ARGON2ID);
        $this->assertEquals(PASSWORD_ARGON2ID, $hasher->passwordAlgo);
        $password = $hasher->compute('password');
        $this->assertTrue(is_string($password));
        $hasher2 = new PasswordHasher(PASSWORD_ARGON2I);
        $this->assertEquals(PASSWORD_ARGON2I, $hasher2->passwordAlgo);
        $this->assertTrue($hasher2->needsRehash($password));
        $password = $hasher2->compute('password');
        $this->assertTrue(is_string($password));
        $this->assertTrue(!$hasher2->needsRehash($password));
    }
}
