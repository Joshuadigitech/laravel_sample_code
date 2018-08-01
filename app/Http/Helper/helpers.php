<?php
//Date and Time according to User location Time Zone
function DayandTimeFormat($date)
{
    $q = Carbon\Carbon::parse($date);
    return $q->setTimezone(Session::get('TIMEZONE'))->toDayDateTimeString();
}
// Currency & Amount format Format
function Currency($amount)
{
    $symbol = "$";
    if (empty($amount)) {
        return "-";
    }
    if (is_numeric($amount)) {
        $data = $symbol . '&nbsp;' . number_format($amount);
    } else {
        $data = $symbol . '&nbsp;' . $amount;
    }
    return $data;
}
//Date Format
function DateOnly($date)
{
    return Carbon\Carbon::parse($date)->toFormattedDateString();
}
//Time Format
function timeInterval($date)
{
    return Carbon\Carbon::parse($date)->diffForHumans();
}
function Differnce($date)
{
    $end = Carbon\Carbon::parse($date);
    $now = Carbon\Carbon::now();

    return $length = $end->diffInDays($now);
}
//function for check allocated hours of client manager
function showHours($cmId, $requestId)
{
    $clientRequest = App\ClientRequest::find($requestId);
    $cmDetails = App\Allocation::where('cm_id', $cmId)->get();

    $numofHour = 0;
    foreach ($cmDetails as $key) 
        {
        //return $key->ClientRequest;
        if (isset($key)&&$key->services_id == 2) 
        {
            $numofHour += $key->Request->number_of;
        } 
        elseif (isset($key)&&$key->services_id == 1) 
        {
            $day = $key->Request->WeeklyHours; 
            if (is_numeric($day->Monday)) {
                $numofHour += $day->Monday;
            }
            if (is_numeric($day->Tuesday)) {
                $numofHour += $day->Tuesday;
            }
            if (is_numeric($day->Wednesday)) {
                $numofHour += $day->Wednesday;
            }
            if (is_numeric($day->Thursday)) {
                $numofHour += $day->Thursday;
            }
            if (is_numeric($day->Friday)) {
                $numofHour += $day->Friday;
            }
            if (is_numeric($day->Saturday)) {
                $numofHour += $day->Saturday;
            }

            
        }
    }
    if ($clientRequest->services_type == 2) 
    {
        $Hour=$clientRequest->number_of;
        if ($Hour <= (40 - $numofHour)) {
            
            return true;
        } 
        else 
        {
            return false;
        }

    } 
    elseif ($clientRequest->services_type == 1) 
    {
        $day = $clientRequest->WeeklyHours;
        $Hour = 0;
        if (is_numeric($day->Monday)) {
            $Hour += $day->Monday;
        }
        if (is_numeric($day->Tuesday)) {
            $Hour += $day->Tuesday;
        }
        if (is_numeric($day->Wednesday)) {
            $Hour += $day->Wednesday;
        }
        if (is_numeric($day->Thursday)) {
            $Hour += $day->Thursday;
        }
        if (is_numeric($day->Friday)) {
            $Hour += $day->Friday;
        }
        if (is_numeric($day->Saturday)) {
            $Hour += $day->Saturday;
        }
        if ($Hour <= (40 - $numofHour)) {
            return true;
        } 
        else 
        {
            return false;
        }
    }
    elseif ($clientRequest->services_type == 3)
    {
        return true;
    }

}
