<?php

namespace App\Http\Controllers;

use App\Models\SmtpConfiguration;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ApplicationSetting;
use Redirect, Response, Config;
use Datatables;
use Artisan;
use Illuminate\Support\Str;

/**
 * Class ApplicationSettingController
 *
 * @package App\Http\Controllers
 * @category Controller
 */
class ApplicationSettingController extends Controller
{
    /**
     * Method to load view
     *
     * @access public
     * @return mixed
     */

    function __construct()
    {
        $this->middleware('permission:apsetting-read|apsetting-create|apsetting-update|apsetting-delete', ['only' => ['index', 'show', 'getAppointmentDoctorWise']]);
        $this->middleware('permission:apsetting-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:apsetting-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:apsetting-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $timezone = $this->timeZones();
        $data = ApplicationSetting::find(1);
        return view('admin.application_setting', compact('data', 'timezone'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @access public
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        if (Str::length($request->address) == 11) {
            $request->address = NULL;
        }

        $this->validate($request, [
            'item_name' => 'required',
            'item_short_name' => 'required',
            'company_name' => 'required',
            'time_zone' => 'required',
            'language' => 'required',
            'address' => 'required|min:12',
            'company_email' => 'required|email',
            'logo' => 'image|mimes:png,jpg,jpeg,webp|max:2048',
            'favicon' => 'image|mimes:png,jpg,jpeg,webp,ico|max:2048'
        ]);

        // Use unified upload path: public/uploads/{project}/assets/
        $uploadPath = getUploadPublicPath('assets');
        $relativePath = getUploadPath('assets');

        // Handle logo upload
        $logo = $relativePath . '/logo.png';
        if ($request->hasFile('logo')) {
            $logo_text = $request->logo;
            $extension = $logo_text->getClientOriginalExtension();
            $logo_text_new_name = 'logo.' . $extension;
            $logo_text->move($uploadPath, $logo_text_new_name);
            $logo = $relativePath . '/' . $logo_text_new_name;
        }

        // Handle favicon upload
        $favicon = $relativePath . '/favicon.png';
        if ($request->hasFile('favicon')) {
            $favicon_file = $request->favicon;
            $extension = $favicon_file->getClientOriginalExtension();
            $favicon_new_name = 'favicon.' . $extension;
            $favicon_file->move($uploadPath, $favicon_new_name);
            $favicon = $relativePath . '/' . $favicon_new_name;
        }

        $data = ApplicationSetting::updateOrCreate(['id' => "1"], [
            'item_name' => $request->item_name,
            'item_short_name' => $request->item_short_name,
            'contact' => $request->contact,
            'company_name' => $request->company_name,
            'company_address' => $request->address,
            'company_email' => $request->company_email,
            'language' => $request->language,
            'time_zone' => $request->time_zone,
            'favicon' => $favicon,
            'logo' => $logo,
        ]);

        $currentLang = env('LOCALE_LANG', 'en');
        $defaultLang = $request->language;

        if ($currentLang != $defaultLang) {
            if (!$this->locale($defaultLang)) {
                $message = "Database Connection Error !!!";
            }
        }
        return redirect()->route('apsetting')->withSuccess(trans('Application Settings Has Updated'));
    }

    /**
     * Method to call updateEnvFile
     *
     * @param $smtpHost
     * @param $smtpPort
     * @param $smtpUser
     * @param $smtpPassword
     * @param $smtpType
     */
    public function env($smtpHost, $smtpPort, $smtpUser, $smtpPassword, $smtpType)
    {
        $this->updateEnvfile([
            'MAIL_HOST' => $smtpHost,
            'MAIL_PORT'   => $smtpPort,
            'MAIL_USERNAME'   => $smtpUser,
            'MAIL_PASSWORD'   => $smtpPassword,
            'MAIL_ENCRYPTION'   => $smtpType,
        ]);
    }

    /**
     * Method to update env file
     *
     * @param $data
     *
     * @return bool
     */
    public function updateEnvfile($data)
    {
        if (empty($data) || !is_array($data) || !is_file(base_path('.env'))) {
            return false;
        }
        $env = file_get_contents(base_path('.env'));
        $env = explode("\n", $env);
        foreach ($data as $dataKey => $dataValue) {
            $updated = false;
            foreach ($env as $envKey => $envValue) {
                $entry = explode('=', $envValue, 2);
                if ($entry[0] == $dataKey) {
                    $env[$envKey] = $dataKey . '=' . $dataValue;
                    $updated = true;
                } else {
                    $env[$envKey] = $envValue;
                }
            }
            if (!$updated) {
                $env[] = $dataKey . '=' . $dataValue;
            }
        }
        $env = implode("\n", $env);
        file_put_contents(base_path('.env'), $env);
        Artisan::call('config:clear');
        return true;
    }

    /**
     * Method to call localeUpdateEnvfile
     *
     * @param $defaultLang
     */
    public function locale($defaultLang)
    {
        $this->localeUpdateEnvfile([
            'LOCALE_LANG' => $defaultLang,
        ]);
    }

    /**
     * Method to update env file
     *
     * @param $data
     *
     * @return bool
     */
    public function localeUpdateEnvfile($data)
    {
        if (empty($data) || !is_array($data) || !is_file(base_path('.env'))) {
            return false;
        }
        $env = file_get_contents(base_path('.env'));
        $env = explode("\n", $env);
        foreach ($data as $dataKey => $dataValue) {
            $updated = false;
            foreach ($env as $envKey => $envValue) {
                $entry = explode('=', $envValue, 2);
                if ($entry[0] == $dataKey) {
                    $env[$envKey] = $dataKey . '=' . $dataValue;
                    $updated = true;
                } else {
                    $env[$envKey] = $envValue;
                }
            }
            if (!$updated) {
                $env[] = $dataKey . '=' . $dataValue;
            }
        }
        $env = implode("\n", $env);
        file_put_contents(base_path('.env'), $env);
        Artisan::call('config:clear');
        return true;
    }
}
