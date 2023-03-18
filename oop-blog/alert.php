<?php

class Alert{
    function create_alert($type, $message) {
        echo '<div class="container mx-auto alert-container mt-5">';
        echo '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo $message;
        echo '</div>';
        echo '</div>';
    }
}
