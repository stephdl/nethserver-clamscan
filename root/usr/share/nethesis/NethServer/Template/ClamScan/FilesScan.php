<?php
/* @var $view Nethgui\Renderer\Xhtml */
echo $view->header()->setAttribute('template', $T('ScanSpecificElements_header'));
echo $view->panel()

        ->insert($view->fieldset('')->setAttribute('template', $T('ScanElements_label')))
                ->insert($view->checkbox('ScanArchive', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanElf', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanHTML', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanHwp', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanMail', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanOle2', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanPdf', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanPe', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanSwf', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanXML', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
;

echo $view->buttonList($view::BUTTON_SUBMIT);
