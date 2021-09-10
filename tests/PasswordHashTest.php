<?php

declare(strict_types=1);

class PasswordHashTest extends \PHPUnit\Framework\TestCase
{

    /**
     * These should all succeed
     *
     * @dataProvider nonPortableHashes
     */
    public function testNonPortableHashes($password, $hash)
    {
        $hasher = new \Hautelook\Phpass\PasswordHash(5, false);
        $this->assertTrue($hasher->CheckPassword($password, $hash));
    }

    /**
     * These should all fail, we don't support portable hashes, sorry!
     *
     * @dataProvider portableHashes
     */
    public function testPortableHashes($password, $hash)
    {
        $hasher = new \Hautelook\Phpass\PasswordHash(5, false);
        $this->assertFalse($hasher->CheckPassword($password, $hash));
    }

    public function portableHashes()
    {
        yield from $this->hashes('portable');
    }

    public function nonPortableHashes()
    {
        yield from $this->hashes('non-portable');
    }

    private function hashes(string $group): \Generator
    {
        $hashes = json_decode(file_get_contents(__DIR__ . '/hashes.json'), true)[$group];

        foreach ($hashes as $word => $hash) {
            yield [$word, $hash];
        }
    }

}