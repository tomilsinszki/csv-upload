@extends('layouts.app')

@section('meta')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold mb-5">Product upload</h1>
        <div class="col-lg-6 mx-auto">
            <div class="alert d-none" id="responseMsg"></div>

            <div>
                <form id="csvUploadForm">
                    <div class="form-row row align-items-center">
                        <div class="col-auto my-1">
                            <input class="form-control form-control-lg" id="formFile" type="file">
                        </div>
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-lg btn-primary">Upload</button>
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
                console.log('upload form submitted');

                let files = $('#formFile')[0].files;

                if (0 < files.length) {
                    let fd = new FormData();

                    fd.append('file',files[0]);
                    fd.append('_token',CSRF_TOKEN);

                    // TODO: add
                    $('#responseMsg').addClass('d-none');

                    $.ajax({
                        url: "{{ route('uploadFile') }}",
                        method: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response){
                            // Hide error container
                            //$('#err_file').removeClass('d-block');
                            //$('#err_file').addClass('d-none');

                            if(response.success == 1){ // Uploaded successfully

                                // Response message
                                $('#responseMsg').removeClass("alert-danger");
                                $('#responseMsg').addClass("alert-success");
                                $('#responseMsg').html(response.message);
                                $('#responseMsg').removeClass('d-none');

                                // File preview
                                /*
                                $('#filepreview').show();
                                $('#filepreview img,#filepreview a').hide();
                                if(response.extension == 'jpg' || response.extension == 'jpeg' || response.extension == 'png'){

                                    $('#filepreview img').attr('src',response.filepath);
                                    $('#filepreview img').show();
                                }else{
                                    $('#filepreview a').attr('href',response.filepath).show();
                                    $('#filepreview a').show();
                                }
                                */
                            }else if(response.success == 2){ // File not uploaded

                                // Response message
                                $('#responseMsg').removeClass("alert-success");
                                $('#responseMsg').addClass("alert-danger");
                                $('#responseMsg').html(response.message);
                                $('#responseMsg').addClass('d-none');
                            }else{
                                // Display Error
                                /*
                                $('#err_file').text(response.error);
                                $('#err_file').removeClass('d-none');
                                $('#err_file').addClass('d-block');
                                */
                            }
                        },
                        error: function(response){
                            console.log("error : " + JSON.stringify(response) );
                        }
                    });
                }else{
                    alert("Please select a file.");
                }

                return false;
            });
        });
    </script>
@endsection
