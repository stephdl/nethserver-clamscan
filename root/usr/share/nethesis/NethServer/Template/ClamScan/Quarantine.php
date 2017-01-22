<?php
echo $view->checkBox('restoreAll','enabled')->setAttribute('uncheckedValue', 'disabled');
echo $view->selector('restore', $view::SELECTOR_MULTIPLE);
echo $view->buttonList($view::BUTTON_SUBMIT);
