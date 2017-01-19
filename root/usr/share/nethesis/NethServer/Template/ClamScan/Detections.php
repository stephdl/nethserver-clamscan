<?php
/* @var $view Nethgui\Renderer\Xhtml */
echo $view->header()->setAttribute('template', $T('SpecialDetection_header'));
echo $view->panel()
    ->insert($view->fieldset('')->setAttribute('template', $T('SpecialDetect_label')))
    ->insert($view->checkbox('AlgoDetection', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
    ->insert($view->checkbox('BlockEncrypted', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
    ->insert($view->checkbox('BlockMacros', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
    ->insert($view->checkbox('DetectStructured', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
    ->insert($view->checkbox('DetectBroken', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
    ->insert($view->checkbox('PartInstersection', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
;

echo $view->buttonList($view::BUTTON_SUBMIT | $view::BUTTON_HELP);
