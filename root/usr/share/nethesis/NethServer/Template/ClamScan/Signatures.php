<?php
/* @var $view Nethgui\Renderer\Xhtml */
echo $view->header()->setAttribute('template', $T('Signatures_header'));
echo $view->panel()


    ->insert($view->fieldset('')->setAttribute('template', $T('Signatures_label')))
       ->insert($view->fieldsetSwitch('Bytecode', 'enabled',$view::FIELDSETSWITCH_CHECKBOX | $view::FIELDSETSWITCH_EXPANDABLE)->setAttribute('uncheckedValue', 'disabled')
            ->insert($view->checkbox('BytecodeUnsigned', 'enabled')->setAttribute('uncheckedValue', 'disabled')))
        ->insert($view->checkbox('FilesystemScanUnofficialSigs', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
        ->insert($view->checkbox('PhishingSigs', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
        ->insert($view->checkbox('PhishingScanUrl', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
;
echo $view->buttonList($view::BUTTON_SUBMIT);
