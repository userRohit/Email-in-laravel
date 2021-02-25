<?php
namespace App\Http\Controllers;
use App\task;
use Illuminate\Http\Request;
use DB;
/*use App\task2;*/
use Illuminate\Support\Facades\Mail;
use App\Mail\sendmail;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        $passcode = mt_rand(10000, 99999);
        if (task::where('email', '=', $request->get('email'))
            ->exists())
        {
            task::where('email', $request->email)
                ->update(['passcode' => $passcode]);
            Mail::send('demomail', array(
                'passcode' => $passcode,
            ) , function ($messages) use ($request)
            {
                $messages->to($request->email);
                $messages->from('amanofc@gmail.com', 'Admin')
                    ->subject('New Passcode');
            });
            return redirect()
                ->route('new')
                ->with('info', 'email update  sucessfully');
        }
        elseif (task::where('passcode', '=', $request->get('email'))
            ->exists())
        {
            return redirect()
                ->route('new')
                ->with('info', 'passcode added sucessfully');
        }
        elseif (task::where('email', '!=', $request->get('email'))
            ->exists())
        {
            $this->validate($request, ['email' => 'required|email']);
            $passcode = mt_rand(10000, 99999);
            $crud = new task;
            $crud->email = $request->email;
            $crud->passcode = $passcode;
            $crud->save();
            Mail::send('demomail', array(
                'passcode' => $passcode,
            ) , function ($messages) use ($request)
            {
                $messages->to($request->email);
                $messages->from('amanofc@gmail.com', 'Admin')
                    ->subject('New Passcode');
            });
            //dd("Email is Sent.");
            return redirect()
                ->route('new')
                ->with('info', 'email insert');
        }
        else
        {
            return redirect()
                ->route('new')
                ->with('info', 'Passcode not  added sucessfully');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = task::find($id);
        return view('update')->with(compact('data'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(task $task)
    {
        //
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //print_r($request->input());
        task::where('id', $request->id)
            ->update(['passcode' => $request->Passcode]);
        return redirect()
            ->route('come')
            ->with('Success', 'data added sucessfully');
        /*
        $data=task::find($request->id);
        $data->email=$request->email;
        $data->passcode=$request->Passcode;
        $data->save(); */
        /* return redirect()->route('come')->with('Success','data added sucessfully');*/
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(task $task)
    {
        //
        
    }
}

