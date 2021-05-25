@extends('layouts.app')

@section('meta')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <form id="mappingForm">
        <input id="csrfToken" type="hidden" name="_token" value="" />
        <input type="hidden" name="file_name" value="{{ $fileName }}" />

        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold mb-5">Map fields</h1>

            @for ($columnIndex = 0; $columnIndex < $columnCount; $columnIndex++)
                <div class="card mb-5">
                    <div class="card-header">
                        {{ $sampleRows[0][$columnIndex] }}
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="mb-5">
                                @for ($i = 1; $i < 4; $i++)
                                    <p class="text-secondary mb-3">
                                        {{ $sampleRows[$i][$columnIndex] }}
                                    </p>
                                @endfor
                            </div>
                            <div class="form-group">
                                <label for="mapping-{{ $columnIndex  }}">Map to existing field</label>
                                <select class="form-control" name="mapping-{{ $columnIndex  }}" id="mapping-{{ $columnIndex  }}">
                                    <option></option>
                                    <option value="brandName">brand name</option>
                                    <option value="name">name</option>
                                    <option value="description">description</option>
                                    <option value="price">price</option>
                                    <option value="url">url</option>
                                    <option value="externalId">external id</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="new-field-{{ $columnIndex  }}">Or create a new custom field</label>
                                <input type="text" class="form-control" name="new-field-{{ $columnIndex  }}" id="new-field-{{ $columnIndex  }}" placeholder="New custom field name (e.g. Year of Production)">
                            </div>
                        </div>
                    </div>
                </div>
            @endfor

            <button type="submit" class="btn btn-lg btn-primary">Import</button>
        </div>
    </form>

    <script type="text/javascript">
        let CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        $(document).ready(function() {
            let mappingForm = $('#mappingForm');

            mappingForm.submit(function () {
                let formData = new FormData($('#mappingForm')[0]);
                formData.append('_token', CSRF_TOKEN);

                $.ajax({
                    url: "{{ route('processFile') }}",
                    method: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                    },
                    error: function(response){
                        //console.log("error : " + JSON.stringify(response) );
                    }
                });

                return false;
            });
        });
    </script>
@endsection
