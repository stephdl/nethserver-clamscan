<?php
namespace NethServer\Module\ClamScan;


use Nethgui\System\PlatformInterface as Validate;

/**
 *
 *
 * @author stephane de Labrusse <stephdl@de-labrusse.fr>
 */
class Detections extends \Nethgui\Controller\AbstractController
{

    public function initialize()
    {
        parent::initialize();

        $this->declareParameter('BlockEncrypted', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'BlockEncrypted'));
        $this->declareParameter('DetectBroken', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'DetectBroken'));
        $this->declareParameter('AlgoDetection', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'AlgoDetection'));
        $this->declareParameter('DetectStructured', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'DetectStructured'));
        $this->declareParameter('PartInstersection', Validate::SERVICESTATUS, array('configuration', 'clamscan', 'PartInstersection'));
    }

}
