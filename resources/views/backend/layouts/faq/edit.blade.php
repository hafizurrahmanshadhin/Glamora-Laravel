@extends('backend.app')

@section('title', 'FAQ Update')

@push('styles')
    <style>
        .faq-field {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .remove-faq-button {
            margin-top: 10px;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .form-control {
            border-radius: 8px;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('faq.index') }}">FAQ</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end page title --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('faq.update', ['id' => $faq->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="row gy-4" id="faq_fields_container">
                                    <div class="col-12 faq-field">
                                        <div class="form-group">
                                            <label for="question" class="form-label">Question:</label>
                                            <input type="text" placeholder="Enter your question" id="question"
                                                class="form-control @error('question') is-invalid @enderror" name="question"
                                                value="{{ old('question', $faq->question) }}" required />
                                            @error('question')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="answer" class="form-label">Answer:</label>
                                            <textarea placeholder="Enter your answer" id="answer" class="form-control @error('answer') is-invalid @enderror"
                                                name="answer" required>{{ old('answer', $faq->answer) }}</textarea>
                                            @error('answer')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('faq.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
