# Super Nerd Bros: Dodo Air (wp-dodo-air)

![Online Islanders](https://img.shields.io/endpoint?url=https%3A%2F%2Fdodoair.forthexp.com%2Fwp-json%2Fdodo-air%2Fv1%2Fbadges%2Fonline)
![Total Islanders](https://img.shields.io/endpoint?url=https%3A%2F%2Fdodoair.forthexp.com%2Fwp-json%2Fdodo-air%2Fv1%2Fbadges%2Ftotal)
![All-Time Pilots](https://img.shields.io/endpoint?url=https%3A%2F%2Fdodoair.forthexp.com%2Fwp-json%2Fdodo-air%2Fv1%2Fbadges%2Fpilots)
![All-Time Passengers](https://img.shields.io/endpoint?url=https%3A%2F%2Fdodoair.forthexp.com%2Fwp-json%2Fdodo-air%2Fv1%2Fbadges%2Fpassengers)
![Total Views](https://img.shields.io/endpoint?url=https%3A%2F%2Fdodoair.forthexp.com%2Fwp-json%2Fdodo-air%2Fv1%2Fbadges%2Fviews)

Dodo Air is a sophisticated WordPress plugin designed for the Xophz COMPASS platform, powering the backend for the **Dodo Airlines** companion web app experience.

## Features

- **Real-Time Traffic Control**: Track online islanders, pilots, and active flight metrics natively via REST endpoints.
- **Flight & Dream Integration**: Provides API endpoints for booking flights, entering dream codes (Luna), and managing passenger manifests.
- **XP Ecosystem Integration**: Ties directly into the project's global gamification system (`xophz-compass-xp`), enabling users to spend and earn "Miles" (GP) for flying and hosting.
- **AI-Powered Flight Reviews**: Connects dynamically with Google's Gemini AI to generate customized, in-character (Orville and Luna) travel brochures and flight reviews based on manifest data.
- **Dynamic Shields.io Badges**: Exposes formatted metrics strictly for generating live community tracking badges.

## REST API Endpoints

All endpoints are registered under `/wp-json/dodo-air/v1/`.

### Core Application State
- `GET /state` - Comprehensive system state including online islanders, schedules, active chatter, and user passport information.

### Badges (Traffic Control)
Provides live `Shields.io` endpoint-compliant data for community badges:
- `GET /badges/online` - Live active users in the last 120 seconds.
- `GET /badges/total` - Total registered users.
- `GET /badges/pilots` - All-time count of unique hosted flights and dreams.
- `GET /badges/passengers` - All-time count of total passengers boarded.
- `GET /badges/views` - Total accumulated app views.

### Flights & Dreams
- `POST /flights` - Host a new flight.
- `POST /flights/{id}/board` - Board an active flight (deducts GP miles).
- `POST /flights/{id}/status` - Update flight availability status.
- `POST /dreams` - Register a Luna dream code.
- `POST /dreams/{id}/visit` - Visit a dream island.

### Authentication & XP
- `POST /auth/request-code` - Request a temporary 6-digit login pin.
- `POST /stamps/claim` - Claim achievements and earn Nook Miles (GP).

## System Requirements

- WordPress 6.0+
- The **Xophz COMPASS Core** plugin ecosystem.
- PHP 8.0+

## Development

This plugin serves as the headless backend for the Svelte/Vite-based Dodo Air frontend application. Please see the frontend repository for UI-related development instructions.