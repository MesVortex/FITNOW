<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $progress = Progress::all();
        $data = [
            'status' => 200,
            'progress' => $progress,
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'weight' => 'required',
            'height' => 'required',
            'waist_line' => 'required',
            'bicep_thickness' => 'required',
            'pec_width' => 'required',
            'calve_thickness' => 'required',
        ]);

        $success = Progress::create([
            'weight' => $validatedData['weight'],
            'height' => $validatedData['height'],
            'waist_line' => $validatedData['waist_line'],
            'bicep_thickness' => $validatedData['bicep_thickness'],
            'pec_width' => $validatedData['pec_width'],
            'calve_thickness' => $validatedData['calve_thickness'],
        ]);

        if($success){
            $data = [
                'status'=>200,
                'message'=>'progress added succefully!'
            ];
            return response()->json($data, 200);
        }else{
            return response()->json(['message'=>'unexpected error'], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(progress $progress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(progress $progress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, progress $progress)
    {
        $validatedData = $request->validate([
            'weight' => 'required',
            'height' => 'required',
            'waist_line' => 'required',
            'bicep_thickness' => 'required',
            'pec_width' => 'required',
            'calve_thickness' => 'required',
        ]);

        $success = $progress->update([
            'weight' => $validatedData['weight'],
            'height' => $validatedData['height'],
            'waist_line' => $validatedData['waist_line'],
            'bicep_thickness' => $validatedData['bicep_thickness'],
            'pec_width' => $validatedData['pec_width'],
            'calve_thickness' => $validatedData['calve_thickness'],
        ]);

        if($success){
            $data = [
                'status'=>200,
                'message'=>'progress updated succefully!'
            ];
            return response()->json($data, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(progress $progress)
    {
        $progress->delete();

        $data = [
            'status'=>200,
            'message'=>'progress delted succefully!'
        ];      
        return response()->json($data, 200);
    }

    public function updateStatus(Request $request, progress $progress)
    {
        $validatedData = $request->validate([
            'status' => 'required',
        ]);

        $success = $progress->update([
            'status' => $validatedData['status'],
        ]);

        if($success){
            $data = [
                'status'=>200,
                'message'=>'status changed succefully!'
            ];
            return response()->json($data, 200);
        }
    }

}
