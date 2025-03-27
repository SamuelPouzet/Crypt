<?php

namespace samuelpouzet\Crypt;

use samuelpouzet\Exception\InvalidArgumentException;
use samuelpouzet\Interface\CryptInterface;
use Traversable;

class Crypt implements CryptInterface
{
    protected int $cost = 12;
    protected string $salt;
    protected string $algorithm = PASSWORD_DEFAULT;

    public function __construct(Iterable $options = [])
    {
        if (!empty($options)) {
            if ($options instanceof Traversable) {
                //todo creer un module d'utilitaires de tableaux
                $options = iterator_to_array($options);
            }

            if (!is_array($options)) {
                // todo utiliser l'Exception personnalisée
                throw new InvalidArgumentException(
                    'The options parameter must be an array or a Traversable'
                );
            }
            foreach ($options as $key => $option) {
                switch (strtolower($key)) {
                    case 'cost':
                        $this->setCost((int)$option);
                        break;
                    case 'salt':
                        $this->setSalt($option);
                        break;
                    case 'algorithm':
                        $this->setAlgorithm($option);
                        break;
                    default:
                        throw new InvalidArgumentException('Unknown option: ' . $key);
                }

            }
        }
    }

    public function hash(string $plaintext): string
    {
        return password_hash($plaintext, $this->algorithm, $this->options());
    }

    public function verify(string $ciphertext, string $plaintext): bool
    {
        return password_verify($ciphertext, $plaintext);
    }

    public function getSalt(): string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): static
    {
        $this->salt = $salt;
        return $this;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function setCost(int $cost): static
    {
        if ($cost < 4 || $cost > 31) {
            throw new \InvalidArgumentException('Cost must be a positive integer in range 4-31');
        }
        $this->cost = $cost;
        return $this;
    }

    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    public function setAlgorithm(string $algorithm): static
    {
        $availableAlgos = password_algos();
        if (!in_array($algorithm, $availableAlgos)) {
            throw new \InvalidArgumentException('Unknown algorithm: ' . $algorithm);
        }
        $this->algorithm = $algorithm;
        return $this;
    }

    protected function options() : array
    {
        $options = [
            "cost" => $this->cost,
        ];
        if($this->salt !== null){
            $options['salt'] = $this->salt;
        }
        return $options;
    }

}