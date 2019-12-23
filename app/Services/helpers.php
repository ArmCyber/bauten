<?php
use Illuminate\Support\Str;

//region Assets
if (!function_exists('aApp')) {
    function aApp($asset, $add_version = false)
    {
        $path = 'a/app/' . $asset;
        if (!empty($add_version)) $path .= '?v=' . config('app.version');
        return asset($path);
    }
}
if (!function_exists('aAdmin')) {
    function aAdmin($asset, $add_version = false)
    {
        $path = 'a/admin/' . $asset;
        if (!empty($add_version)) $path .= '?v=' . config('app.version');
        return asset($path);
    }
}
if (!function_exists('aSite')) {
    function aSite($asset, $add_version = false)
    {
        $path = 'a/site/' . $asset;
        if (!empty($add_version)) $path .= '?v=' . config('app.version');
        return asset($path);
    }
}
if (!function_exists('aVendor')) {
    function aVendor($asset, $add_version = false)
    {
        $path = 'a/vendor/' . $asset;
        if (!empty($add_version)) $path .= '?v=' . config('app.version');
        return asset($path);
    }
}
//endregion
//region Variables
if (!function_exists('arraySize')) {
    function arraySize(&$var)
    {
        return (empty($var) || !is_array($var)) ? 0 : count($var);
    }
}
if (!function_exists('exists')) {
    function exists($prefix, &$var, $suffix)
    {
        return !empty($var) ? $prefix . $var . $suffix : null;
    }
}
if (!function_exists('is_id')) {
    function is_id($val){
        return preg_match('/^[1-9][0-9]{0,9}$/', $val);
    }
}
//endregion
//region HTML
if (!function_exists('newCss')) {
    function newCss($asset)
    {
        return '<link href="' . $asset . '" media="all" rel="stylesheet" type="text/css">';
    }
}
if (!function_exists('newJs')) {
    function newJs($asset)
    {
        return '<script src="' . $asset . '?t=1.0"></script>';
    }
}
if (!function_exists('tooltip')) {
    function tooltip($title, $placement = 'top')
    {
        return 'data-toggle="tooltip" data-placement="' . $placement . '" title="' . $title . '"';
    }
}
if (!function_exists('oldCheck')) {
    function oldCheck($key, $default=false)
    {
        return (session()->hasOldInput()?(old($key)?true:false):$default)?'checked':null;
    }
}
//endregion
//region JSON
if (!function_exists('json')) {
    function json($array)
    {
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}
if (!function_exists('printJson')) {
    function printJson($var, $array, $scripts = false)
    {
        $result = $var . ' = ' . json($array) . ';';
        if ($scripts === true) $result = '<script>' . $result . '</script>';
        return $result;
    }
}
//endregion
//region Model
if (!function_exists('merge_model')) {
    function merge_model($from, $model, $keys)
    {
        if (empty($keys)) $keys = [];
        foreach ($keys as $key) {
            $model[$key] = $from[$key]??null;
        }
        return true;
    }
}
if (!function_exists('upload_image')) {
    function upload_image($key, $path, $sizes, $delete=false)
    {
        return \App\Services\FileManager\Facades\FileManager::uploadImage($key, $path, $sizes, $delete);
    }
}
if (!function_exists('upload_original_image')) {
    function upload_original_image($key, $path, $delete=false)
    {
        return \App\Services\FileManager\Facades\FileManager::uploadOriginalImage($key, $path, $delete);

    }
}
if (!function_exists('upload_file')) {
    function upload_file($key, $path, $delete=false)
    {
        return \App\Services\FileManager\Facades\FileManager::uploadFile($key, $path, $delete);
    }
}
if (!function_exists('get_range_data')) {
    function get_range_data($from, $to)
    {
        $from = (int) $from;
        $to = (int) $to;
        $result = [null, null];
        if ($from) {
            if (!$to) {
                $result[0] = $from;
            }
            elseif($from>$to) {
                $result[0] = $to;
                $result[1] = $from;
            }
            else {
                $result[0] = $from;
                $result[1] = $to;
            }
        } elseif($to) $result[0] = $to;
        return $result;
    }
}
//endregion
//region Math
if (!function_exists('gcd')) {
    function gcd( $a, $b){
        if ($a == 0) return $b;
        return gcd($b % $a, $a);
    }
}
if (!function_exists('lcm')) {
    function lcm( $a, $b) {
        return ($a * $b) / gcd($a, $b);
    }
}
//endregion
if (!function_exists('to_url')) {
    function to_url($string, $cut=true)
    {
        $str = Str::slug($string);
        if($cut) return mb_substr($str, 0, 100);
        return $str;
    }
}
if (!function_exists('to_url_suf')) {
    function to_url_suf($string)
    {
        return to_url($string).'-'.mt_rand(1000, 9999);
    }
}
if (!function_exists('file_name')) {
    function file_name($size = 20, $ext = '')
    {
        if ($ext) $ext = '.'.$ext;
        return Str::random($size) . $ext;
    }
}
if (!function_exists('r')) {
    function r($val)
    {
        return \PageManager::action($val);
    }
}
if (!function_exists('page')) {
    function page($static)
    {
        return route('page', ['url'=>r($static)]);
    }
}
if (!function_exists('is_active')) {
    function is_active($page)
    {
        return \PageManager::isActive($page);
    }
}
if (!function_exists('is_email')) {
    function is_email($value) {
        return preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i', $value);
    }
}
if (!function_exists('is_phone')) {
    function is_phone($value) {
        return preg_match('/^\+?[0-9-]+$/', $value);
    }
}
if (!function_exists('remove_qs')) {
    function remove_qs($string) {
        return strtok($string, '?');
    }
}
if (!function_exists('get_min')) {
    function get_min(...$params) {
        $min = false;
        foreach($params as $param) {
            $thisParam = (int) $param;
            if ($min===false || $thisParam<$min) $min = $thisParam;
        }
        return $min;
    }
}
if (!function_exists('get_max')) {
    function get_max(...$params) {
        $max = 0;
        foreach($params as $param) {
            $thisParam = (int) $param;
            if ($thisParam>$max) $max = $thisParam;
        }
        return $max;
    }
}
if (!function_exists('get_page')) {
    function get_page($static) {
        return \PageManager::getPage($static);
    }
}
if (!function_exists('set_locale')) {
    function set_locale() {
        return \LanguageManager::setLocaleWithoutPrefix();
    }
}

if (!function_exists('post_request')) {
    function post_request($url, $data) {
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ],
        ];
        $result = file_get_contents($url, false, stream_context_create($options));
        return $result;
    }
}
if (!function_exists('escape_like')) {
    function escape_like(string $value, string $char = '\\'): string
    {
        return str_replace(
            [$char, '%', '_'],
            [$char.$char, $char.'%', $char.'_'],
            $value
        );
    }
}
if (!function_exists('clear_dir')) {
    function clear_dir($dir) {
        if (file_exists($dir) && is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir.$object) && !is_link($dir."/".$object))
                        clear_dir($dir.$object);
                    else
                        unlink($dir.$object);
                }
            }
        }
    }
}
if (!function_exists('escape_like')) {
    function escape_like($string)
    {
        $search = array('%', '_');
        $replace   = array('\%', '\_');
        return str_replace($search, $replace, $string);
    }
}
