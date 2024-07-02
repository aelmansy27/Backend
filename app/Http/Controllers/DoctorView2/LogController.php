<?php

namespace App\Http\Controllers\DoctorView2;

use App\Http\Controllers\Controller;
use App\Models\ActivityLogArchive;
use App\Models\Cow;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Spatie\Activitylog\ActivityLogger;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index(){

        $dailyActivities = Activity::all()
            ->groupBy(function ($activity) {
                return $activity->created_at->format('Y-m-d'); // Group by date
            })
            ->map(function ($activitiesByDate) {
                return [
                    'date' => $activitiesByDate->first()->created_at->format('Y-m-d'), // Extract date
                    'activities' => $activitiesByDate // Activities for that date
                ];
            })
            ->values(); // Remove empty keys (optional)

        return response()->json($dailyActivities, 200);

    }

    public function archiveLog(){
        $dailyActivities = ActivityLogArchive::all()
            ->groupBy(function ($activity) {
                return $activity->created_at->format('Y-m-d'); // Group by date
            })
            ->map(function ($activitiesByDate) {
                return [
                    'date' => $activitiesByDate->first()->created_at->format('Y-m-d'), // Extract date
                    'activities' => $activitiesByDate // Activities for that date
                ];
            })
            ->values(); // Remove empty keys (optional)

        return response()->json($dailyActivities, 200);
    }


    public function logCow($id)
    {
        try {
            $cow = Cow::findOrFail($id);

            $activities = Activity::query()->where('subject_type', 'App\Models\Cow')
                ->where('subject_id', $cow->id)
                ->get();

            $dailyActivities = $activities
                ->groupBy(function ($activity) {
                    return $activity->created_at->format('Y-m-d'); // Group by date
                })
                ->map(function ($activitiesByDate, $date) {
                    return [
                        'date' => $date, // Extract date from any activity
                        'activities' => $activitiesByDate->isEmpty() ? [] : $activitiesByDate,
                    ];
                })
                ->values();

            if ($dailyActivities->isEmpty()) {
                return response()->json(['message' => 'No activities found'], 200);
            }

            return response()->json($dailyActivities, 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'There are not any logs for this cow'], 404);
        }
    }



}
