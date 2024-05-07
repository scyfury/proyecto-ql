<?php

$json_string = file_get_contents('feed_data.json'); // Define la variable con una cadena vacía por defecto

// Convertir la cadena de texto JSON en un objeto PHP
$data = json_decode($json_string);

// Verificar si se pudo decodificar correctamente
if ($data === null) {
    die("Error al decodificar el JSON");
}
if (isset($data->Information)) 
{
    die("Error al cargar las noticias, Api no disponible");
}
// Iterar sobre el feed
foreach ($data->feed as $entrada) {
    echo '<div class="mx-auto p-2">';
    echo '<div class="card" style="width: 60rem;">';
    // Verificar si el banner_image es null
    echo '<img src="' . ($entrada->banner_image ? $entrada->banner_image : './IMG/gatierror.jpg') . '" class="card-img-top" alt="...">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $entrada->title . '</h5>';
    echo '<p class="card-text">' . $entrada->summary . '</p>';
    echo '<span>';
    echo '<a href="' . $entrada->url . '" class="btn btn-primary">Ir al artículo original</a>';
    echo '</span>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
