<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use App\Models\UserService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AvailableServicesController extends Controller {
    /**
     * Display the available beauty services page.
     *
     * @param mixed|null $serviceId Optional serviceId from the route.
     * @return View|JsonResponse
     */
    public function index(mixed $serviceId = null): View | JsonResponse {
        try {
            $rating     = request('rating');
            $priceRange = request('price_range');
            $location   = request('location');
            $searchDate = request('date');

            // Retrieve serviceIds from query parameters.
            $queryParamIds = request('service_ids');
            if ($queryParamIds && !is_array($queryParamIds)) {
                $queryParamIds = explode(',', $queryParamIds);
            }

            // If no query parameter provided but route parameter exists, use that
            if (empty($queryParamIds) && $serviceId) {
                $queryParamIds = [$serviceId];
            }

            // Fetch selected service names (if any)
            $selectedServiceNames = [];
            if (!empty($queryParamIds)) {
                $selectedServiceNames = Service::whereIn('id', $queryParamIds)
                    ->pluck('services_name')
                    ->toArray();
            }

            // Build the query for approved services.
            $query = UserService::where('status', 'active')->with(['service', 'user']);
            if (!empty($queryParamIds)) {
                $query->whereIn('service_id', $queryParamIds);
            }

            $approvedServices = $query->get()->map(function ($service) {
                $averageRating = Review::where('status', 'active')
                    ->whereHas('booking.userService', function ($q) use ($service) {
                        $q->where('user_id', $service->user_id);
                    })
                    ->avg('rating') ?? 0;

                $service->average_rating = round($averageRating * 2) / 2;
                $service->review_count   = Review::where('status', 'active')
                    ->whereHas('booking.userService', function ($q) use ($service) {
                        $q->where('user_id', $service->user_id);
                    })
                    ->count();
                $service->styler_count = UserService::where('service_id', $service->service_id)
                    ->where('status', 'active')
                    ->distinct('user_id')
                    ->count();

                return $service;
            });

            // Filter by date availability if date is provided
            if ($searchDate) {
                $approvedServices = $approvedServices->filter(function ($service) use ($searchDate) {
                    $isAvailable = $this->isUserAvailableOnDate($service->user()->first(), $searchDate);
                    return $isAvailable;
                });
            }

            // Filter by rating if selected
            if ($rating) {
                $ratingMap = [
                    1 => [5.0, 5.9],
                    2 => [4.0, 4.9],
                    3 => [3.0, 3.9],
                    4 => [2.0, 2.9],
                    5 => [1.0, 1.9],
                    6 => [0.0, 0.9],
                ];
                if (isset($ratingMap[$rating])) {
                    [$minRating, $maxRating] = $ratingMap[$rating];
                    $approvedServices        = $approvedServices->filter(function ($service) use ($minRating, $maxRating) {
                        return $service->average_rating >= $minRating && $service->average_rating <= $maxRating;
                    });
                }
            }

            // Filter by price range if selected
            if ($priceRange) {
                $approvedServices = $approvedServices->filter(function ($service) use ($priceRange) {
                    $price = (float) $service->total_price;
                    switch ($priceRange) {
                    case '10-100':
                        return $price >= 10 && $price <= 100;
                    case '101-200':
                        return $price >= 101 && $price <= 200;
                    case '500-1000':
                        return $price >= 500 && $price <= 1000;
                    case '1000+':
                        return $price > 1000;
                    default:
                        return true;
                    }
                });
            }

            // Filter by location if provided
            if ($location) {
                $approvedServices = $approvedServices->filter(function ($service) use ($location) {
                    if ($service->user && $service->user->businessInformation) {
                        $businessInfo = $service->user->businessInformation;
                        return stripos($businessInfo->business_address, $location) !== false ||
                        stripos($businessInfo->address, $location) !== false;
                    }
                    return false;
                });
            }

            return view('frontend.layouts.available_services.index', [
                'serviceId'            => $serviceId,
                'serviceIds'           => $queryParamIds,
                'selectedServiceNames' => $selectedServiceNames,
                'approvedServices'     => $approvedServices,
                'selectedRating'       => $rating,
                'selectedPrice'        => $priceRange,
                'location'             => $location,
                'searchDate'           => $searchDate,
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Check if a beauty expert is available on a specific date.
     *
     * @param User $user
     * @param string $searchDate (d/m/Y or d/m/y format)
     * @return bool
     */
    private function isUserAvailableOnDate(User $user, string $searchDate): bool {
        // Check if user is a beauty expert and is active
        if ($user->role !== 'beauty_expert' || $user->status !== 'active') {
            return false;
        }

        // Check if user is currently available
        if ($user->availability === 'unavailable') {
            return false;
        }

        try {
            // Normalize the search date - handle both d/m/y and d/m/Y formats
            $searchDateCarbon = null;

            // Try to parse the search date with explicit year handling
            if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{2})$/', $searchDate, $matches)) {
                // Format: dd/mm/yy - need to convert to full year
                $day              = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
                $month            = str_pad($matches[2], 2, '0', STR_PAD_LEFT);
                $year             = '20' . $matches[3]; // Assuming 21st century
                $fullDate         = "{$day}/{$month}/{$year}";
                $searchDateCarbon = Carbon::createFromFormat('d/m/Y', $fullDate);
            } elseif (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $searchDate, $matches)) {
                // Format: dd/mm/yyyy
                $searchDateCarbon = Carbon::createFromFormat('d/m/Y', $searchDate);
            }

            if (!$searchDateCarbon) {
                // If it can't parse the date, assume available
                return true;
            }

            $dateToCheck = $searchDateCarbon->format('Y-m-d');
        } catch (Exception $e) {
            // If date format is invalid, assume available
            return true;
        }

        // Check if date falls within any unavailable ranges
        if (!empty($user->unavailable_ranges)) {
            foreach ($user->unavailable_ranges as $range) {
                if (isset($range['from_date']) && isset($range['to_date'])) {
                    try {
                        // Parse database dates (should be in d/m/Y format)
                        $fromDateCarbon = Carbon::createFromFormat('d/m/Y', $range['from_date']);
                        $toDateCarbon   = Carbon::createFromFormat('d/m/Y', $range['to_date']);

                        $fromDate = $fromDateCarbon->format('Y-m-d');
                        $toDate   = $toDateCarbon->format('Y-m-d');

                        // If the search date falls within this unavailable range, user is not available
                        if ($dateToCheck >= $fromDate && $dateToCheck <= $toDate) {
                            return false;
                        }

                    } catch (Exception $e) {
                        continue;
                    }
                }
            }
        }

        // Check weekend availability if weekend_data is set
        if (!empty($user->weekend_data)) {
            $dayOfWeek = $searchDateCarbon->dayOfWeek; // 0 = Sunday, 1 = Monday, etc.

            // Check if the user is available on this day of the week
            $isAvailableOnDay = collect($user->weekend_data)->contains(function ($dayData) use ($dayOfWeek) {
                return isset($dayData['day']) && (int) $dayData['day'] === $dayOfWeek;
            });

            return $isAvailableOnDay;
        }
        // If no weekend restrictions and not in unavailable ranges, user is available
        return true;
    }
}
