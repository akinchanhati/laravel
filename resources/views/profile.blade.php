@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('My Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update_profile') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="fname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text"
                                        class="form-control @error('fname') is-invalid @enderror" name="fname"
                                        value="{{ $user_details->fname }}" required autocomplete="fname" autofocus>

                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="lname" type="text"
                                        class="form-control @error('lname') is-invalid @enderror" name="lname"
                                        value="{{ $user_details->lname }}" required autocomplete="lname" autofocus>

                                    @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $user_details->email }}" required autocomplete="email" readonly>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Mobile no.') }}</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text"
                                        class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                        value="{{ $user_details->mobile }}" required autocomplete="mobile"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="11" autofocus>

                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="age"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

                                <div class="col-md-6">
                                    <input id="age" type="number" min="1" max="150"
                                        class="form-control @error('age') is-invalid @enderror" name="age"
                                        value="{{ $user_details->age }}" required autocomplete="age" autofocus>

                                    @error('age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                <div class="col-md-6 d-flex pt-2">
                                    <div class="mr-3"><input type="radio" id="male" name="gender" value="Male"
                                            required {{ $user_details->gender == 'Male' ? 'checked' : '' }}>
                                        <label for="male">Male</label>
                                    </div>
                                    <div class="mr-3"><input type="radio" id="female" name="gender" value="Female"
                                            required {{ $user_details->gender == 'Female' ? 'checked' : '' }}>
                                        <label for="female">Female</label>
                                    </div>
                                    <div class="mr-3"><input type="radio" id="other" name="gender" value="Other"
                                            required {{ $user_details->gender == 'Other' ? 'checked' : '' }}>
                                        <label for="other">Other</label>
                                    </div>

                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">My Course List</div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Added By</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($course_list[0]->user_info->fname) --}}
                                @foreach ($course_list as $key => $course)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ substr($course->description, 0, 20) }}{{ strlen($course->description) > 20 ? '...' : '' }}
                                        </td>
                                        <td>{{ $course->user_info->fname }} {{ $course->user_info->lname }}</td>
                                        <td>
                                            <a href="{{ url('/course_edit/' . $course->id) }}"><button type="submit"
                                                    class="btn btn-primary">
                                                    Edit
                                                </button></a>

                                            <a href="{{ url('/course_delete/' . $course->id) }}"
                                                onclick="return confirm('Are you sure to delete this Course?');"><button
                                                    type="submit" class="btn btn-danger">
                                                    Delete
                                                </button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $course_list->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
