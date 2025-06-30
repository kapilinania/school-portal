@extends('layouts.master')

@section('title', 'Subject: Edit')

@section('content')
<div class="mt-4">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Subject</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.subjects.index') }}">Subject</a></li>
                        <li class="breadcrumb-item active">Edit Subject</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.subjects.update', ['section' => $section->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Subject Information</span></h5>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Section <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" id="section" name="section"
                                            value="{{ $section->name }}" required readonly>
                                        @error('section')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-6 col-sm-6">
                                    <div class="form-group local-forms" id="subjects-wrapper">
                                        <label>Subjects <span class="login-danger">*</span></label>
                                        @foreach ($subjects as $subject)
                                            <div class="subject-input-wrapper mb-2">
                                                <input type="text" class="form-control"
                                                    name="subjects[{{ $subject->id }}]" 
                                                    value="{{ old('subjects.' . $subject->id, $subject->name) }}" required>
                                                <input type="checkbox" name="delete_subjects[]" value="{{ $subject->id }}"> Delete
                                            </div>
                                        @endforeach
                                        <div class="text-danger" id="duplicate-message"></div>
                                        @error('subjects')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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

@section('scripts')
<script>
    const subjectInputs = document.querySelectorAll('input[name^="subjects["]');
    const duplicateMessage = document.getElementById('duplicate-message');

    document.querySelector('form').addEventListener('submit', function(e) {
        const enteredSubjects = Array.from(subjectInputs).map(input => input.value.trim().toLowerCase());
        const hasDuplicates = enteredSubjects.some((item, index) => enteredSubjects.indexOf(item) !== index);

        if (hasDuplicates) {
            e.preventDefault();
            duplicateMessage.textContent = 'Error: Duplicate subjects detected!';
        } else {
            duplicateMessage.textContent = '';
        }
    });
</script>
@endsection
