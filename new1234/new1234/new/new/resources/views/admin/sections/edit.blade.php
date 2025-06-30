@extends('layouts.master')

@section('title', 'Edit Class')

@section('content')
<div class="mt-3">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Class</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.sections.index') }}">Classes</a></li>
                        <li class="breadcrumb-item active">Edit Class</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                    
                        <form action="{{ route('admin.sections.update', $section->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Needed for updating -->
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Class Details</span></h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Class Name <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" id="section_name" name="name" value="{{ $section->name }}" required>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
