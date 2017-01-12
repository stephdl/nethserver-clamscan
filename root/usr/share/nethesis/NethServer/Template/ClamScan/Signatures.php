<?php
/* @var $view Nethgui\Renderer\Xhtml */
echo $view->header()->setAttribute('template', $T('Signatures_header'));
echo $view->panel()


       ->insert($view->fieldset('')->setAttribute('template', $T('Signatures_label')))
            ->insert($view->columns()
                ->insert($view->checkbox('Bytecode', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('BytecodeUnsigned', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('PhishingSigs', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('PhishingScanUrl', 'enabled')->setAttribute('uncheckedValue', 'disabled')))

            ->insert($view->columns()
                ->insert($view->checkbox('FilesystemScanUnofficialSigs', 'enabled')->setAttribute('uncheckedValue', 'disabled')))
;

echo $view->buttonList($view::BUTTON_SUBMIT | $view::BUTTON_HELP);
