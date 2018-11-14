<?php

namespace timetables\cartesius;

/**
 * Class Cartesius.
 */
class Cartesius
{
    /**
     * @var int
     */
    public $lastBestX = 0;

    /**
     * @var int
     */
    public $lastBestY = 0;

    /**
     * @var Dimensions
     */
    public $x;

    /**
     * @var Dimensions
     */
    public $y;

    /**
     * @var array
     */
    public $output = [];

    public $limit;

    public $iteration = 0;

    /**
     * @param Dimensions $d
     */
    public function setXDimension(Dimensions $d)
    {
        $this->x = $d;
    }

    /**
     * @param Dimensions $d
     */
    public function setYDimension(Dimensions $d)
    {
        $this->y = $d;
    }

    /**
     * @param Coordinates $coordinates
     * @param Datum       $criteriaX
     * @param Datum       $criteriaY
     *
     * @throws TimetableException
     *
     * @return array
     */
    public function Visits(Coordinates $coordinates, Datum $criteriaX, Datum $criteriaY)
    {
        if (!$this->x && $this->y instanceof Dimensions) {
            throw new TimetableException('Coordinates x and y must set first.');
        }
        $position = $coordinates->getLastCoordinate();
        $this->limit = $this->x->getSize() * $this->y->getSize();
        while (true) {
            if ($this->x->get($position['x'])->CalculateFits($criteriaX) === Datum::EQUALS) {
                $this->x->get($position['x'])->isFits = true;
                $this->lastBestX = $position['x'];
            } elseif ($this->x->get($position['x'])->CalculateFits($criteriaX) === Datum::CLOSE) {
                $this->lastBestX = $position['x'];
            }
            if ($this->y->get($position['y'])->CalculateFits($criteriaY) === Datum::EQUALS) {
                $this->y->get($position['y'])->isFits = true;
                $this->lastBestY = $position['y'];
            } elseif ($this->y->get($position['y'])->CalculateFits($criteriaY) === Datum::CLOSE) {
                $this->lastBestY = $position['y'];
            }
            if ($this->limit === 0) {
                break;
            }
            if ($this->x->get($position['x'])->isFits && $this->y->get($position['y'])->isFits) {
                break;
            }
            $position = $coordinates->shuffleCoordinate($this->x, $this->y);

            $this->limit--;
            $this->iteration++;
        }

        return $position;
    }
}
