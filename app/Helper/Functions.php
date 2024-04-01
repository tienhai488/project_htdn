<?php

use App\Models\TemporaryFile;

function getImageInStorage($field = '')
{
    $temporaryFile = TemporaryFile::where('field', $field)->orderByDesc('created_at')->first();

    if (empty($temporaryFile)) {
        return '';
    }

    return asset('storage/uploads/tmp/' . $temporaryFile->folder . '/' . $temporaryFile->filename);
}

function getImageListInStorage($field = '')
{
    $images = TemporaryFile::where('field', $field)->orderByDesc('created_at')->get();

    if (empty($images)) {
        return [];
    }

    $data = [];
    foreach ($images as $temporaryFile) {
        $data[] = asset('storage/uploads/tmp/' . $temporaryFile->folder . '/' . $temporaryFile->filename);
    }

    return $data;
}