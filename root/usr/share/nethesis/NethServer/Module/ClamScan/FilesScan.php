<?php
namespace NethServer\Module\ClamScan;


use Nethgui\System\PlatformInterface as Validate;

/**
 *
 *
 * @author stephane de Labrusse <stephdl@de-labrusse.fr>
 */
class FilesScan extends \Nethgui\Controller\AbstractController
{

    public function initialize()
    {
        parent::initialize();

        $this->declareParameter('ScanArchive', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanArchive'));
        $this->declareParameter('ScanElf', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanElf'));
        $this->declareParameter('ScanHTML', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanHTML'));
        $this->declareParameter('ScanMail', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanMail'));
        $this->declareParameter('ScanOle2', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanOle2'));
        $this->declareParameter('ScanPdf', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanPdf'));
        $this->declareParameter('ScanPe', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanPe'));
        $this->declareParameter('ScanSwf', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanSwf'));
    }

}
