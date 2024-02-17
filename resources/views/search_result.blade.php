@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Search Result</div>
                    @if (count($search_result) > 0)
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
                                    @foreach ($search_result as $key => $result)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $result->name }}</td>
                                            <td>{{ substr($result->description, 0, 20) }}{{ strlen($result->description) > 20 ? '...' : '' }}
                                            </td>
                                            <td>{{ $result->user_info->fname }} {{ $result->user_info->lname }}</td>
                                            <td>
                                                <a href="{{ url('/course_edit/' . $result->id) }}"><button type="submit"
                                                        class="btn btn-primary">
                                                        Edit
                                                    </button></a>

                                                <a href="{{ url('/course_delete/' . $result->id) }}"
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
                            {{ $search_result->links() }}
                        </div>
                    @else
                        <div class="card-body">
                            No result found...
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
