<?php
namespace NethServer\Module\ClamScan;


use Nethgui\System\PlatformInterface as Validate;

/**
 *
 *
 * @author stephane de Labrusse <stephdl@de-labrusse.fr>
 */
class Quarantine extends \Nethgui\Controller\AbstractController
{

    public function initialize()
    {
        parent::initialize();
        $this->declareParameter('restoreAll', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'restoreAll'));
        $this->declareParameter('restore', Validate::ANYTHING, array('configuration', 'clamscan', 'restore', ','));
    }


    private function readModules()
    {
$values =       (array_keys ($this->getPlatform()->getDatabase('quarantine')->getAll('quarantined')));
return $values;
    }

    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        if (!$this->templates) {
            $this->templates = $this->readModules();
        }
        $view['restoreDatasource'] = array_map(function($fmt) use ($view) {
            return array($fmt, $view->translate($fmt));
        }, $this->templates);
    }

    public function onParametersSaved($changes)
    {
        $this->getPlatform()->signalEvent('nethserver-clamscan-restore@post-process');
    }

}
