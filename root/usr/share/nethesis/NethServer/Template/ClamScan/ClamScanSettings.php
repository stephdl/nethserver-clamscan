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

echo "<div class='dashboard-item'>";
echo "<dl>";
echo "<dt>".$T('statusDatabase_label')."</dt><dd><span class='";
if ($view['alarm']) {
    echo "antivirus-red'>".$T('warningDatabase_label');
} else {
    echo "antivirus-green'>".$T('okDatabase_label');
}
echo "<dt>".$T('timestamp_label')."</dt><dd>"; echo $view->textLabel('timestamp'); "</dd>";
echo "</div>";

$view->includeCSS("
  span.antivirus-green {
      padding: 3px;
      color: green;
      font-weight: bold;
  }
  span.antivirus-red {
      padding: 3px;
      color: red;
      font-weight: bold;
  }
");


echo $view->buttonList($view::BUTTON_SUBMIT)
        ->insert($view->button('Freshclam', $view::BUTTON_SUBMIT)->setAttribute('label', $T('Freshclam_label')))
        ->insert($view->button('ClamScanning', $view::BUTTON_SUBMIT)->setAttribute('label', $T('ClamScan_label')));
