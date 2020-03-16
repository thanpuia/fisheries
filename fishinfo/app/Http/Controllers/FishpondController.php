<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fishpond;


class FishpondController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'district' => 'required',
            'image' => 'required',
            'pondImages'=>''
        ]);
        // for single images
        if ($files = $request->file('image')) {
            $destinationPath = 'public/image/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $insert['image'] = "$profileImage";
         }

         //for multiple images
         if($request->hasfile('file'))
         {
 
            foreach($request->file('file') as $file)
            {
                $filename=$file->getClientOriginalName();
                $file->move('public/pond/', $pondImages);  
                $insert[]['file'] = "$filename";
            }
         }




 
        $fishpond = new Fishpond();
        $fishpond->district = $request->district;
        $fishpond->image = $profileImage;
 
        if (auth()->user()->fishponds()->save($fishpond))
            return response()->json([
                'success' => true,
                'data' => $fishpond->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Product could not be added'
            ], 500);
    }
}
