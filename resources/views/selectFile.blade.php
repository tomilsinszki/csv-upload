@extends('layouts.app')

@section('content')
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold mb-5">Product upload</h1>
        <div class="col-lg-6 mx-auto">
            <div>
                <label for="formFileLg" class="form-label">Upload a csv file</label>
                <input class="form-control form-control-lg" id="formFileLg" type="file">
            </div>
        </div>
    </div>
@endsection
