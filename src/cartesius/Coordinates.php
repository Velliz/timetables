<?php

namespace timetables\cartesius;

/**
 * Class Coordinates.
 */
class Coordinates
{
    /**
     * @var int
     */
    public $x = 0;

    /**
     * @var int
     */
    public $y = 0;

    /**
     * @var int
     */
    public $iteration = 0;

    /**
     * @param Dimensions $x
     * @param Dimensions $y
     *
     * @return array
     */
    public function shuffleCoordinate(Dimensions $x, Dimensions $y)
    {
        $this->iteration++;

        return [
            'x' => $this->x = rand(0, ($x->getSize() - 1)),
            'y' => $this->y = rand(0, ($y->getSize() - 1)),
        ];
    }

    /**
     * @return array
     */
    public function getLastCoordinate()
    {
        return [
            'x' => $this->x,
            'y' => $this->y,
        ];
    }

    /**
     * @return int
     */
    public function getLastX()
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getLastY()
    {
        return $this->y;
    }
}
