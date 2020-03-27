<?php
namespace P5\Gestion;

class Gestion{
    public $_tabMonth = [
            "1" => "janvier",
            "2" => "février",
            "3" => "mars",
            "4" => "avril",
            "5" => "mai",
            "6" => "juin",
            "7" => "juillet",
            "8" => "aout",
            "9" => "septembre",
            "10" => "octobre",
            "11" => "novembre",
            "12" => "décembre",
        ];
    public function reductionText(string $text, int $numberOfCharacters) :string
    {
        if(strlen($text) > $numberOfCharacters){
            $text = strip_tags($text);
            $str = substr($text, 0, $numberOfCharacters);
            $positionSpace = strpos($str, " ", -10);
            $str = substr($text, 0, $positionSpace);
            $str = $str."...";
            return $str;
        }
        else{
            $text = $text."...";
            return $text;
        }
    }
    /**
     * @param int $number
     * @return bool
     */
    public function controlNumber(int $number) :bool
    {
        if($number <= 0 || $number > 100000){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @param string $numberMonth
     * @return string
     */
    public function month(string $numberMonth) :string
    {
        $month = $this->_tabMonth[$numberMonth];
        return $month;
    }
}

