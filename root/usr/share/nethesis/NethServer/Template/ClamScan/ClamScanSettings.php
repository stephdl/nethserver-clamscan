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
    ->insert($view->columns()
        ->insert($view->textInput('MaxScanFile', $view::LABEL_ABOVE))
        ->insert($view->textArea('FilesystemScanExclude', $view::LABEL_ABOVE)->setAttribute('dimensions', '6x25')))

        ->insert($view->fieldset('')->setAttribute('template', $T('QuarantineText_label')))
            ->insert($view->columns()
                ->insert($view->checkbox('Quarantine', 'enabled')->setAttribute('uncheckedValue', 'disabled'))
                ->insert($view->checkbox('reallyWantToMove', 'enabled')->setAttribute('uncheckedValue', 'disabled')))

);

echo $view->buttonList($view::BUTTON_SUBMIT | $view::BUTTON_HELP)
        ->insert($view->button('Freshclam', $view::BUTTON_SUBMIT)->setAttribute('label', $T('Freshclam_label')));
