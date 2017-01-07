<?php
namespace NethServer\Module;


use Nethgui\System\PlatformInterface as Validate;

/**
 *
 *
 * @author stephane de Labrusse <stephdl@de-labrusse.fr>
 */
class ClamScan extends \Nethgui\Controller\AbstractController
{

    protected function initializeAttributes(\Nethgui\Module\ModuleAttributesInterface $base)
    {
        return \Nethgui\Module\SimpleModuleAttributesProvider::extendModuleAttributes($base, 'Security', 6);
    }

    public function initialize()
    {
        parent::initialize();

        $this->declareParameter('BlockEncrypted', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'BlockEncrypted'));
        $this->declareParameter('Bytecode', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'Bytecode'));
        $this->declareParameter('DetectBroken', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'DetectBroken'));
        $this->declareParameter('DetectPua', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'DetectPua'));
        $this->declareParameter('ExcludePua', Validate::ANYTHING, array('configuration', 'clamscan', 'ExcludePua'));
        $this->declareParameter('FilesystemScan', $this->createValidator()->memberOf('daily','weekly'), array('configuration', 'clamscan', 'FilesystemScan'));
        $this->declareParameter('FilesystemScanExclude', Validate::ANYTHING, array('configuration', 'clamscan', 'FilesystemScanExclude'));
        $this->declareParameter('FilesystemScanUnofficialSigs', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'FilesystemScanUnofficialSigs'));
        $this->declareParameter('Quarantine', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'Quarantine'));
        $this->declareParameter('ScanArchive', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanArchive'));
        $this->declareParameter('ScanElf', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanElf'));
        $this->declareParameter('ScanHTML', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanHTML'));
        $this->declareParameter('ScanMail', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanMail'));
        $this->declareParameter('ScanOle2', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanOle2'));
        $this->declareParameter('ScanPdf', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanPdf'));
        $this->declareParameter('ScanPe', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanPe'));


        $this->declareParameter('WebAuth', Validate::SERVICESTATUS, array('configuration', 'shellinaboxd', 'WebAuth'));
        $this->declareParameter('ShellUsers', Validate::ANYTHING, array('configuration', 'shellinaboxd', 'ShellUsers'));
        $this->declareParameter('PublicAccess', $this->createValidator()->memberOf('private','public','IP'), array('configuration', 'shellinaboxd', 'PublicAccess'));
    }

    protected function onParametersSaved($changedParameters)
    {
        parent::onParametersSaved($changedParameters);
        $this->getPlatform()->signalEvent('nethserver-clamscan-save');
    }

}
