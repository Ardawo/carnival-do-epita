<?php

namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

/**
 * Class PaperPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class ArdawoPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
      $lastCH = $this->result->getLastChoiceFor($this->opponentSide);
      if ("scissors" == $lastCH) return parent::rockChoice();
      if ("paper" == $lastCH) return parent::scissorsChoice();
      if ("rock" == $lastCH) return parent::paperChoice();


      $stats = $this->result->getStats();
      $scissors = 0;
      $paper = 0;
      $rock = 0;

      $myChoices = $stats['a'];
      $oppChoices = $stats['b'];
      $getOppChoices = $this->result->getChoicesFor($this->opponentSide);
      $getOppScores = $this->result->getScoresFor($this->opponentSide);
      $i = 0;
      foreach ($getOppChoices as $key => $value) {
        $score = $getOppScores[$i];
        if ($value == 'scissors') $scissors += $score;
        if ($value == 'paper') $paper += $score;
        if ($value == 'rock') $rock += $score;
        $i = $i + 1;
      }
      $minChoiceOpp = 0;
      $rtVal = parent::paperChoice();
      if ($scissors < $minChoiceOpp) $rtVal =  parent::rockChoice();
      if ($paper < $minChoiceOpp) $rtVal =  parent::scissorsChoice();
      if ($rock < $minChoiceOpp) $rtVal =  parent::paperChoice();
      return $rtVal;

      if ($this->result->getNbRound() > 0) {
        $ch = $this->result->getLastChoiceFor($this->opponentSide);
        $lastScore = $this->result->getLastScoreFor($this->opponentSide);
        if ($lastScore == 5) {
          if ($ch == $getOppChoices[count($array)-2]) {
            if ($ch == 'scissors') return parent::rockChoice();
            if ($ch == 'paper') return parent::scissorsChoice();
            if ($ch == 'rock') return parent::paperChoice();
          }
        }
      }
      $finalChoice = 1;
      $minChoiceOpp = $oppChoices['scissors'];
      if ($minChoiceOpp > $oppChoices['paper']) {
        $minChoiceOpp = $oppChoices['paper'];
        $finalChoice = 2;
      }
      if ($minChoiceOpp > $oppChoices['rock']) {
        $minChoiceOpp = $oppChoices['rock'];
        $finalChoice = 3;
        return parent::rockChoice();
      }
      if ($finalChoice == 2) {
        return parent::paperChoice();
      }
      if ($finalChoice == 1) {
        return parent::scissorsChoice();
      }

        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
       // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        return parent::paperChoice();
  }
};
