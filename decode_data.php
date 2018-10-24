<?php
    function decode_data($data)
    {
        $decoded_data = json_decode($data, true);
        return $decoded_data;
    }
?>