@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Course') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('course_update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $course_details->id }}">
                            <div class="form-group row">
                                <label for="fname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Course Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $course_details->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Course Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" rows="3" class="form-control @error('description') is-invalid @enderror"
                                        name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>{{ $course_details->description }}
                                    </textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
