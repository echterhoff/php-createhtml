<?php

//Haha, it still runs almost 15 years later and just complaints about some deprecations.

require "html.class.php";
error_reporting(E_ERROR);

echo html()->_parse_from_string('<div></div>');
echo create('html')
    ->append(
        title('Test')->append(
            body('class','main',
                div('Some content')
            )));