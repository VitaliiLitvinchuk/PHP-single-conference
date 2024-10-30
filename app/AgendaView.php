<?php

declare(strict_types=1);

namespace ConferenceApp;

class AgendaView
{
    /**
     * @var Agenda
     */
    private $agenda;

    /**
     * @param Agenda $agenda
     */
    public function __construct(Agenda $agenda)
    {
        $this->agenda = $agenda;
    }

    /**
     * @return int
     */
    public function getNumberOfSlots(): int
    {
        /**
         * @todo: Implement it
         */
        return $this->agenda->count();
    }

    /**
     * @return float
     */
    public function getDurationInMinutes(): float
    {
        $duration = 0;
        $previousEndAt = null;

        foreach ($this->agenda as $slot) {
            if ($previousEndAt) {
                $duration += max(0, $slot->getStartAt()->getTimestamp() - $previousEndAt->getTimestamp());
            }
            $duration += $slot->getEndAt()->getTimestamp() - $slot->getStartAt()->getTimestamp();
            $previousEndAt = $slot->getEndAt();
        }

        return $duration / 60;
    }
}
