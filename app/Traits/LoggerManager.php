<?php
namespace App\Traits;

date_default_timezone_set('Asia/Dubai');

use App\Classes\LogsModules;
use App\Models\LoggerActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

trait LoggerManager
{
    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            // ... code here
        });

        self::created(function($model){
           $model->store_log(get_class($model),'create',$model->id,'Created',false);
        });

        self::updating(function($model){
            $oldRecord=DB::table($model->table)->where('id',$model->id)->get();
            $updatedFields = $model->compare_updated_fields($model->toArray(), (array)$oldRecord[0]);
            $model->store_log(get_class($model), "Update", $model->id, $updatedFields, true);
        });

        self::updated(function($model){
            // ... code here
        });

        self::deleting(function($model){
            // ... code here
        });

        self::deleted(function($model){
            $model->store_log(get_class($model),'delete',$model->id,'Deleted',false);
        });
    }

    public function loggerActivities(){
        return $this->morphMany(LoggerActivity::class,'reference');
    }

    public function store_log($instance_type, $instance_method, $reference_id, $log, $update = false, $edition_id = null, $event_id = null, $source_type = "internal")
    {
        $status = true;

        if ($update) {
            if (is_bool($update)) {
                // Export fields
                $log = ["export_fields" => $log];
            } else {
                $log = (is_array($log)) ? $log : $log->toArray();
                $update = (is_array($update)) ? $update : $update->toArray();
                $log = $this->compare_updated_fields($log, $update);
            }
            if (count($log) > 0) {
                $status = true;
            } else {
                $status = false;
            }
        } else {
            if (is_array($reference_id)) {
                // Bulk update
                $reference_id = "," . implode(",", $reference_id) . ",";

                $log = ["bulk_update" => $log];
            } else {
                // Simple Log
                $log = ["log_message" => $log];
            }
            $status = true;
        }

        if ($source_type == "internal") {
            $created_by = Auth::id();
        } else {
            $created_by = $reference_id;
        }

        // $reference_type = LogsModules::get_reference_type($instance_type);
        $reference_type = $instance_type;

        if ($status) {
            try {
                LoggerActivity::create([
                    "instance_type" => $instance_type,
                    "instance_method" => $instance_method,
                    "reference_type" => $reference_type,
                    "reference_id" => $reference_id,
                    "log" => json_encode($log),
                    "created_by" => $created_by ?? 1111,
                    "source_type" =>$source_type,// config("logger_manager.source_types." . $source_type),
                    // "edition_id" => $edition_id,
                    // "event_id" => $event_id,
                    "created_at" => date("Y-m-d H:i:s"),
                    "mocked_by" =>null// (filled(session('mocked_by'))) ? session('mocked_by') : null
                ]);

            } catch (\Exception $e) {
                Log::error('Exception in loggin', [$e]);
            }

        }
    }

    private function check_existance($instance_type, $instance_method, $reference_id)
    {
        $count = LoggerActivity::where("instance_type", $instance_type)
            ->where("instance_method", $instance_method)
            ->where("reference_id", $reference_id)
            ->count();
        if ($count > 0) {
            // return false;
        }
        return true;
    }

    public function compare_updated_fields(array $new_data, array $old_data)
    {
        $unneeded_fields = ["created_at", "updated_at", "created_by", "updated_by"];
        $updated_fields = [];
        foreach ($old_data as $key => $old_value) {
            if(isset($new_data[$key])){
                if ($old_value != $new_data[$key] && !in_array($key, $unneeded_fields)) {
                    $updated_fields[$key]['old'] = $old_value;
                    $updated_fields[$key]['new'] = $new_data[$key];
                }
            }
        }
        return $updated_fields;
    }

    public function get_status_title($value)
    {
        if ($value == 1) {
            return "Active";
        }
        return "Inactive";
    }
}
