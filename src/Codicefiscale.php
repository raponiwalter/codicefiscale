<?php
/**
 * Codicefiscale.php
 */
Namespace Wraps;

/**
 * Class Codicefiscale
 * php version >= 7.1
 *
 * @category   PHP
 * @package    Wraps_Utilities
 * @subpackage Wraps_Utilities_Codicefiscale
 * @author     Walter Raponi <walter.raponi@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT License
 * @version    1.0.0
 * @link       https://github.com/raponiwalter/codicefiscale
 */

class Codicefiscale
{
    /**
     * Controllo della sintassi del codice fiscale
     * 
     * @param String $fiscalcode codice fiscale
     * 
     * @return bool
     */
    public function checkSyntaxCodicefiscale(string $fiscalcode) : bool
    {
        $fiscalcode = strtoupper($fiscalcode);
        $regxp = '/^[A-Z]{6}[A-Z0-9]{2}[A-Z][A-Z0-9]{2}[A-Z][A-Z0-9]{3}[A-Z]$/';

        return (bool)preg_match($regxp, $fiscalcode);
    }

    /**
     * Metodo veloce di controllo
     * 
     * @param String $fiscalcode codice fiscale
     * 
     * @return bool
     */
    public function isCodicefiscale(string $fiscalcode) : bool
    {    
        $codiceControllo = $this->codiceControllo($fiscalcode);
        $fiscalcodeChar = substr($fiscalcode, -1);

        return $fiscalcodeChar == $codiceControllo &&
        !empty($codiceControllo);
    }

    /**
     * Ritorna il codice controllo del codice fiscale
     * 
     * @param String $fiscalcode codice fiscale
     * 
     * @return String
     */
    public function codiceControllo(string $fiscalcode) : string
    {

        if (!$this->checkSyntaxCodicefiscale($fiscalcode)) {
            return false;
        }

        $splittedString = str_split(strtoupper(trim($fiscalcode)));

        $dispari = [
            '0' => 1,
            '1' => 0,
            '2' => 5,
            '3' => 7,
            '4' => 9,
            '5' => 13,
            '6' => 15,
            '7' => 17,
            '8' => 19,
            '9' => 21,
            'A' => 1,
            'B' => 0,
            'C' => 5,
            'D' => 7,
            'E' => 9,
            'F' => 13,
            'G' => 15,
            'H' => 17,
            'I' => 19,
            'J' => 21,
            'K' => 2,
            'L' => 4,
            'M' => 18,
            'N' => 20,
            'O' => 11,
            'P' => 3,
            'Q' => 6,
            'R' => 8,
            'S' => 12,
            'T' => 14,
            'U' => 16,
            'V' => 10,
            'W' => 22,
            'X' => 25,
            'Y' => 24,
            'Z' => 23
        ];

        $pari = [
            '0' => 0,
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9,
            'A' => 0,
            'B' => 1,
            'C' => 2,
            'D' => 3,
            'E' => 4,
            'F' => 5,
            'G' => 6,
            'H' => 7,
            'I' => 8,
            'J' => 9,
            'K' => 10,
            'L' => 11,
            'M' => 12,
            'N' => 13,
            'O' => 14,
            'P' => 15,
            'Q' => 16,
            'R' => 17,
            'S' => 18,
            'T' => 19,
            'U' => 20,
            'V' => 21,
            'W' => 22,
            'X' => 23,
            'Y' => 24,
            'Z' => 25
        ];

        $valueFrom = null;
        $somma = 0;
        $splittedString = array_filter($splittedString);
        array_pop($splittedString);

        foreach ($splittedString as $key => $curChar) {
            $valueFrom = (!$this->_isOdd($key)) ? 'dispari' : 'pari';
            $somma += ${$valueFrom}[$curChar];
        }

        $resto = $somma % 26;
        $values = array_flip($pari);

        return  $values[$resto];
    }

    /**
     * Controlla se il numero è dispari
     * 
     * @param Int $what valore da controllare
     * 
     * @return bool
     */
    private function _isOdd(int $what) : bool
    {
        return (bool)($what & 1);
    }

}