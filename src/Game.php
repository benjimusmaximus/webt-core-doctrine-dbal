<?php

namespace Htlw3r\DoctrineDbal;

class Game
{
    private $player1;
    private $player2;

    private $valueA;

    private $valueB;

    private $winner;

    private $date;

    /**
     * @param $player1
     * @param $player2
     * @param $valueA
     * @param $valueB
     * @param $winner
     * @param $date
     */
    public function __construct($player1, $player2, $valueA, $valueB, $winner, $date)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->valueA = $valueA;
        $this->valueB = $valueB;
        $this->winner = $winner;
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * @return mixed
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * @return mixed
     */
    public function getValueA()
    {
        return $this->valueA;
    }

    /**
     * @return mixed
     */
    public function getValueB()
    {
        return $this->valueB;
    }

    /**
     * @return mixed
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }




}
