<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/1/2017
 * Time: 8:53 AM
 */

use Base\Supports\FlashMessage;
use Illuminate\Support\Facades\File;

if (!function_exists('is_in_dashboard')) {
    /**
     * @return bool
     */
    function is_in_dashboard()
    {
        $segment = request()->segment(1);
        if ($segment === config('SOURCE_ADMIN_ROUTE', 'admincp')) {
            return true;
        }

        return false;
    }
}

function base_url(){
    return env('APP_URL','http://localhost/');
}

function base_slug(){
    return env('MIX_APP_URL','http://localhost');
}

function website_url(){
    return env('WEBSITE_URL','http://localhost');
}

if (!function_exists('MultiMenu')) {
    function MultiMenu($data, $parent = 0, $str = '---|')
    {
        foreach ($data as $val) {
            $id = $val['id'];
            $name = $val['name'];
            if ($val['parent'] == $parent) {
                echo '<option value="' . $id . '">' . $str . ' ' . $name . '</option>';
                MultiMenu($data, $id, $str . '---|');
            }
        }
    }
}


if (!function_exists('MultiCate')) {
    function MultiCate($data, $parent = 0, $str = '')
    {
        foreach ($data as $val) {
            $id = $val['id'];
            $slug = $val['slug'];
            $name = $val['name'];
            if ($val['parent'] == $parent) {
                echo '<option value="' . $slug . '">' . $str . ' ' . $name . '</option>';
                MultiCate($data, $id, $str . '---|');
            }
        }
    }
}

function optionCategory($data, $id=0, $selected,$str='---'){
    foreach($data as $row){
        if($row->parent==$id) {
            echo "<option value='" . $row->id . "'";
            if ($selected == $row->id) {
                echo " selected=''";
            }
            echo ">".$str .$row->name . "</option>";
            optionCategory($data, $row->id, $selected,$str.'---|');
        }

    }
}

if (!function_exists('convert_status')) {
    function conver_status($status, $url = '#')
    {
        switch ($status) {
            case 'active' :
                return '<a class="status success" href="'.$url.'" title="Click để thay đổi trạng thái">Kích hoạt</a>';
                break;
            case 'disable' :
                return '<a class="status danger" href="'.$url.'" title="Click để thay đổi trạng thái">Tạm khóa</a>';
                break;
            default:
                return '<a class="status danger" href="'.$url.'" title="Click để thay đổi trạng thái">Tạm khóa</a>';
                break;
        }
    }
}

if (!function_exists('comment_status')) {
    function comment_status($status, $url = '#')
    {
        switch ($status) {
            case 'accept' :
                return '<a class="status success" href="'.$url.'" title="Click để thay đổi trạng thái">Chấp nhận</a>';
                break;
            case 'cancel' :
                return '<a class="status danger" href="'.$url.'" title="Click để thay đổi trạng thái">Tạm khóa</a>';
                break;
            default:
                return '<a class="status danger" href="'.$url.'" title="Click để thay đổi trạng thái">Tạm khóa</a>';
                break;
        }
    }
}

if(!function_exists('getStatusPost')){
    function getStatusPost($status, $url = '#'){
        switch ($status){
            case 'publish':
                return '<a class="status success" title="Click để thay đổi trạng thái" href="'.$url.'">Đã duyệt</a>';
                break;
            case 'draft' :
                return '<a class="status danger" title="Click để thay đổi trạng thái" href="'.$url.'" >Lưu nháp</a>';
                break;
            case 'inherit' :
                return '<a class="status danger" title="Click để thay đổi trạng thái" href="'.$url.'" >Nổi bật</a>';
                break;
            default:
                return '<a class="status danger" title="Click để thay đổi trạng thái" href="'.$url.'">Chưa duyệt</a>';
                break;
        }
    }
}

if (!function_exists('convert_flash_message')) {
    function convert_flash_message($mess = 'create')
    {
        switch ($mess) {
            case 'create':
                $m = config('messages.success_create');
                break;
            case 'edit':
                $m = config('messages.success_edit');
                break;
            case 'delete':
                $m = config('messages.success_delete');
                break;
            default:
                $m = config('messages.success_create');
        }

        return $m;
    }
}

if (!function_exists('changeStatus')) {
    function changeStatus($id, $repository)
    {
        try {
            $record = $repository->find($id);
            $status = ($record->status == 'active') ? 'disable' : 'active';
            $repository->update([
                'status' => $status
            ], $id);

            return redirect()->back()->with(FlashMessage::returnMessage('edit'));
        } catch (\Exception $e) {
            Debugbar::addThrowable($e);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

if (!function_exists('setFeatured')) {
    function setFeatured($id, $repository)
    {
        try {
            $record = $repository->find($id);
            $status = ($record->featured == 'active') ? 'disable' : 'active';
            $repository->update([
                'featured' => $status
            ], $id);

            return redirect()->back()->with(FlashMessage::returnMessage('edit'));
        } catch (\Exception $e) {
            Debugbar::addThrowable($e);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

if (!function_exists('getDelete')) {
    function getDelete($id, $repository)
    {
        try {
            $repository->delete($id);
            return redirect()->back()->with(FlashMessage::returnMessage('delete'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

if (!function_exists('getDeleteAll')) {
    function getDeleteAll($id, $repository)
    {
            $repository->delete($id);
    }
}

function cong($a,$b){
    return $a + $b;
}
function chia($a,$b){
    return $a / $b;
}


if(!function_exists('getParentInfo')){
    function getParentInfo($id, $repository){
        $info = $repository->find($id);
        if(!empty($info)) {
            echo $info->name;
        }else{
            echo 'Is parent';
        }
    }
}
if(!function_exists('getUserInfo')) {
    function getUserInfo($id, $repository)
    {
        $user_info = $repository->find($id);
        if (empty($user_info)) {
            echo 'Not user';
        } else {
            echo $user_info->first_name;
        }
    }
}


if (!function_exists('createThumbnailUrl')) {
    function createThumbnailUrl($thumb)
    {
        $arr = explode('/', $thumb);
        $last = end($arr);
        $folder = str_replace($last, "", $thumb);
        $thumbfolder = $folder.'thumbs/';
        return $thumbfolder.$last;
    }
}

if (!function_exists('get_thumbnail')) {
    function get_thumbnail($thumbnail) {
        if (empty($thumbnail)) {
            return asset('ui/images/no-image.jpg');
        }

        return asset($thumbnail);
    }
}

if (!function_exists('renderPaymentStatus')) {
    function renderPaymentStatus($status)
    {
        switch ($status) {
            case 'pending':
                return 'Pending';
            case 'complete':
                return 'Completed';
            case 'paid':
                return 'Paid';
            case 'cancel':
                return 'Cancel';
            default:
                return $status;
        }
    }
}

if (!function_exists('renderOrderStatus')) {
    function renderOrderStatus($status)
    {
        switch ($status) {
            case 'waiting':
                return 'Waiting';
            case 'onwork':
                return 'On Working';
            case 'complete':
                return 'Completed';
            case 'refund':
                return 'Refund';
            default:
                return $status;
        }
    }
}

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'năm',
        'm' => 'tháng',
        'w' => 'tuần',
        'd' => 'ngày',
        'h' => 'tiếng',
        'i' => 'phút',
        's' => 'giây',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' trước' : 'vừa xong';
}

function datetoformat($date=''){
    return date_format(new DateTime($date),'d/m/Y');
}
function datetolog($date=''){
    return date_format(new DateTime($date),'d-m-Y');
}

function datetoformat_full($date=''){
    return date_format(new DateTime($date),'d/m/Y - h:i:s');
}

function secToHR($seconds, $short = false)
{
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds / 60) % 60);
    $seconds = $seconds % 60;
    if (!$short)
        return "$minutes min, $seconds sec";
    else {
        $hours = $hours < 10 ? '0' . $hours : $hours;
        $minutes = $minutes < 10 ? '0' . $minutes : $minutes;
        $seconds = $seconds < 10 ? '0' . $seconds : $seconds;
        return "$hours:$minutes:$seconds";
    }
}

function humanTiming($time)
{

    $time = time() > $time ? time() - $time : $time - time(); // to get the time since that moment

    $tokens = array(
        31536000 => 'năm',
        2592000 => 'tháng',
        604800 => 'tuần',
        86400 => 'ngày',
        3600 => 'giờ',
        60 => 'phút',
    );

    $result = '';
    $counter = 1;
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        if ($counter > 2) break;

        $numberOfUnits = floor($time / $unit);
        $result .= "$numberOfUnits $text ";
        $time -= $numberOfUnits * $unit;
        ++$counter;
    }

    return "{$result}";
}

if (!function_exists('get_thumbnail')) {
    function get_thumbnail($thumbnail) {
        if (empty($thumbnail)) {
            return asset('ui/images/no-image.jpg');
        }

        return asset($thumbnail);
    }
}

if (!function_exists('createFile')) {
    function createFile()
    {
        $localtion = storage_path('setting');
        $filename = datetolog(now()) . '.txt';
        try {

            if(!File::exists($localtion)){
                File::makeDirectory($localtion, 0775, true, true);
            }
            $filepath = storage_path('setting\\' . $filename);
            $content = '';
            File::prepend($filepath, $content);
        } catch (\Exception $e) {
            return $e ;
        }
    }
}

if(!function_exists('createHistory'))
{
    function createHistory($desc,$method,$module){
        //log file create
        try {
            $datetofile = datetolog(now()) . '.txt';
            $localtion = storage_path('history');

            if(!File::exists($localtion)){
                File::makeDirectory($localtion, 0775, true, true);
            }

            $filepath = storage_path('history\\' . $datetofile);
            $username = Auth::user();
            $contents = '<p>#<b>' . $username->full_name . '</b> đã ' . $method . ' ' . $module . ' <span style="color: #0e90d2">' . $desc . '</span> lúc <b>' . datetoformat_full(now()) . '</b></p>.';
            File::prepend($filepath, $contents);
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

if(!function_exists('sub')){
    function sub($str,$num){
        return mb_substr(strip_tags($str), 0, $num);
    }
}

