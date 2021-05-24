@extends('layouts.app')

@section('meta')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold mb-5">Product upload</h1>
        <div class="col-lg-6 mx-auto">
            <div class="alert d-none" id="responseMessage"></div>

            <div>
                <form id="csvUploadForm">
                    <div class="form-row row align-items-center">
                        <div class="col-auto my-1">
                            <input class="form-control form-control-lg" id="formFile" type="file">
                        </div>
                        <div class="col-auto my-1">
                            <div>
                                <button type="submit" class="btn btn-lg btn-primary">Upload</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        let CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        $(document).ready(function() {
            $('#csvUploadForm').submit(function () {
                let files = $('#formFile')[0].files;

                if (0 < files.length) {
                    let formData = new FormData();

                    formData.append('file',files[0]);
                    formData.append('_token',CSRF_TOKEN);

                    $('#responseMessage').addClass('d-none');

                    $.ajax({
                        url: "{{ route('uploadFile') }}",
                        method: 'post',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response){
                            let responseMessageElement = $('#responseMessage');

                            if (response.success === '1') {
                                responseMessageElement.removeClass("alert-danger");
                                responseMessageElement.addClass("alert-success");
                                responseMessageElement.html(response.message);
                                responseMessageElement.removeClass('d-none');
                            } else if (response.success === '2'){
                                responseMessageElement.removeClass("alert-success");
                                responseMessageElement.addClass("alert-danger");
                                responseMessageElement.html(response.message);
                                responseMessageElement.addClass('d-none');
                            }
                        },
                        error: function(response){
                            console.log("error : " + JSON.stringify(response) );
                        }
                    });
                } else {
                    alert("Please select a file.");
                }

                return false;
            });
        });
    </script>
@endsection
