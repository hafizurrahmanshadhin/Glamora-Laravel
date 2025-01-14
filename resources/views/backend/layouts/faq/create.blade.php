@extends('backend.app')

@section('title', 'FAQ Create')

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
                                <li class="breadcrumb-item active">Create</li>
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
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-primary" onclick="addFaqField()">Add FAQ</button>
                            </div>
                            <form action="{{ route('faq.store') }}" method="POST" id="faq_form">
                                @csrf
                                <div class="row gy-4" id="faq_fields_container">
                                    @foreach (old('questions', ['']) as $index => $oldQuestion)
                                        <div class="col-12 faq-field">
                                            <div class="form-group">
                                                <label for="question_{{ $index }}"
                                                    class="form-label">Question:</label>
                                                <input type="text"
                                                    class="form-control @error('questions.' . $index) is-invalid @enderror"
                                                    id="question_{{ $index }}" name="questions[]"
                                                    placeholder="Enter your question" value="{{ $oldQuestion }}" required>
                                                @error('questions.' . $index)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="answer_{{ $index }}" class="form-label">Answer:</label>
                                                <textarea class="form-control @error('answers.' . $index) is-invalid @enderror" id="answer_{{ $index }}"
                                                    name="answers[]" placeholder="Enter your answer" required>{{ old('answers.' . $index) }}</textarea>
                                                @error('answers.' . $index)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            @if ($index > 0)
                                                <button type="button" class="btn btn-danger remove-faq-button mt-3"
                                                    onclick="removeFaqField(this)">Remove</button>
                                            @endif
                                        </div>
                                    @endforeach
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

@push('scripts')
    <script>
        let nextFaqFieldId = {{ count(old('questions', [''])) }};

        function addFaqField() {
            let faqFieldsContainer = document.getElementById("faq_fields_container");
            let newFaqField = document.createElement("div");
            newFaqField.className = "col-12 faq-field";
            newFaqField.innerHTML = `
                <div class="form-group">
                    <label for="question_${nextFaqFieldId}" class="form-label">Question:</label>
                    <input type="text" class="form-control" id="question_${nextFaqFieldId}" name="questions[]" placeholder="Enter your question" required>
                </div>
                <div class="form-group">
                    <label for="answer_${nextFaqFieldId}" class="form-label">Answer:</label>
                    <textarea class="form-control" id="answer_${nextFaqFieldId}" name="answers[]" placeholder="Enter your answer" required></textarea>
                </div>
                <button type="button" class="btn btn-danger remove-faq-button mt-3" onclick="removeFaqField(this)">Remove</button>
            `;
            faqFieldsContainer.appendChild(newFaqField);
            nextFaqFieldId++;
        }

        function removeFaqField(button) {
            button.closest('.faq-field').remove();
            nextFaqFieldId--;
        }
    </script>
@endpush
