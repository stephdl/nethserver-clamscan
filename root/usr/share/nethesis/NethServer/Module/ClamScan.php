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
        return \Nethgui\Module\SimpleModuleAttributesProvider::extendModuleAttributes($base, 'Configuration', 6);
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
        $this->declareParameter('status', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'status'));
        $this->declareParameter('reallyWantToMove', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'reallyWantToMove'));
        $this->declareParameter('JobHour', Validate::POSITIVE_INTEGER, array('configuration', 'clamscan', 'JobHour'));
        $this->declareParameter('JobDay', Validate::POSITIVE_INTEGER, array('configuration', 'clamscan', 'JobDay'));

    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);
        $view['JobDayDatasource'] = \Nethgui\Renderer\AbstractRenderer::hashToDatasource(array(
                '1' => $view->translate('MONDAY'),
                '2' => $view->translate('TUESDAY'),
                '3' => $view->translate('WEDNESDAY'),
                '4' => $view->translate('THURSDAY'),
                '5' => $view->translate('FRIDAY'),
                '6' => $view->translate('SATURDAY'),
                '7' => $view->translate('SUNDAY'),
        ));

        $view['JobHourDatasource'] = \Nethgui\Renderer\AbstractRenderer::hashToDatasource(array(
                '0' => $view->translate('${0} Hour', array(0)),
                '1' => $view->translate('${0} Hour', array(1)),
                '2' => $view->translate('${0} Hour', array(2)),
                '3' => $view->translate('${0} Hour', array(3)),
                '4' => $view->translate('${0} Hour', array(4)),
                '5' => $view->translate('${0} Hour', array(5)),
                '6' => $view->translate('${0} Hour', array(6)),
                '7' => $view->translate('${0} Hour', array(7)),
                '8' => $view->translate('${0} Hour', array(8)),
                '9' => $view->translate('${0} Hour', array(9)),
                '10' => $view->translate('${0} Hour', array(10)),
                '11' => $view->translate('${0} Hour', array(11)),
                '12' => $view->translate('${0} Hour', array(12)),
                '13' => $view->translate('${0} Hour', array(13)),
                '14' => $view->translate('${0} Hour', array(14)),
                '15' => $view->translate('${0} Hour', array(15)),
                '16' => $view->translate('${0} Hour', array(16)),
                '17' => $view->translate('${0} Hour', array(17)),
                '18' => $view->translate('${0} Hour', array(18)),
                '19' => $view->translate('${0} Hour', array(19)),
                '20' => $view->translate('${0} Hour', array(20)),
                '21' => $view->translate('${0} Hour', array(21)),
                '22' => $view->translate('${0} Hour', array(22)),
                '23' => $view->translate('${0} Hour', array(23)),
        ));
    }

    protected function onParametersSaved($changedParameters)
    {
        parent::onParametersSaved($changedParameters);
        $this->getPlatform()->signalEvent('nethserver-clamscan-save');
    }

}
