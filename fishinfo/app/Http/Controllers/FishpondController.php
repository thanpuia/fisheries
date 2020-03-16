<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fishpond;


class FishpondController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'district' => '',
            'image' => '',
            'pondImages'=>''
        ]);
        //for single images
        if ($files = $request->file('image')) {
            $destinationPath = 'public/image/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
           // $insert['image'] = "$profileImage";
         }

        //DB UPLOAD FOR SINGLE PICTURE i.e Profile picture 
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





    public function uploadpond(Request $request, $id)
    {

        error_log("called from android");
        $fishpond = auth()->user()->fishponds()->find($id);
        
        //$updated = $fishpond->fill($request->all())->save();
        $data = [];
        if($request->hasfile('pondImages'))
        {
          
            foreach($request->file('pondImages') as $key=>$files)
            {
                $name=$files->getClientOriginalName();    
                $files->move('public/image2', $name);      
                $data[$key] = $name; 
            }
        }
        
        $pond=implode(",",$data);
        //$updated = $fishpond->fill($request->all())->save();
        $fishpond->pondImages=$pond;
        $fishpond->save();
            return response()->json([
                'data' => $pond,
                'message' => 'success'
            ], 500);
    }
}
