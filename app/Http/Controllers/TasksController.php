<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Symfony\Component\Console\Input\Input;
use Livewire\Component;

use function GuzzleHttp\Promise\task;

class TasksController extends Component
{
    public function updateTaskOrder($items) {

        foreach ($items as $item) {
            Task::find($item['value'])->update(['priority' => $item['order']]);
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function render()
    {
        $mode_is_edit = false;
        // get all the tasks
        $tasks = Task::orderBy('priority')->get();

        return view('tasks.index', ['tasks' => $tasks, 'mode_is_edit' => $mode_is_edit]);

        // load the view and pass the sharks
        return View::make('tasks.index')
            ->with('mode_is_edit', $mode_is_edit)
            ->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // validate
        $rules = array(
            'name'       => 'required|max:255',
            'priority'      => 'required|numeric',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('tasks')
                ->withErrors($validator);
        } else {
            // store
            $task = new Task();
            $task->name       = $request->get('name');
            $task->priority      = $request->get('priority');
            $task->save();

            // redirect
            Session::flash('message', 'Successfully created task!');

            return Redirect::to('tasks');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $mode_is_edit = true; //TODO I have a small chanllenge with put method!

        $task = Task::find($id);

        $tasks = Task::orderBy('priority')->get();

        return View::make('tasks.index')
            ->with('mode_is_edit', $mode_is_edit)
            ->with('task', $task)
            ->with('tasks', $tasks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // validate
        $rules = array(
            'name'       => 'required|max:255',
            'priority'      => 'required|numeric',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('tasks')
                ->withErrors($validator);
        } else {
            // store
            $task = Task::find($id);
            $task->name       = $request->get('name');
            $task->priority      = $request->get('priority');
            $task->save();

            Session::flash('message', 'Successfully updated task!');

            return Redirect::to('tasks');
        }
    }

    /**
     * Remove the specified resource from db.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        Session::flash('message', 'Successfully deleted the task!');
        return Redirect::to('tasks');
    }
}
