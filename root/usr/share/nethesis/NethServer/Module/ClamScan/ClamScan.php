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
/*        $weekdays = $this->createValidator()->memberOf(array('1d','2d','3d',
                '4d','5d','6d','7d'));
        $hour = $this->createValidator()->memberOf(array('1h','2h','3h',
                '4h','5h','6h','7h','8h','9h','10h',
                        '11h','12h','13h','14h','15h','16h','17h',
                                '18h','19h','20h','21h','22h','23h'));
*/
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
        $this->declareParameter('JobHour', Validate::ANYTHING, array('configuration', 'clamscan', 'JobHour'));
        $this->declareParameter('JobDay', Validate::ANYTHING, array('configuration', 'clamscan', 'JobDay'));
        $this->declareParameter('AlgoDetection', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'AlgoDetection'));
        $this->declareParameter('DetectStructured', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'DetectStructured'));
        $this->declareParameter('PartInstersection', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'PartInstersection'));
        $this->declareParameter('PhishingSigs', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'PhishingSigs'));
        $this->declareParameter('PhishingScanUrl', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'PhishingScanUrl'));
        $this->declareParameter('ScanSwf', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'ScanSwf'));
        $this->declareParameter('BytecodeUnsigned', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'BytecodeUnsigned'));
        $this->declareParameter('MaxScanFile', Validate::POSITIVE_INTEGER, array('configuration', 'clamscan', 'MaxScanFile'));
    }

    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);
        $view['JobDayDatasource'] = \Nethgui\Renderer\AbstractRenderer::hashToDatasource(array(
                '1d' => $view->translate('MONDAY'),
                '2d' => $view->translate('TUESDAY'),
                '3d' => $view->translate('WEDNESDAY'),
                '4d' => $view->translate('THURSDAY'),
                '5d' => $view->translate('FRIDAY'),
                '6d' => $view->translate('SATURDAY'),
                '7d' => $view->translate('SUNDAY'),
        ));

        $view['JobHourDatasource'] = \Nethgui\Renderer\AbstractRenderer::hashToDatasource(array(
                '0h' => $view->translate('${0} Hour', array(0)),
                '1h' => $view->translate('${0} Hour', array(1)),
                '2h' => $view->translate('${0} Hour', array(2)),
                '3h' => $view->translate('${0} Hour', array(3)),
                '4h' => $view->translate('${0} Hour', array(4)),
                '5h' => $view->translate('${0} Hour', array(5)),
                '6h' => $view->translate('${0} Hour', array(6)),
                '7h' => $view->translate('${0} Hour', array(7)),
                '8h' => $view->translate('${0} Hour', array(8)),
                '9h' => $view->translate('${0} Hour', array(9)),
                '10h' => $view->translate('${0} Hour', array(10)),
                '11h' => $view->translate('${0} Hour', array(11)),
                '12h' => $view->translate('${0} Hour', array(12)),
                '13h' => $view->translate('${0} Hour', array(13)),
                '14h' => $view->translate('${0} Hour', array(14)),
                '15h' => $view->translate('${0} Hour', array(15)),
                '16h' => $view->translate('${0} Hour', array(16)),
                '17h' => $view->translate('${0} Hour', array(17)),
                '18h' => $view->translate('${0} Hour', array(18)),
                '19h' => $view->translate('${0} Hour', array(19)),
                '20h' => $view->translate('${0} Hour', array(20)),
                '21h' => $view->translate('${0} Hour', array(21)),
                '22h' => $view->translate('${0} Hour', array(22)),
                '23h' => $view->translate('${0} Hour', array(23)),
        ));
    }

    protected function onParametersSaved($changedParameters)
    {
        parent::onParametersSaved($changedParameters);
        $this->getPlatform()->signalEvent('nethserver-clamscan-save');
    }

}
