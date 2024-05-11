<?php

namespace App\Http\Controllers;

use App\Exceptions\FailedToCreateException;
use App\Helpers\FileHelper;
use App\Repositories\RegisterRepository;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $folder = 'uploads/profile_images';

    public function __construct(
        private FileHelper $fileHelper,
        private RegisterRepository $registerRepository
    ) {}

    public function register(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|max:100',
            'middle_name'   => 'nullable|string|max:100',
            'last_name'     => 'required|string|max:100',
            'email_address' => 'required|string|email|max:100|unique:users,email_address',
            'phone_number'  => 'required|numeric|unique:users,phone_number',
            'image'         => 'required|mimes:jpeg,png,gif'
        ]);

        $image = $this->fileHelper->upload($this->folder, $request->file('image'));

        $request->merge([
            'profile_image' => $this->fileHelper->url($image)
        ]);

        if($this->registerRepository->registerUser($request->all()) === false){
            throw new FailedToCreateException('Registration failed. Try again later');
        }

        return response()->json([
            'status'  => 'success', 
            'message' => 'Successfully registered.'
        ]);  
    }
}
