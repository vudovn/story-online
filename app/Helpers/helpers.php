<?php

if (!function_exists('format_date')) {
    function format_date($date, $format = 'd/m/Y')
    {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}


if (!function_exists('str_slug')) {
    function str_slug($str, $separator = '-')
    {
        return Str::slug($str, $separator);
    }
}

if (!function_exists('get_category')) {
    function get_category()
    {
        return \App\Models\Category::where('status', 1)->orderBy('created_at', 'desc')->get();
    }
}


if (!function_exists('transaction')) {
    function transaction(Closure $callback)
    {
        DB::beginTransaction();
        try {
            $result = $callback(); // chạy logic chính
            DB::commit();
            return $result; // trả về kết quả nếu cần
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e; // ném lỗi ra lại để bên ngoài xử lý tiếp
        }
    }
}

if (!function_exists('setting')) {
    function setting()
    {
        return \App\Models\Setting::first();
    }
}
