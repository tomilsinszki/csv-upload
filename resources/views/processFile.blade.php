@extends('layouts.app')

@section('meta')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="px-4 py-5 my-5 text-center">
        @for ($columnIndex = 0; $columnIndex < $columnCount; $columnIndex++)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $sampleRows[0][$columnIndex] }}</h5>
                    <div class="card-text">
                        @for ($i = 1; $i < 4; $i++)
                        <p class="text-secondary mb-3">
                            {{ $sampleRows[$i][$columnIndex] }}
                        </p>
                        @endfor
                    </div>
                </div>
            </div>
        @endfor
    </div>
@endsection
