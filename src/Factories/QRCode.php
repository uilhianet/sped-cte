<?php

namespace NFePHP\CTe\Factories;

/**
 * Class QRCode create a string to make a QRCode string
 *
 * @category  NFePHP
 * @package   NFePHP\CTe\Factories\QRCode
 * @copyright NFePHP Copyright (c) 2008-2019
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Cleiton Perin <cperin20 at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-cte for the canonical source repository
 */

use DOMDocument;
use NFePHP\CTe\Exception\DocumentsException;

class QRCode
{
    /**
     * putQRTag
     * @param DOMDocument $dom CTe
     * @return string
     * @throws DocumentsException
     */
    public static function putQRTag(
        \DOMDocument $dom
    )
    {
        $cte = $dom->getElementsByTagName('CTe')->item(0);
        $infCte = $dom->getElementsByTagName('infCte')->item(0);
        $ide = $dom->getElementsByTagName('ide')->item(0);
        $chCTe = preg_replace('/[^0-9]/', '', $infCte->getAttribute("Id"));
        $tpAmb = $ide->getElementsByTagName('tpAmb')->item(0)->nodeValue;
        $qrcode = "https://dfe-portal.svrs.rs.gov.br/cte/qrCode?chCTe=$chCTe&tpAmb=$tpAmb";
        $infCTeSupl = $dom->createElement("infCTeSupl");
        $infCTeSupl->appendChild($dom->createElement('qrCodCTe', $qrcode));
        $signature = $dom->getElementsByTagName('Signature')->item(0);
        $cte->insertBefore($infCTeSupl, $signature);
        $dom->formatOutput = false;
        return $dom->saveXML();
    }

}
