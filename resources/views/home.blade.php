@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row justify-content-center d-flex">
                            <div class="col-md-4">Total Course : {{ $total_course }}</div>
                            <div class="col-md-4">My Course : {{ count(Auth::user()->my_list) }}</div>
                        </div>
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
