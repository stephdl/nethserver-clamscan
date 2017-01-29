<?php
echo $view->header()->setAttribute('template', $T('Restore_header'));
echo $view->panel()
//->insert($view->checkBox('restoreAll','enabled')->setAttribute('uncheckedValue', 'disabled'))
->insert($view->button('Restore',$view::BUTTON_SUBMIT))
        ->insert($view->button('RestoreAll', $view::BUTTON_SUBMIT)->setAttribute('label', $T('RestoreAll_label')))

->insert($view->selector('restore', $view::SELECTOR_MULTIPLE))
->insert($view->fieldset('', $view::FIELDSET_EXPANDABLE)->setAttribute('template', $T('ListQuarantinedFiles_label'))
    ->insert($view->textLabel('report')->setAttribute('class', 'labeled-control ls ui-corner-all')->setAttribute('tag', 'div')));

$view->includeCss("
.ls { white-space: pre-wrap; padding: 4px; border: 1px solid #c2c2c2; width: 600px; background: #e2e2r2; color: #4b4b4b; }
");
