<?php
if (!@include(PATH_VIEW."content/$loc" . "_content.php")) {
    include(PATH_ERRORS.'error404.html');
} 