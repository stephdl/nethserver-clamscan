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
//        $this->declareParameter('restoreAll', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'restoreAll'));
        $this->declareParameter('restore', Validate::ANYTHING, array('configuration', 'clamscan', 'restore', ',;,;'));
    }

    private function readModules()
    {
        $values = array();
        foreach ($this->getPlatform()->getDatabase('quarantine')->getAll('quarantined') as $key=>$props) {
            if (!$props['filePath']) {
                $props['filePath'] = $key;
            }
            array_push ($values, $props['filePath']);
        }
        return $values;
    }

    private function getReport()
    {
        return $this->getPlatform()->exec("ls --time-style=long-iso -Ahgo  /var/spool/clamav/quarantine | awk '{print $3,$4,$5,$6}'")->getOutput();
    }

    public function bind(\Nethgui\Controller\RequestInterface $request)
    {
        parent::bind($request);
        $this->report = $this->getReport();
    }

    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        if (!$this->templates) {
            $this->templates = $this->readModules();
        }
        $view['restoreDatasource'] = array_map(function($fmt) use ($view) {
            return array($fmt, $view->translate($fmt));
        }, $this->templates);

        if (!$this->report) {
            $this->report = $this->getReport();
        }
        $view['report'] = $this->report;

        parent::prepareView($view);
    }


    public function process()
    {
        parent::process();

        if ($this->getRequest()->hasParameter('RestoreAll')) {
            $this->getPlatform()->signalEvent('nethserver-clamscan-restore-all');
        }
    }

    public function onParametersSaved($changes)
    {
        $this->getPlatform()->signalEvent('nethserver-clamscan-restore');
    }

}
