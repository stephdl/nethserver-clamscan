<?php
/* @var $view Nethgui\Renderer\Xhtml */
echo $view->header()->setAttribute('template', $T('ClamScan_header'));
echo $view->panel()

       ->insert($view->fieldset('')->setAttribute('template', $T('PuaText_label')))
           ->insert($view->fieldsetSwitch('DetectPua', 'enabled',$view::FIELDSETSWITCH_CHECKBOX | $view::FIELDSETSWITCH_EXPANDABLE)->setAttribute('uncheckedValue', 'disabled')
           ->insert($view->textInput('ExcludePua')))

;
echo $view->buttonList($view::BUTTON_SUBMIT | $view::BUTTON_HELP);
