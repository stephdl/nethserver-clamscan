<?php
namespace NethServer\Module\ClamScan;


use Nethgui\System\PlatformInterface as Validate;

/**
 *
 *
 * @author stephane de Labrusse <stephdl@de-labrusse.fr>
 */
class Signatures extends \Nethgui\Controller\AbstractController
{


    public function initialize()
    {
        parent::initialize();

        $this->declareParameter('Bytecode', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'Bytecode'));
        $this->declareParameter('FilesystemScanUnofficialSigs', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'FilesystemScanUnofficialSigs'));
        $this->declareParameter('PhishingSigs', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'PhishingSigs'));
        $this->declareParameter('PhishingScanUrl', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'PhishingScanUrl'));
        $this->declareParameter('BytecodeUnsigned', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'BytecodeUnsigned'));
    }

}
