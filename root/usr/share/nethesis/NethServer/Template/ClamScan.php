<?php
/* @var $view Nethgui\Renderer\Xhtml */
echo $view->header()->setAttribute('template', $T('ClamScan_header'));
echo $view->panel()
    ->insert($view->fieldsetSwitch('status', 'enabled',$view::FIELDSETSWITCH_CHECKBOX | $view::FIELDSETSWITCH_EXPANDABLE)->setAttribute('uncheckedValue', 'disabled')
/*
    ->insert($view->textInput('TCPPort'))
    ->insert($view->fieldsetSwitch('PublicAccess', 'private', $view::FIELDSETSWITCH_EXPANDABLE)
        ->insert($view->fieldsetSwitch('WebAuth', 'enabled',$view::FIELDSETSWITCH_CHECKBOX | $view::FIELDSETSWITCH_EXPANDABLE)->setAttribute('uncheckedValue', 'disabled')
            ->insert($view->textArea('ShellUsers', $view::LABEL_ABOVE)->setAttribute('dimensions', '5x30')->setAttribute('placeholder', $view['ShellUsers_default']))))
    ->insert($view->fieldsetSwitch('PublicAccess', 'public', $view::FIELDSETSWITCH_EXPANDABLE)
        ->insert($view->textArea('ShellUsers', $view::LABEL_ABOVE)->setAttribute('dimensions', '5x30')->setAttribute('placeholder', $view['ShellUsers_default'])))
    ->insert($view->fieldsetSwitch('PublicAccess', 'IP',$view::FIELDSETSWITCH_EXPANDABLE)
        ->insert($view->textArea('FixedIP', $view::LABEL_ABOVE)->setAttribute('dimensions', '5x30')->setAttribute('placeholder', $view['FixedIP_default']))
        ->insert($view->fieldsetSwitch('WebAuth', 'enabled',$view::FIELDSETSWITCH_CHECKBOX | $view::FIELDSETSWITCH_EXPANDABLE)->setAttribute('uncheckedValue', 'disabled')
            ->insert($view->textArea('ShellUsers', $view::LABEL_ABOVE)->setAttribute('dimensions', '5x30')->setAttribute('placeholder', $view['ShellUsers_default']))))
*/
->insert($view->radioButton('FilesystemScan', 'daily'))
->insert($view->radioButton('FilesystemScan', 'weekly'))

->insert($view->fieldsetSwitch('DetectPua', 'enabled',$view::FIELDSETSWITCH_CHECKBOX | $view::FIELDSETSWITCH_EXPANDABLE)->setAttribute('uncheckedValue', 'disabled')
    ->insert($view->textInput('ExcludePua'))
)
->insert($view->checkbox('Bytecode', 'enabled')->setAttribute('uncheckedValue', 'disabled'))

->insert($view->textInput('FilesystemScanExclude'))

->insert($view->checkbox('BlockEncrypted', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
->insert($view->checkbox('DetectBroken', 'enabled')->setAttribute('uncheckedValue', 'disabled'))

->insert($view->checkbox('ScanArchive', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
->insert($view->checkbox('ScanElf', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
->insert($view->checkbox('ScanHTML', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
->insert($view->checkbox('ScanMail', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
->insert($view->checkbox('ScanOle2', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
->insert($view->checkbox('ScanPdf', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
->insert($view->checkbox('ScanPe', 'enabled')->setAttribute('uncheckedValue', 'disabled'))

);
echo $view->buttonList($view::BUTTON_SUBMIT | $view::BUTTON_HELP);
