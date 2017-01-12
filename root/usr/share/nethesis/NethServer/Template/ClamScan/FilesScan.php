<?php
/* @var $view Nethgui\Renderer\Xhtml */
echo $view->header()->setAttribute('template', $T('ClamScan_header'));
echo $view->panel()

        ->insert($view->fieldset('')->setAttribute('template', $T('ScanElements_label')))
            ->insert($view->columns()
                ->insert($view->checkbox('ScanArchive', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanElf', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanHTML', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanSwf', 'enabled')->setAttribute('uncheckedValue', 'disabled')))

            ->insert($view->columns()
                ->insert($view->checkbox('ScanOle2', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanPdf', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanMail', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanPe', 'enabled')->setAttribute('uncheckedValue', 'disabled')))

;

echo $view->buttonList($view::BUTTON_SUBMIT | $view::BUTTON_HELP);
