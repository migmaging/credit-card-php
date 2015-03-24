<?php
namespace Plansky\CreditCard;

/**
* It calculates the sum of a given number using Luhm's algorithm
*/
class LuhmCalculator
{
    /**
     * Executes Luhm algorithm over the given number and return the sum. This
     * method does not include last digit of credit card number (verification
     * digit).
     *
     * @param string|integer $number
     *
     * @return integer
     */
    public function sum($number)
    {
        $numberArray = array_reverse(str_split($number));

        $sum = 0;
        for ($index = 0; $index < count($numberArray); $index++) {
            $digit = (int)$numberArray[$index];
            $sum += ($index % 2 == 0) ? $this->multiplyNumber($digit) : $digit;
        }

        return $sum;
    }

    /**
     * Retrives the corresponding verfication digit of the given credit card
     * number. If the verification digit is ten, returns zero
     *
     * @param string|integer $number
     *
     * @return integer
     */
    public function verificationDigit($number)
    {
        return 10 - ($this->sum($number) % 10 ?: 10);
    }
}