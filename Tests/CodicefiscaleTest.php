<?php
/**
 * Unit test CodicefiscaleTest
 * 
 * @author Walter Raponi <walter.raponi@gmail.com>
 * 
 */

use PHPUnit\Framework\TestCase;
use Wraps\Codicefiscale;

/**
 * Test codice fiscale
 */
class CodicefiscaleTest extends TestCase
{

    protected Codicefiscale $Codicefiscale;

    /**
     * Data provider codici fiscali KO
     *
     * @return array
     */
    public function providerKo()
    {
        return [[
            false,
            [],
            null,
            11,
            0,
            1112,
            "111.3",
        ]];
    }

    /**
     * Data provider codici fiscali OK
     *
     * @return array
     */
    public function providerOk()
    {
        return [[
            'FRRNZE98B18F257D',
            'RSSVNT79B16L500J',
            'MSSBGG71H26H501M',
            'LRSCRS73D04C265T',
            'ZZZZRR92A01H146P',
            'CVLSTO00R10H501D',
        ]];
    }

    /**
     * Data provider codici fiscali sintassi valida controllo errato
     */
    public function providerSyntaxKo()
    {
        return [[
            'AAAAzzz__1113AA2', //bad syntax
            'ZPNWTR47A15EF88X', //good syntax
            'ABCDEF00A00A000F', //good syntax
        ]];
    }

    /**
     * Setup
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->Codicefiscale = new Codicefiscale();
    }

    /**
     * @dataProvider providerKo
     */
    public function testCheckBadSyntaxCodicefiscale($codicefiscale)
    {
        $this->assertFalse($this->Codicefiscale->checkSyntaxCodicefiscale($codicefiscale));
    }

    /**
     * @dataProvider providerOk
     */
    public function testCheckGoodSyntaxCodicefiscale($codicefiscale)
    {
        $this->assertTrue($this->Codicefiscale->checkSyntaxCodicefiscale($codicefiscale));
    }

    /**
     * @dataProvider providerKo
     */
    public function testIsNotCodicefiscale($codicefiscale)
    {
        $this->assertFalse($this->Codicefiscale->isCodicefiscale($codicefiscale));
    }

    /**
     * @dataProvider providerOk
     */
    public function testIsCodicefiscale($codicefiscale)
    {
        $this->assertTrue($this->Codicefiscale->isCodicefiscale($codicefiscale));
    }

    /**
     * @dataProvider providerKo
     */
    public function testCodiceControlloCodicefiscaleKo($codicefiscale)
    {
        $this->assertEmpty($this->Codicefiscale->codiceControllo($codicefiscale));
    }

    /**
     * @dataProvider providerOk
     */
    public function testCodiceControlloCodicefiscaleoK($codicefiscale)
    {
        $this->assertSame($this->Codicefiscale->codiceControllo($codicefiscale), substr($codicefiscale, -1));
    }

    /**
     * @dataProvider providerOk
     */
    public function testCodiceControlloOk($codicefiscale)
    {        
        $result = $this->Codicefiscale->codiceControllo($codicefiscale);
        $pos = substr($codicefiscale, -1);
        $this->assertSame($result, $pos);
    }

    /**
     * @dataProvider providerKo
     */
    public function testCodiceControlloKo($codicefiscale)
    {        
        $result = $this->Codicefiscale->codiceControllo($codicefiscale);
        $pos = substr($codicefiscale, -1);
        $this->assertEmpty($result);
    }

    /**
     * @dataProvider providerSyntaxKo
     */
    public function testBadSyntax($codicefiscale)
    {
        $codiceControllo = $this->Codicefiscale->codiceControllo($codicefiscale);
        $syntax = $this->Codicefiscale->checkSyntaxCodicefiscale($codicefiscale);
        $this->assertFalse($syntax);

        if (!empty($codiceControllo)) {
            $this->assertNotSame(substr($codicefiscale, -1), $codiceControllo);
            return;
        }

        $this->assertEmpty($codiceControllo);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->Codicefiscale);
    }

}