# Glamora - Beauty Services Booking Platform

Glamora is a Laravel-based application that connects clients with beauty service providers. Clients can filter and select multiple services, book appointments, negotiate time and pricing, and complete payments using integrated Stripe checkout. Beauty experts receive notifications when a booking is made and can respond accordingly.

## Table of Contents

- [Glamora - Beauty Services Booking Platform](#glamora---beauty-services-booking-platform)
  - [Table of Contents](#table-of-contents)
  - [Overview](#overview)
  - [Features](#features)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Glamora](#glamora)
  - [Live Link (Softvence)](#live-link-softvence)
  - [Live Link (Glamora)](#live-link-glamora)

## Overview

Glamora streamlines the process of booking beauty services. The platform allows clients to:

- Filter services by rating, price range, and location.
- Select multiple services for a single booking.
- View a detailed summary of selected services, pricing, and inclusions.
- Book appointments and negotiate date and time with beauty experts.
- Make secure payments using Stripe integration.

Beauty service providers (beauty experts) can view client bookings, receive notifications for new bookings, and negotiate appointment details before confirming payment.

## Features

- **Service Filtering:**
  Clients can filter available services by rating, price range, and location.

- **Multi-Service Selection:**
  Clients may select multiple services during filtering. The platform displays all selected services along with a calculated total price.

- **Booking & Negotiation:**
  Clients can book services and choose between mobile and salon options. Service providers receive a booking notification and can negotiate date and time if needed.

- **Notifications:**
  When a booking is made, beauty experts are notified via database notifications.

- **Payment Integration:**
  Secure payment is facilitated through Stripe. After negotiation, clients can complete payment via the integrated checkout process.

- **User Roles:**
  The application distinguishes between clients and beauty experts, enforcing role-based access for booking and profile management.

## Prerequisites

- PHP >= 8.2
- Composer
- MySQL
- Stripe API keys for payment processing
- Twilio keys for SMS notifications
- Reverb keys for real-time messaging

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/Webgenius0/armie0101_backend.git
   cd armie0101_backend
   ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install Node dependencies:

    ```bash
    npm install
    ```

4. Copy the .env file and configure:

    ```bash
    cp .env.example .env
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Configure your database settings in the .env file:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

7. Set up Stripe keys in your .env:

    ```bash
    STRIPE_KEY=your_stripe_public_key
    STRIPE_SECRET=your_stripe_secret_key
    ```

8. Set up Twilio keys in your .env:

    ```bash
    TWILIO_SID=your_twilio_sid
    TWILIO_AUTH_TOKEN=your_twilio_auth_token
    TWILIO_FROM=your_twilio_phone_number
    ```

9. Run the database migrations:

    ```bash
    php artisan migrate
    php artisan migrate:fresh --seed
    ```

10. Star the development server:

    ```bash
    php artisan serve
    ```

11. Start corn job (Not Needed):

    ```bash
    php artisan schedule:work

    * * * * * /usr/local/bin/php /home/qfe9ow4285wl/public_html/artisan schedule:work > /dev/null 2>&1
    ```

12. Start reverb websocket server (Not Needed Used Pusher for Real-time Messaging):

    ```bash
    php artisan reverb:start --debug
    ```

13. Visit `http://localhost:8000` in your browser to view the application.

## Glamora

## [Live Link (Softvence)](https://armie0101.softvencefsd.xyz)

................................................................................................................................

## [Live Link (Glamora)](https://glamora.com.au)

---

> ---
>
> ## 🔑 Login Credentials
>
>
> ## For Admin
>
> **Email:** <admin@admin.com>
>
> **Password:** 12345678
>
> ---
>
> ## For Client
>
> **Email:** <client@client.com>
>
> **Password:** 12345678
>
> ---
>
> ## For Beauty Expert
>
> **Email:** <beauty-expert@beauty-expert.com>
>
> **Password:** 12345678
>
> ---
