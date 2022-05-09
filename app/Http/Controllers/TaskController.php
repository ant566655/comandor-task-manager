<?php

namespace App\Http\Controllers;

use App\Models\task_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = task_data::all();
        return datatables()->of($data)->addColumn('action', function ($data) {
            $button = '<button id="' . $data->id . '" class="edit btn btn-primary btn-sm">Блокировать</button><br> ';
            $button .= '<button id="' . $data->id . '" class="delete btn btn-danger btn-sm">Разблокировать</button>';
            return $button;
        })->rawColumns(['action'])->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = array(
            'task' => 'required',
            'description' => 'required',
            'price' => 'required',

        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = array(
            'task' => $request->task,
            'description' => $request->description,
            'price' => $request->price,

        );
        task_data::firstOrCreate($form_data);
        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\task_data  $task_data
     * @return \Illuminate\Http\Response
     */
    public function show(task_data $task_data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\task_data  $task_data
     * @return \Illuminate\Http\Response
     */
    public function edit(task_data $task_data)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\task_data  $task_data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, task_data $task_data)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\task_data  $task_data
     * @return \Illuminate\Http\Response
     */
    public function destroy(task_data $task_data)
    {
        //
    }
}
