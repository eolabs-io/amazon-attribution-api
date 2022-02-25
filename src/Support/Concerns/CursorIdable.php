<?php

namespace EolabsIo\AmazonAttributionApi\Support\Concerns;

use Illuminate\Support\Collection;

trait CursorIdable
{
    /** @var string */
    private $cursorId;


    public function checkForCursorId(Collection $results): self
    {
        $cursorId = $results->get('cursorId');
        $this->setCursorId($cursorId);

        return $this;
    }

    public function clearCursorId(): self
    {
        $this->setCursorId();

        return $this;
    }

    public function getCursorId(): ?string
    {
        return $this->cursorId;
    }

    public function setCursorId(string $cursorId = null): self
    {
        $this->cursorId = $cursorId;

        return $this;
    }

    public function hasCursorId(): bool
    {
        return filled($this->getCursorId());
    }

    public function getCursorIdParameter(): array
    {
        return ['cursorId' => $this->getCursorId()];
    }
}
