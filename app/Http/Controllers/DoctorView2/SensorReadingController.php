<?php

namespace App\Http\Controllers\DoctorView2;

use App\Http\Controllers\Controller;
use App\Models\Cow;
use App\Models\CowSensor;
use App\Models\Sensor;

use App\Notifications\CowStatusChangedNotification;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SensorReadingController extends Controller
{
    public function index(){
        $sensor=Sensor::all();
        return response()->json($sensor);
    }

  /*  public function readingSensor()
    {
        $fakeData = File::get(base_path('app/storage/sensor_data.json'));
        $sensorData = json_decode($fakeData, true);
        $changedCows = [];

        foreach ($sensorData as $data) {
            /*$existingSensorReading = CowSensor::where('cow_id', $data['cow_id'])
                ->where('sensor_id', $data['sensor_id'])
                ->where('values', $data['value'])
                ->exists();

            if (!$existingSensorReading) {
                // Save sensor reading to the database
                $cowSensor = CowSensor::create([
                    'cow_id' => $data['cow_id'],
                    'sensor_id' => $data['sensor_id'],
                    'values' => $data['value'],
                ]);
            }

            // Update cow status based on sensor reading
            $cow = Cow::findOrFail($data['cow_id']);
            dd($cow);
            if ($cow) {
                $previousStatus = $cow->cow_status;
                if ((($data['type'] == 'temperature' && $data['value'] > 38.5) &&
                        ($data['type'] == 'heart rate' && ($data['value'] > 80 || $data['value'] < 70))) ||
                    (($data['type'] == 'temperature' && $data['value'] > 38.5) &&
                        ($data['type'] == 'movement rate' && ($data['value'] > 25 || $data['value'] < 15)))) {
                    $cow->cow_status = 0; // Assuming status 0 means abnormal
                } else {
                    $cow->cow_status = 1; // Assuming status 1 means normal
                }
            } else {
                continue;
            }


            // Save the cow status if it has changed

            if ($cow->cow_status != $previousStatus) {
                $cow->update();
                $changedCows[] = $cow;

                // Send notification to currently authenticated doctor
                $doctor = Auth::user(); // Assuming the currently authenticated user is a doctor
                $doctor->notify(new CowStatusChangedNotification($cow));
            }

            /* // Send notifications to doctors for changed cow status
             foreach ($changedCows as $changedCow) {
                 // Assuming you have a relationship between Doctor and Cow
                 $doctors = $changedCow->auth()->user->get(); // Adjust this according to your actual relationship
                 foreach ($doctors as $doctor) {
                     $doctor->notify(new CowStatusChangedNotification($changedCow));
                 }
             }

            // Return the list of cows whose status has changed
            return response()->json(['changed_cows' => $changedCows]);
        }
    }
*/


    public function readingSensor()
    {
        $fakeData = File::get(base_path('app/storage/sensor_data.json'));

        $sensorData = json_decode($fakeData, true);

        $changedCows = [];

        foreach ($sensorData as $cowData) {

            $cowIdToStatusMap = [];
            $cow = Cow::find($cowData['cow_id']);

            //$cowId = $cowData['cow_id']; // Get the cow ID

            $currentStatus = $cow->cow_status; // Save current status
            //dd($currentStatus); //0
            if ($cow) {
                // foreach ($cowData as $data) {
                $jsonData = json_encode($cowData['sensor_readings']);
                //dd($jsonData);
                $predictedStatus = Http::withBody($jsonData)->post("http://127.0.0.1:5000/predict");
                //dd($predictedStatus);
                if ($predictedStatus !== $currentStatus) {
                    $cow->cow_status = boolval($predictedStatus);
                    $cow->save(); // Save the updated cow status

                    if ($cow->cow_status != $currentStatus && !in_array($cow, $changedCows, true)) {
                        $changedCows[] = $cow;

                        /* CowSensor::create([
                             'cow_id' => $cow->id,
                             'sensor_id' => $data['sensor_id'],
                             'values' => $data['value']
                         ]);*/
                    }
                }

                //     }

            }
        }
            if (!empty($changedCows)) {
                Auth::user()->notify(new CowStatusChangedNotification($changedCows));
            }
            return response()->json(['changed_cows' => $changedCows]);
    }

}
