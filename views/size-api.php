<?php

class SizeApi {

    public function outputSizes(array $sizes): void {

        $json = [
            'size-count' => count($sizes),
            'result' => $sizes
        ];
        header("Content-Type: application/json");
        echo json_encode($json);
    }

}

?>