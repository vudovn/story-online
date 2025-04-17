@extends('admin.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Setting</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="row" action="{{ route('admin.setting.update') }}" method="post">
                        @csrf
                        <div class="col-8">
                            <div class="mb-3">
                                <label for="">Site name</label>
                                <input required value="{{ $setting->site_name }}" type="text" name="site_name"
                                    class="form-control">
                            </div>
                            <div>
                                <label for="">API key Gemini AI</label>
                                <input required value="{{ $setting->api_key }}" type="text" name="api_key"
                                    class="form-control">
                                <small><a target="_blank"
                                        href="https://centrix.software/cach-lay-gemini-ai-api-key-mien-phi/">Hướng dẫn lấy
                                        API key Gemini AI</a></small>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="mb-3">
                                <div class="thumbnail img-cover image-target">
                                    <img src="{{ $setting->site_logo }}" width="100%" class="img-thumbnail img-fluid"
                                        alt="Cover Image">
                                </div>
                                <input required type="hidden" name="site_logo" value="{{ $setting->site_logo }}">
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection