<?php
function pointInPolygon($point = [],$poly_vertices = []) {
    /* @var $point Point2D */
    $num_of_vertices = count($poly_vertices);

    $edge_error = 1.192092896e-07;
    $r = false;

    for ($i = 0, $j = $num_of_vertices - 1; $i < $num_of_vertices; $j = $i++) {
        /* @var $current_vertex_i Point2D */
        /* @var $current_vertex_j Point2D */
        $current_vertex_i = $poly_vertices[$i];
        $current_vertex_j = $poly_vertices[$j];

        if (abs($current_vertex_i[1] - $current_vertex_j[1]) <= $edge_error && abs($current_vertex_j[1] - $point[1]) <= $edge_error && ($current_vertex_i[0] >= $point[0]) != ($current_vertex_j[0] >= $point[0])) {
            return true;
        }

        if ($current_vertex_i[1] > $point[1] != $current_vertex_j[1] > $point[1]) {
            $c = ($current_vertex_j[0] - $current_vertex_i[0]) * ($point[1] - $current_vertex_i[1]) / ($current_vertex_j[1] - $current_vertex_i[1]) + $current_vertex_i[0];

            if (abs($point[0] - $c) <= $edge_error) {
                return true;
            }

            if ($point[0] < $c) {
                $r = !$r;
            }
        }
    }
    return $r;
}

$vertices = [
    [25.774, -80.190],
    [18.466, -66.118],
    [32.321, -64.757],
    [25.774, -80.190]
];

$point_to_find = array(25.774, -80.181);
$isPointInPolygon = pointInPolygon($point_to_find, $vertices);
var_dump($isPointInPolygon);
?>