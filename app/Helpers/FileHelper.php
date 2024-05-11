<?php

namespace App\Helpers;

use App\Exceptions\FileStorageException;
use Illuminate\Support\Facades\Storage;

class FileHelper
{       
    protected $disk;

    public function __construct()
    {
        $this->disk = Storage::disk('public');
    }
    
    /**
     * upload file
     *
     * @param string $folder_name
     * @param object $file
     *
     * @return string
     */
    public function upload(string $folder_name, object $file)
    {
        try {
            return $this->disk->put($folder_name, $file);
        } catch (\Throwable $th) {
            throw new FileStorageException('Failed to upload file');
        }
    }
        
    /**
     * Get whole path.
     *
     * @param string $file
     *
     * @return string
     */
    public function url(string $file)
    {
        return $this->disk->url($file);
    }
    
    /**
     * delete file
     *
     * @param string $file_name [folder name + file name]
     *
     * @return bool
     */
    public function delete(string $file_name)
    {
        try {
            return $this->disk->delete($file_name);
        } catch (\Throwable $th) {
            throw new FileStorageException('Failed to upload delete');
        }
    }
    
    /**
     * Check if file exist.
     *
     * @param $file_name [folder name + file name]
     *
     * @return bool
     */
    public function exist($file_name)
    {
        try {
            return $this->disk->exists($file_name);
        } catch (\Throwable $th) {
            throw new FileStorageException('Failed to check file if exist');
        }
    }
}