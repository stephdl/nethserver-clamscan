<?php
/* @var $view Nethgui\Renderer\Xhtml */
echo $view->header()->setAttribute('template', $T('ClamScan_header'));
echo $view->panel()

->insert($view->fieldsetSwitch('status', 'enabled',$view::FIELDSETSWITCH_CHECKBOX | $view::FIELDSETSWITCH_EXPANDABLE)->setAttribute('uncheckedValue', 'disabled')

    ->insert($view->fieldsetSwitch('FilesystemScan', 'daily', $view::FIELDSETSWITCH_EXPANDABLE)
        ->insert($view->selector('JobHour', $view::SELECTOR_DROPDOWN)))


    ->insert($view->fieldsetSwitch('FilesystemScan', 'weekly', $view::FIELDSETSWITCH_EXPANDABLE)
        ->insert($view->columns()
            ->insert($view->selector('JobDay', $view::SELECTOR_DROPDOWN))
            ->insert($view->selector('JobHour', $view::SELECTOR_DROPDOWN))))

    ->insert($view->textArea('FilesystemScanExclude', $view::LABEL_ABOVE)->setAttribute('dimensions', '6x25'))

    ->insert($view->fieldset('', $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('ClamScanAdvanced_label'))

        ->insert($view->fieldset('')->setAttribute('template', $T('QuarantineText_label')))
            ->insert($view->columns()
                ->insert($view->checkbox('Quarantine', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('reallyWantToMove', 'enabled')->setAttribute('uncheckedValue', 'disabled')))

        ->insert($view->fieldset('')->setAttribute('template', $T('MethodOfDetection_label')))
            ->insert($view->columns()
            ->insert($view->checkbox('AlgoDetection', 'enabled')->setAttribute('uncheckedValue', 'disabled')))

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


        ->insert($view->fieldset('')->setAttribute('template', $T('SpecialDetect_label')))
            ->insert($view->columns()
                ->insert($view->checkbox('DetectStructured', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('DetectBroken', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('BlockEncrypted', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('PartInstersection', 'enabled')->setAttribute('uncheckedValue', 'disabled')))

       ->insert($view->fieldset('')->setAttribute('template', $T('PuaText_label')))
           ->insert($view->fieldsetSwitch('DetectPua', 'enabled',$view::FIELDSETSWITCH_CHECKBOX | $view::FIELDSETSWITCH_EXPANDABLE)->setAttribute('uncheckedValue', 'disabled')
           ->insert($view->textInput('ExcludePua')))

       ->insert($view->fieldset('')->setAttribute('template', $T('Signatures_label')))
            ->insert($view->columns()
                ->insert($view->checkbox('Bytecode', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('BytecodeUnsigned', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('PhishingSigs', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('PhishingScanUrl', 'enabled')->setAttribute('uncheckedValue', 'disabled')))

            ->insert($view->columns()
                ->insert($view->checkbox('FilesystemScanUnofficialSigs', 'enabled')->setAttribute('uncheckedValue', 'disabled')))
    )
);

echo $view->buttonList($view::BUTTON_SUBMIT | $view::BUTTON_HELP);
