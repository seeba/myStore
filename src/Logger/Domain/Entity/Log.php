<?php

namespace App\Logger\Domain\Entity;

use App\Shared\Aggregate\AggregateRoot;
use DateTime;
use Ramsey\Uuid\Uuid;

class Log extends AggregateRoot 
{
    private ?string $id = null;
    private ?string $message = null;
    private array $context = [];
    private int $level;
    private ?string $levelName;
    private ?string $channel;
    private array $extra = [];
    private DateTime $createdAt;
    private ?string $formatted;

    public function __construct(string $id)
    {
        $this->createdAt = new DateTime();
        $this->id = $id;
    }

    /**
     * Get the value of id
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Get the value of message
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Set the value of message
     */
    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of context
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * Set the value of context
     */
    public function setContext(array $context): self
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get the value of level
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * Set the value of level
     */
    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get the value of levelName
     */
    public function getLevelName(): ?string
    {
        return $this->levelName;
    }

    /**
     * Set the value of levelName
     */
    public function setLevelName(?string $levelName): self
    {
        $this->levelName = $levelName;

        return $this;
    }

    /**
     * Get the value of channel
     */
    public function getChannel(): ?string
    {
        return $this->channel;
    }

    /**
     * Set the value of channel
     */
    public function setChannel(?string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get the value of extra
     */
    public function getExtra(): array
    {
        return $this->extra;
    }

    /**
     * Set the value of extra
     */
    public function setExtra(array $extra): self
    {
        $this->extra = $extra;

        return $this;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of formated
     */
    public function getFormatted(): ?string
    {
        return $this->formatted;
    }

    /**
     * Set the value of formated
     */
    public function setFormatted(?string $formatted): self
    {
        $this->formatted = $formatted;

        return $this;
    }

    public static function createLog($message, $context, $level, $levelName, $channel, $extra, $formatted)
    {
        $logId = Uuid::uuid4()->toString();
        $log = new Log($logId);
        $log
            ->setMessage($message)
            ->setContext($context)
            ->setLevel($level)
            ->setLevelName($levelName)
            ->setChannel($channel)
            ->setExtra($extra)
            ->setFormatted($formatted);

        return $log;
    }
}