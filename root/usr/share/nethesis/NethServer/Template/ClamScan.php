<?php
/* @var $view Nethgui\Renderer\Xhtml */
echo $view->header()->setAttribute('template', $T('ClamScan_header'));
echo $view->panel()

->insert($view->fieldsetSwitch('status', 'enabled',$view::FIELDSETSWITCH_CHECKBOX | $view::FIELDSETSWITCH_EXPANDABLE)->setAttribute('uncheckedValue', 'disabled')

    ->insert($view->radioButton('FilesystemScan', 'daily'))
    ->insert($view->radioButton('FilesystemScan', 'weekly'))

    ->insert($view->textLabel('PuaText_label')->setAttribute('template', $T('PuaText_label')))
    ->insert($view->fieldsetSwitch('DetectPua', 'enabled',$view::FIELDSETSWITCH_CHECKBOX | $view::FIELDSETSWITCH_EXPANDABLE)->setAttribute('uncheckedValue', 'disabled')
        ->insert($view->textInput('ExcludePua'))
    )
    ->insert($view->checkbox('Bytecode', 'enabled')->setAttribute('uncheckedValue', 'disabled'))

    ->insert($view->fieldset('', $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('ClamScanAdvanced_label'))
        ->insert($view->columns()
            ->insert($view->checkbox('Quarantine', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
            ->insert($view->checkbox('reallyWantToMove', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
        )

        ->insert($view->textInput('FilesystemScanExclude'))

        ->insert($view->textLabel('FalsePositif Warning_label')->setAttribute('template', $T('FalsePositif Warning_label')))
            ->insert($view->columns()
            ->insert($view->checkbox('DetectBroken', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
            ->insert($view->checkbox('FilesystemScanUnofficialSigs', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
        )

        ->insert($view->fieldset('', $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('ScanElements_label'))
            ->insert($view->columns()
                ->insert($view->checkbox('ScanArchive', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanElf', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanHTML', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanMail', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
            )
            ->insert($view->columns()
                ->insert($view->checkbox('ScanOle2', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanPdf', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('ScanPe', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('BlockEncrypted', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
    )))
);

echo $view->buttonList($view::BUTTON_SUBMIT | $view::BUTTON_HELP);
