@extends('layouts.app')

@section('title', 'Subject Management')
@section('subject', 'kt-menu__item--active')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Subject
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('subject.list')}}" class="kt-subheader__breadcrumbs-link">
            List Subject
        </a>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
@endsection
@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__body">
        @include('layouts.notification')
        <div class="col-md-2 mb-4" style="padding-left:0px">
            <a href="#" type="button" class="btn btn-primary btn-sm" data-toggle='modal' data-target='#addModal'><i class="la la-plus"></i> Add New Subject</a>
        </div>
        <table id="datatable" class="display compact nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>List Exams</th>
                    <th>List Questions</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $key => $subject)
                    <tr>
                        <td>{{ $subject->name }}</td>
                        <td>
                            <a href="#" title="{{$subject->count_exam_subject}}" type="button" class="btn btn-success btn-sm"><i class="la la-list"></i></a>
                            &nbsp;{{ $subject->count_exam_subject ?? 0 }} Exams
                        </td>
                        <td>
                            <a href="#" title="{{$subject->count_question_subject}}" type="button" class="btn btn-info btn-sm"><i class="la la-list"></i></a>
                            &nbsp;{{ $subject->count_question_subject ?? 0 }} Questions
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="#" title="{{$subject->name}}" type="button" class="btn btn-warning btn-sm" data-toggle='modal' data-target='#editModal{{$subject->id}}'><i class="la la-edit"></i></a>
                                <a href="{{route('subject.delete', $subject->id)}}" title="{{$subject->name}}" type="button" class="btn btn-danger btn-sm"><i class="la la-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                            
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{$subject->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form class="form" action="{{route('subject.update', $subject->id)}}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Subject</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{old('name') ?? $subject->name}}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        
        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form" action="{{route('subject.store')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Subject</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
