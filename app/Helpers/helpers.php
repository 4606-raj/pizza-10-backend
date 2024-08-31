<?php

function fileUpload($file, $path) {
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->storeAs($path, $filename, 'public');

    return $filename;
}