<?php

declare(strict_types=1);

namespace Timesplinter\Blockchain;

/**
 * @author Pascal Muenst <pascal@timesplinter.ch>
 */
abstract class Block implements BlockInterface
{

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var null|string
     */
    protected $previousHash;

    /**
     * @var string
     */
    protected $data;

    /**
     * @var \DateTime
     */
    protected $timestamp;

    /**
     * @param string $data
     * @param \DateTime $timestamp
     */
    public function __construct(string $data, \DateTime $timestamp)
    {
        $this->data = $data;
        $this->timestamp = $timestamp;
        $this->hash = $this->calculateHash();
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return null|string
     */
    public function getPreviousHash(): ?string
    {
        return $this->previousHash;
    }

    /**
     * @param null|string $previousHash
     * @return void
     */
    public function setPreviousHash(?string $previousHash): void
    {
        $this->previousHash = $previousHash;
        $this->hash = $this->calculateHash();
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    protected function calculateHash(): string
    {
        return hash('sha256', (string) $this);
    }

    public function __toString(): string
    {
        return $this->data . $this->timestamp->format('c') . $this->previousHash;
    }
}
