<?php

namespace samuelpouzet\Crypt\Interface;

interface CryptInterface
{

    public function hash(string $plaintext);
    public function verify(string $ciphertext, string $plaintext);

}