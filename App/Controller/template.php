<?php

declare(strict_types=1);
// ce fichier n'est pas un controller, il ne devrait pas être dans ce répertoire.

    echo '<br><br><br>';
    echo "Nombre d'essaie restant : ".$game->numberEssay;
    echo '<br><br><br>';
    echo '<form action="/" method="GET">';
    for ($i = 0; $i < strlen($game->word); ++$i) {
        echo '<input type="text" name="letter'.$i.'" value="" maxlength="1">';
    }
    echo '<input type="submit" value="Valider">';
    echo '</form>';
