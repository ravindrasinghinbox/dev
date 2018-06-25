<?php

class Point2D {

    public $x;
    public $y;

    function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }

    function x() {
        return $this->x;
    }

    function y() {
        return $this->y;
    }

}

class Point {

    protected $vertices;

    function __construct($vertices) {

        $this->vertices = $vertices;
    }

    //Determines if the specified point is within the polygon. 
    function pointInPolygon($point) {
        /* @var $point Point2D */
        $poly_vertices = $this->vertices;
        $num_of_vertices = count($poly_vertices);

        $edge_error = 1.192092896e-07;
        $r = false;

        for ($i = 0, $j = $num_of_vertices - 1; $i < $num_of_vertices; $j = $i++) {
            /* @var $current_vertex_i Point2D */
            /* @var $current_vertex_j Point2D */
            $current_vertex_i = $poly_vertices[$i];
            $current_vertex_j = $poly_vertices[$j];

            if (abs($current_vertex_i->y - $current_vertex_j->y) <= $edge_error && abs($current_vertex_j->y - $point->y) <= $edge_error && ($current_vertex_i->x >= $point->x) != ($current_vertex_j->x >= $point->x)) {
                return true;
            }

            if ($current_vertex_i->y > $point->y != $current_vertex_j->y > $point->y) {
                $c = ($current_vertex_j->x - $current_vertex_i->x) * ($point->y - $current_vertex_i->y) / ($current_vertex_j->y - $current_vertex_i->y) + $current_vertex_i->x;

                if (abs($point->x - $c) <= $edge_error) {
                    return true;
                }

                if ($point->x < $c) {
                    $r = !$r;
                }
            }
        }

        return $r;
    }
}
?>
<?php
$vertices = array();
array_push($vertices, new Point2D(25.774, -80.190));
array_push($vertices, new Point2D(18.466, -66.118));
array_push($vertices, new Point2D(32.321, -64.757));
array_push($vertices, new Point2D(25.774, -80.190));


$Point = new Point($vertices);
// $point_to_find = new Point2D(13.103491, 80.128121);
$point_to_find = new Point2D(25.774, -80.180);
$isPointInPolygon = $Point->pointInPolygon($point_to_find);
echo $isPointInPolygon;
var_dump($isPointInPolygon);
?>