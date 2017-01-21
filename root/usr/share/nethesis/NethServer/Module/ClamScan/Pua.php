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
                'Packed' => $view->translate('PACKED_label'),
                'PwTool' => $view->translate('PWTOOL_label'),
                'NetTool' => $view->translate('NETTOOL_label'),
                'P2P' => $view->translate('P2P_label'),
                'IRC' => $view->translate('IRC_label'),
                'RAT' => $view->translate('RAT_label'),
                'Tool' => $view->translate('TOOL_label'),
                'Spy' => $view->translate('SPY_label'),
                'Server' => $view->translate('SERVER_label'),
                'Script' => $view->translate('SCRIPT_label'),
        ));
    }
}
