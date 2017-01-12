<?php
namespace NethServer\Module\ClamScan;


use Nethgui\System\PlatformInterface as Validate;

/**
 *
 *
 * @author stephane de Labrusse <stephdl@de-labrusse.fr>
 */
class Pua extends \Nethgui\Controller\AbstractController
{

    public function initialize()
    {
        parent::initialize();
        $this->declareParameter('DetectPua', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'DetectPua'));
        $this->declareParameter('ExcludePua', Validate::ANYTHING, array('configuration', 'clamscan', 'ExcludePua'));
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
