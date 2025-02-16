@extends('backend.app')

@section('title', 'Dashboard')

@push('styles')
    <style>
        .stat-card {
            transition: transform 0.2s;
            border-radius: 0.75rem;
            border: 1px solid #e9ecef;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        }

        .icon-box {
            width: 45px;
            height: 45px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .activity-item {
            padding: 0.75rem;
            border-radius: 0.5rem;
            transition: background-color 0.2s;
        }

        .activity-item:hover {
            background-color: #f8f9fa;
        }

        .avatar {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .system-item i {
            width: 40px;
            text-align: center;
        }
    </style>
@endpush

@section('content')
    <div class="page-content wrapper">
        <div class="container-fluid">
            <div class="row">
                {{-- Users Card Start --}}
                <div class="col-md-3 mb-4">
                    <div class="card stat-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title text-muted mb-2">Total Users</h5>
                                    <h2 class="mb-0">{{ $userStats['total'] }}</h2>
                                </div>
                                <div class="icon-box bg-primary">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted">Clients</small>
                                    <p class="mb-0 fw-bold">{{ $userStats['clients'] }}</p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Experts</small>
                                    <p class="mb-0 fw-bold">{{ $userStats['beautyExperts'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Users Card End --}}

                {{-- Bookings Card Start --}}
                <div class="col-md-3 mb-4">
                    <div class="card stat-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title text-muted mb-2">Total Bookings</h5>
                                    <h2 class="mb-0">{{ $bookingStats['total'] }}</h2>
                                </div>
                                <div class="icon-box bg-success">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <small class="text-muted">New This Week</small>
                                <p class="mb-0 fw-bold text-success">{{ $bookingStats['newThisWeek'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Bookings Card End --}}

                {{-- Services Card Start --}}
                <div class="col-md-3 mb-4">
                    <div class="card stat-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title text-muted mb-2">Services & Content</h5>
                                    <h2 class="mb-0">{{ $serviceStats['totalServices'] }}</h2>
                                </div>
                                <div class="icon-box bg-info">
                                    <i class="fas fa-concierge-bell"></i>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted">Active Services</small>
                                    <p class="mb-0 fw-bold">{{ $serviceStats['activeServices'] }}</p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">FAQs</small>
                                    <p class="mb-0 fw-bold">{{ $systemStats['faqs'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Services Card End --}}

                {{-- Engagement Card Start --}}
                <div class="col-md-3 mb-4">
                    <div class="card stat-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title text-muted mb-2">Engagement</h5>
                                    <h2 class="mb-0">{{ $reviewStats['total'] }}</h2>
                                </div>
                                <div class="icon-box bg-warning">
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted">Avg Rating</small>
                                    <p class="mb-0 fw-bold">{{ number_format($reviewStats['averageRating'], 1) }}/5</p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Social Profiles</small>
                                    <p class="mb-0 fw-bold">{{ $systemStats['socialMedia'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Engagement Card End --}}
            </div>


            <div class="row">
                {{-- Recent Activities Start --}}
                <div class="col-md-8">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Recent Activities</h5>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary active"
                                    data-bs-target="#bookings" onclick="switchTab('bookings')">Bookings</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-target="#contacts"
                                    onclick="switchTab('contacts')">Inquiries</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-target="#reports"
                                    onclick="switchTab('reports')">Reports</button>
                            </div>
                        </div>
                        <div class="card-body tab-content">
                            {{-- Bookings Tab Start --}}
                            <div class="tab-pane active" id="bookings">
                                @foreach ($recentActivities['bookings'] as $booking)
                                    <div class="activity-item d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <div class="avatar bg-light-primary p-2 rounded">
                                                <i class="fas fa-calendar-alt fs-5 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">{{ $booking->user->first_name }}'s Booking</h6>
                                            <small class="text-muted">
                                                {{ $booking->userService->service->services_name }} -
                                                {{ $booking->appointment_date->format('M d, Y') }}
                                            </small>
                                        </div>
                                        <span
                                            class="badge bg-{{ $booking->status == 'completed' ? 'success' : 'warning' }}">
                                            {{ $booking->status }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                            {{-- Bookings Tab End --}}

                            {{-- Contacts Tab Start --}}
                            <div class="tab-pane" id="contacts">
                                @foreach ($recentActivities['contacts'] as $contact)
                                    <div class="activity-item d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <div class="avatar bg-light-info p-2 rounded">
                                                <i class="fas fa-envelope fs-5 text-info"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">{{ $contact->name }}</h6>
                                            <small class="text-muted">{{ Str::limit($contact->message, 40) }}</small>
                                        </div>
                                        <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                                    </div>
                                @endforeach
                            </div>
                            {{-- Contacts Tab End --}}

                            {{-- Reports Tab Start --}}
                            <div class="tab-pane" id="reports">
                                @foreach ($recentActivities['reports'] as $report)
                                    <div class="activity-item d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <div class="avatar bg-light-danger p-2 rounded">
                                                <i class="fas fa-exclamation-triangle fs-5 text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Report #{{ $report->id }}</h6>
                                            <small class="text-muted">{{ Str::limit($report->message, 40) }}</small>
                                        </div>
                                        <small class="text-muted">{{ $report->created_at->diffForHumans() }}</small>
                                    </div>
                                @endforeach
                            </div>
                            {{-- Reports Tab End --}}
                        </div>
                    </div>
                </div>
                {{-- Recent Activities End --}}

                {{-- System Overview Start --}}
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-0">System Overview</h5>
                        </div>
                        <div class="card-body">
                            <div class="system-item d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-file-alt fs-4 text-primary"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">Dynamic Pages</h6>
                                    <small class="text-muted">{{ $systemStats['activePages'] }} Active Pages</small>
                                </div>
                            </div>

                            <div class="system-item d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-question-circle fs-4 text-info"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">FAQs</h6>
                                    <small class="text-muted">{{ $systemStats['faqs'] }} Questions</small>
                                </div>
                            </div>

                            <div class="system-item d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-bug fs-4 text-danger"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">Active Reports</h6>
                                    <small class="text-muted">{{ $systemStats['reports'] }} Needs Attention</small>
                                </div>
                            </div>

                            <div class="system-item d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-share-alt fs-4 text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">Social Media</h6>
                                    <small class="text-muted">{{ $systemStats['socialMedia'] }} Connected Accounts</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- System Overview End --}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function switchTab(tabId) {
            // Tab switching logic
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
            document.querySelectorAll('.btn-outline-secondary').forEach(btn => btn.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
            event.currentTarget.classList.add('active');
        }
    </script>
@endpush
