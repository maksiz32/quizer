<?php

return new PDO('mysql:host=localhost:3307;dbname=quiz', 'admin', '123QWEasd', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
 