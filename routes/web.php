<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Display All Tasks
 */
Route::get('/', function () {
    {
        $tz = 'Europe/London';
        $timestamp = time();
        $dt = new \DateTime("now", new \DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        echo "$tz time: " . $dt->format('m-d-Y, H:i:s');
        //----------------------------------------------------------------
        $tz2 = 'Asia/Tokyo';
        $dt2 = new \DateTime("now", new \DateTimeZone($tz2));
        $dt2->setTimestamp($timestamp);
        echo "<br>$tz2 time:______" . $dt2->format('m-d-Y, H:i:s');
        //----------------------------------------------------------------
        date_default_timezone_set("UTC");
        echo "<br>UTC now: " . now();
        echo "<br>UTC time: " . time();
        //----------------------------------------------------------------
        echo "<br>UTC carbon now: " . Carbon::now();
    }
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});

/**
 * Add A New Task
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});

/**
 * Delete An Existing Task
 */
Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();
    return redirect('/');
});

Route::get('/t', function (Request $request) {
    echo json_encode(array('secret' => 'keytest'));
    //return json_encode(array('secret' => 'keytest'));
    //return response()->json(['errors' => 'test err', 402]);
});
