<?php

//Haha, it still runs almost 15 years later and just complaints about some deprecations.

require "html.class.php";
error_reporting(E_ERROR);

echo create('html')
    ->append(
        title('Test')->append(
            body('class','main',
                div('Some content'))));