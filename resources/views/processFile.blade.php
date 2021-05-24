@extends('layouts.app')

@section('meta')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="px-4 py-5 my-5 text-center">
        @for ($columnIndex = 0; $columnIndex < $columnCount; $columnIndex++)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $sampleRows[0][$columnIndex] }}</h5>
                    <p class="card-text">
                        <p class="text-secondary mb-3">
                            {{ $sampleRows[1][$columnIndex] }}
                        </p>
                        <p class="text-secondary mb-3">
                            {{ $sampleRows[2][$columnIndex] }}
                        </p>
                        <p class="text-secondary mb-3">
                            {{ $sampleRows[3][$columnIndex] }}
                        </p>
                    </p>
                </div>
            </div>
        @endfor
    </div>
@endsection
