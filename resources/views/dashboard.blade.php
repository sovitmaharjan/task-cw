@extends('layouts.app')

@section('page', 'Dashboard')
@section('group', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <div class="row">
                    <div class="col-lg-12">

                        <h4 class="header-title">Form</h4>

                        <div class="p-4">
                            <form action="{{ route('json.export') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="file">JSON File<span class="text-danger">*</span></label>
                                    <input type="file" name="file" parsley-trigger="change" required=""
                                        class="form-control" id="file">
                                </div>

                                <div class="form-group text-right mb-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect ml-1">
                                        Cancel
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
