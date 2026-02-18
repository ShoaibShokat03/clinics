<?php

namespace App\Http\Controllers;

use App\Models\UserLogs;
use App\Traits\Loggable;
use App\Models\DoctorSchedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exports\GenericExport;
use App\Models\DoctorDetail;
use Maatwebsite\Excel\Facades\Excel;

class DoctorScheduleController extends Controller
{
    use loggable;
    /**
     * Constructor
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:doctor-schedule-read|doctor-schedule-create|doctor-schedule-update|doctor-schedule-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:doctor-schedule-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:doctor-schedule-update', ['only' => ['edit', 'update', 'bulkEdit', 'bulkUpdate']]);
        $this->middleware('permission:doctor-schedule-delete', ['only' => ['destroy', 'bulkDelete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->export) {
            return $this->doExport($request);
        }

        // Build the base query
        $doctorSchedulesQuery = DoctorSchedule::with(['user']);

        if (auth()->user()->hasRole('Doctor')) {
            $doctorSchedulesQuery->where('user_id', auth()->id());
        }

        // Filter by user_id if it's provided
        if ($request->has('userid')) {
            $doctorSchedulesQuery->where('user_id', $request->userid);
        }

        $doctorSchedules = $this->filter($request, $doctorSchedulesQuery)
            ->orderBy('created_at', 'desc')
            ->paginate(300);

        $doctors = DoctorDetail::all();

        return view('doctor-schedule.index', compact('doctorSchedules', 'doctors'));
    }

    public function doExport(Request $request)
    {
        $doctorSchedulesQuery = $this->buildDoctorSchedulesQuery($request);
        $doctorSchedules = $this->filter($request, $doctorSchedulesQuery)->get();

        $data = $doctorSchedules->map(function ($schedule) {
            return [
                'ID' => $schedule->id,
                'Doctor Name' => $schedule->user->name ?? 'N/A',
                'Weekday' => $schedule->weekday,
                'Start Time' => $schedule->start_time,
                'End Time' => $schedule->end_time,
                'Avg Appointment Duration' => $schedule->avg_appointment_duration,
                'Serial Type' => $schedule->serial_type,
                'Status' => $schedule->status,
                'Created At' => $schedule->created_at,
                'Updated At' => $schedule->updated_at,
            ];
        })->toArray();

        $headers = [
            'ID',
            'Doctor Name',
            'Weekday',
            'Start Time',
            'End Time',
            'Avg Appointment Duration',
            'Serial Type',
            'Status',
            'Created At',
            'Updated At'
        ];

        return Excel::download(new GenericExport($data, $headers), 'DoctorSchedules.xlsx');
    }

    private function buildDoctorSchedulesQuery(Request $request)
    {
        $roleName = Auth::user()->getRoleNames();
        $doctorSchedulesQuery = DoctorSchedule::with(['user']);

        if ($roleName[0] == 'Doctor') {
            $id = Auth::user()->id;
            $doctorSchedulesQuery->where('user_id', $id);
        }

        return $doctorSchedulesQuery;
    }

    private function filter(Request $request, $query)
    {
        // if ($request->name) {
        //     $query->whereHas('user', function ($q) use ($request) {
        //         $q->where('name', 'like', $request->name . '%');
        //     });
        // }

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->weekday) {
            $query->where('weekday', $request->weekday);
        }

        return $query;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFromDoctorDetails($userid)
    {
        $doctors = User::role('Doctor')->where('status', '1')->orderBy('created_at', 'desc')->get(['id', 'name']);
        $selectedDoctorId = $userid;
        return view('doctor-schedule.create', compact('doctors', 'selectedDoctorId'));
    }

    public function create()
    {
        $doctors = User::role('Doctor')->where('status', '1')->orderBy('created_at', 'desc')->get(['id', 'name']);

        return view('doctor-schedule.create', compact('doctors'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $weekdays = $request->weekday === 'Whole Week'
            ? array_slice(config('constant.weekdays'), 0, 7)
            : [$request->weekday];

        $doctorSchedule = null;
        foreach ($weekdays as $day) {
            $doctorSchedule = DoctorSchedule::updateOrCreate(
                [
                    'user_id' => $request->user_id,
                    'weekday' => $day,
                ],
                [
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'avg_appointment_duration' => $request->avg_appointment_duration,
                    'serial_type' => $request->serial_type,
                    'status' => '1',
                    'created_by' => auth()->id()
                ]
            );
        }

        return redirect()->route('doctor-schedules.index')->with('success', trans('Doctor Schedule Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DoctorSchedule  $doctorSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(DoctorSchedule $doctorSchedule)
    {
        return view('doctor-schedule.show', compact('doctorSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DoctorSchedule  $doctorSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorSchedule $doctorSchedule)
    {
        $doctors = User::role('Doctor')->where('status', '1')->orderBy('created_at', 'desc')->get(['id', 'name']);
        $logs = '';
        return view('doctor-schedule.edit', compact('doctors', 'doctorSchedule', 'logs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DoctorSchedule  $doctorSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorSchedule $doctorSchedule)
    {
        if ($request->weekday === 'Whole Week') {
            return redirect()->back()->withErrors(['weekday' => 'Cannot update a single schedule to "Whole Week". Please use Create for bulk assignments.'])->withInput();
        }

        $this->validation($request, $doctorSchedule->id);

        $data = $request->only(['user_id', 'weekday', 'status', 'start_time', 'end_time', 'avg_appointment_duration', 'serial_type']);
        $data['updated_by'] = auth()->id();
        $doctorSchedule->update($data);

        return redirect()->route('doctor-schedules.index')->with('success', trans('Doctor Schedule Updated Successfully'));
    }

    public function bulkEdit($userid)
    {
        $this->ensureSchemaConsistency();

        $doctor = User::findOrFail($userid);
        $schedules = DoctorSchedule::where('user_id', $userid)->get()->keyBy('weekday');
        $weekdays = array_slice(config('constant.weekdays'), 0, 7);

        return view('doctor-schedule.bulk-edit', compact('doctor', 'schedules', 'weekdays'));
    }

    public function bulkUpdate(Request $request)
    {
        $this->ensureSchemaConsistency();

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'schedules' => 'required|array',
        ]);

        $userId = $request->user_id;

        foreach ($request->schedules as $weekday => $data) {
            if (isset($data['enabled']) && $data['enabled'] == '1') {
                DoctorSchedule::updateOrCreate(
                    ['user_id' => $userId, 'weekday' => $weekday],
                    [
                        'start_time' => $data['start_time'],
                        'end_time' => $data['end_time'],
                        'avg_appointment_duration' => $data['avg_appointment_duration'] ?? 15,
                        'serial_type' => $data['serial_type'] ?? 'Sequential',
                        'status' => '1',
                        'updated_by' => auth()->id(),
                        'created_by' => auth()->id()
                    ]
                );
            } else {
                DoctorSchedule::where('user_id', $userId)->where('weekday', $weekday)->delete();
            }
        }

        return redirect()->route('doctor-details.index')->with('success', 'Doctor Schedules updated successfully');
    }

    /**
     * Ensures that the doctor_schedules table has all required functional columns.
     * This handles automatic schema updates across multitenant databases.
     */
    private function ensureSchemaConsistency()
    {
        $columns = [
            'start_time' => "ALTER TABLE `doctor_schedules` ADD COLUMN IF NOT EXISTS `start_time` TIME NULL AFTER `weekday`",
            'end_time' => "ALTER TABLE `doctor_schedules` ADD COLUMN IF NOT EXISTS `end_time` TIME NULL AFTER `start_time`",
            'avg_appointment_duration' => "ALTER TABLE `doctor_schedules` ADD COLUMN IF NOT EXISTS `avg_appointment_duration` INT NULL DEFAULT 15 AFTER `end_time`",
            'serial_type' => "ALTER TABLE `doctor_schedules` ADD COLUMN IF NOT EXISTS `serial_type` ENUM('Social', 'Sequential') DEFAULT 'Sequential' AFTER `avg_appointment_duration`",
            'updated_by' => "ALTER TABLE `doctor_schedules` ADD COLUMN IF NOT EXISTS `updated_by` INT NULL AFTER `status`",
        ];

        foreach ($columns as $column => $sql) {
            if (!\Illuminate\Support\Facades\Schema::hasColumn('doctor_schedules', $column)) {
                try {
                    \Illuminate\Support\Facades\DB::statement($sql);
                } catch (\Exception $e) {
                    // Log error but continue to avoid breaking the application
                    \Illuminate\Support\Facades\Log::error("Failed to add column $column to doctor_schedules: " . $e->getMessage());
                }
            }
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (!empty($ids)) {
            DoctorSchedule::whereIn('id', $ids)->delete();
            return response()->json(['status' => 'success', 'message' => 'Selected schedules deleted successfully.']);
        }
        return response()->json(['status' => 'error', 'message' => 'Please select at least one schedule to delete.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DoctorSchedule  $doctorSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $doctorSchedule = DoctorSchedule::findOrFail($id);
        $doctorSchedule->delete();

        return redirect()->route('doctor-schedules.index')->with('success', 'Doctor schedule deleted successfully');
    }

    /**
     * Validation function
     *
     * @param Request $request
     * @return void
     */
    private function validation(Request $request, $id = 0)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'weekday' => ['required', 'in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Whole Week'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'avg_appointment_duration' => ['required', 'integer'],
            'serial_type' => ['required', 'in:Social,Sequential'],
        ]);

        $this->scheduleOverlapCheck($request, $id);
    }

    /**
     * Schedule overlap validation check
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    private function scheduleOverlapCheck(Request $request, $id = 0)
    {
        $weekdays = $request->weekday === 'Whole Week'
            ? array_slice(config('constant.weekdays'), 0, 7)
            : [$request->weekday];

        foreach ($weekdays as $day) {
            $overlap = DoctorSchedule::where('user_id', $request->user_id)
                ->where('weekday', $day);

            if ($id) {
                $overlap->where('id', '<>', $id);
            }

            if ($overlap->exists()) {
                // Throwing a proper validation error instead of the 'image' hack
                $message = $request->weekday === 'Whole Week'
                    ? "One or more days in the week already have a schedule for this doctor."
                    : "A schedule for {$day} already exists for this doctor.";

                throw \Illuminate\Validation\ValidationException::withMessages([
                    'weekday' => [$message]
                ]);
            }
        }
    }
}
