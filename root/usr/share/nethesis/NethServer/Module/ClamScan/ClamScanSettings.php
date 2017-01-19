<?php
namespace NethServer\Module\ClamScan;


use Nethgui\System\PlatformInterface as Validate;

/**
 *
 *
 * @author stephane de Labrusse <stephdl@de-labrusse.fr>
 */
class ClamScanSettings extends \Nethgui\Controller\AbstractController
{

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
        $this->declareParameter('FilesystemScan', $this->createValidator()->memberOf('daily','weekly'), array('configuration', 'clamscan', 'FilesystemScan'));
        $this->declareParameter('FilesystemScanExclude', Validate::ANYTHING, array('configuration', 'clamscan', 'FilesystemScanExclude'));
        $this->declareParameter('Quarantine', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'Quarantine'));
        $this->declareParameter('status', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'status'));
        $this->declareParameter('reallyWantToMove', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'reallyWantToMove'));
        $this->declareParameter('JobHour', Validate::ANYTHING, array('configuration', 'clamscan', 'JobHour'));
        $this->declareParameter('JobDay', Validate::ANYTHING, array('configuration', 'clamscan', 'JobDay'));
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
    public function process()
    {
        parent::process();

        if ($this->getRequest()->hasParameter('Freshclam')) {
            $this->getPlatform()->exec('/usr/bin/sudo  /usr/bin/systemctl start freshclam-nethgui.service');
        }
        if ($this->getRequest()->hasParameter('ClamScanning')) {
            $this->getPlatform()->exec('/usr/bin/sudo  /usr/bin/systemctl start clamscan-nethgui.service');
        }
    }

    protected function onParametersSaved($changedParameters)
    {
        parent::onParametersSaved($changedParameters);
        $this->getPlatform()->signalEvent('nethserver-clamscan-save');
    }

}
