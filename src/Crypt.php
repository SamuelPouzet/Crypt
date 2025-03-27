<?php

namespace SamuelPouzet\Crypt;

use SamuelPouzet\Crypt\Exception\InvalidArgumentException;
use SamuelPouzet\Crypt\Interface\CryptInterface;
use SamuelPouzet\Crypt\Options\Bcrypt as BcryptOptions;
use SamuelPouzet\Crypt\Options\Argon as ArgonOptions;
use Traversable;

class Crypt implements CryptInterface
{
    protected string $algorithm;
    protected array $options = [];

    public function __construct(iterable $options = [], string $algorithm = PASSWORD_DEFAULT)
    {

        $this->setAlgorithm($algorithm);
        if (!empty($options)) {
            $this->setOptions($options);
        }
    }

    public function hash(string $plaintext): string
    {
        return password_hash($plaintext, $this->algorithm, $this->options);
    }

    public function verify(string $ciphertext, string $plaintext): bool
    {
        return password_verify($ciphertext, $plaintext);
    }


    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    protected function setAlgorithm(string $algorithm): static
    {
        $availableAlgos = password_algos();
        if (!in_array($algorithm, $availableAlgos)) {
            throw new \InvalidArgumentException('Unknown algorithm: ' . $algorithm);
        }
        $this->algorithm = $algorithm;
        return $this;
    }

    protected function setOptions(array $options): static
    {
        if ($options instanceof Traversable) {
            $options = iterator_to_array($options);
        }

        if (!is_array($options)) {
            throw new InvalidArgumentException(
                'The options parameter must be an array or a Traversable'
            );
        }

        switch ($this->algorithm) {
            case PASSWORD_DEFAULT :
            case PASSWORD_BCRYPT:
                $this->options = BcryptOptions::checkOptions($options);
                break;
            case PASSWORD_ARGON2I:
            case PASSWORD_ARGON2ID:
                $this->options = ArgonOptions::checkOptions($options);
                break;
            default:
                throw new InvalidArgumentException(sprintf('The algorithm "%s" is not supported', $this->algorithm));

        }
        return $this;
    }

}