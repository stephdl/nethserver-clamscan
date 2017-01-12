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
        $this->declareParameter('IncludePua', Validate::ANYTHING, array('configuration', 'clamscan', 'IncludePua', ','));
    }

    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);
        $view['IncludePuaDatasource'] = \Nethgui\Renderer\AbstractRenderer::hashToDatasource(array(
                'Packed' => $view->translate('Packed'),
                'PwTool' => $view->translate('PwTool'),
                'NetTool' => $view->translate('NetTool'),
                'P2P' => $view->translate('P2P'),
                'IRC' => $view->translate('IRC'),
                'RAT' => $view->translate('RAT'),
                'Tool' => $view->translate('Tool'),
                'Spy' => $view->translate('Spy'),
                'Server' => $view->translate('Server'),
                'Script' => $view->translate('Script'),
        ));

    }

    protected function onParametersSaved($changedParameters)
    {
        parent::onParametersSaved($changedParameters);
        $this->getPlatform()->signalEvent('nethserver-clamscan-save');
    }

}
