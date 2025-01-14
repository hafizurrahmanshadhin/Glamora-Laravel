@extends('backend.app')

@section('title', 'Integration Settings')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('integration.setting') }}">Settings</a></li>
                                <li class="breadcrumb-item active">Integration Settings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end page title --}}

            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="google-tab" data-bs-toggle="tab"
                                        data-bs-target="#google" type="button" role="tab" aria-controls="google"
                                        aria-selected="true">Google</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="facebook-tab" data-bs-toggle="tab"
                                        data-bs-target="#facebook" type="button" role="tab" aria-controls="facebook"
                                        aria-selected="false">Facebook</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="stripe-tab" data-bs-toggle="tab" data-bs-target="#stripe"
                                        type="button" role="tab" aria-controls="stripe"
                                        aria-selected="false">Stripe</button>
                                </li>
                            </ul>
                            <div class="tab-content mt-4" id="myTabContent">
                                <div class="tab-pane fade show active" id="google" role="tabpanel"
                                    aria-labelledby="google-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Google Settings</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('google.update') }}">
                                                @csrf
                                                @method('PATCH')
                                                <div class="row gy-4">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="GOOGLE_CLIENT_ID" class="form-label">Google Client
                                                                Id:</label>
                                                            <input type="text"
                                                                class="form-control @error('GOOGLE_CLIENT_ID') is-invalid @enderror"
                                                                name="GOOGLE_CLIENT_ID" id="GOOGLE_CLIENT_ID"
                                                                placeholder="Please Enter Your Google Client Id"
                                                                value="{{ env('GOOGLE_CLIENT_ID') }}">
                                                            @error('GOOGLE_CLIENT_ID')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="GOOGLE_CLIENT_SECRET" class="form-label">Google
                                                                Client Secret:</label>
                                                            <input type="text"
                                                                class="form-control @error('GOOGLE_CLIENT_SECRET') is-invalid @enderror"
                                                                name="GOOGLE_CLIENT_SECRET" id="GOOGLE_CLIENT_SECRET"
                                                                placeholder="Please Enter Your Google Client Secret"
                                                                value="{{ env('GOOGLE_CLIENT_SECRET') }}">
                                                            @error('GOOGLE_CLIENT_SECRET')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mt-3">
                                                        <button type="submit" class="btn btn-primary">Save Google
                                                            Settings</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="facebook" role="tabpanel" aria-labelledby="facebook-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Facebook Settings</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('facebook.update') }}">
                                                @csrf
                                                @method('PATCH')
                                                <div class="row gy-4">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="FACEBOOK_CLIENT_ID" class="form-label">Facebook
                                                                Client Id:</label>
                                                            <input type="text"
                                                                class="form-control @error('FACEBOOK_CLIENT_ID') is-invalid @enderror"
                                                                name="FACEBOOK_CLIENT_ID" id="FACEBOOK_CLIENT_ID"
                                                                placeholder="Please Enter Your Facebook Client Id"
                                                                value="{{ env('FACEBOOK_CLIENT_ID') }}">
                                                            @error('FACEBOOK_CLIENT_ID')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="FACEBOOK_CLIENT_SECRET"
                                                                class="form-label">Facebook Client Secret:</label>
                                                            <input type="text"
                                                                class="form-control @error('FACEBOOK_CLIENT_SECRET') is-invalid @enderror"
                                                                name="FACEBOOK_CLIENT_SECRET" id="FACEBOOK_CLIENT_SECRET"
                                                                placeholder="Please Enter Your Facebook Client Secret"
                                                                value="{{ env('FACEBOOK_CLIENT_SECRET') }}">
                                                            @error('FACEBOOK_CLIENT_SECRET')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mt-3">
                                                        <button type="submit" class="btn btn-primary">Save Facebook
                                                            Settings</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="stripe" role="tabpanel" aria-labelledby="stripe-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Stripe Settings</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('stripe.update') }}">
                                                @csrf
                                                @method('PATCH')
                                                <div class="row gy-4">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="STRIPE_KEY" class="form-label">Stripe Key:</label>
                                                            <input type="text"
                                                                class="form-control @error('STRIPE_KEY') is-invalid @enderror"
                                                                name="STRIPE_KEY" id="STRIPE_KEY"
                                                                placeholder="Please Enter Your Stripe Key"
                                                                value="{{ env('STRIPE_KEY') }}">
                                                            @error('STRIPE_KEY')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="STRIPE_SECRET" class="form-label">Stripe
                                                                Secret:</label>
                                                            <input type="text"
                                                                class="form-control @error('STRIPE_SECRET') is-invalid @enderror"
                                                                name="STRIPE_SECRET" id="STRIPE_SECRET"
                                                                placeholder="Please Enter Your Stripe Secret"
                                                                value="{{ env('STRIPE_SECRET') }}">
                                                            @error('STRIPE_SECRET')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mt-3">
                                                        <button type="submit" class="btn btn-primary">Save Stripe
                                                            Settings</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> {{-- End card body --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
