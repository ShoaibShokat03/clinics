# Prescription API Documentation

This document provides details on how to request prescription-related APIs in the Dental application.

---

## Base URL

All API endpoints follow this pattern:

```
{BASE_URL}/{project}/api/...
```

Where:
- `{BASE_URL}` = Your application's base URL (e.g., `https://yourdomain.com` or `http://localhost:8000`)
- `{project}` = The tenant/project identifier (e.g., `clinic1`, `main`, etc.)

---

## Authentication

Most endpoints require authentication. Include the authentication token in the request headers:

```http
Authorization: Bearer {your_access_token}
```

---

## Prescription Endpoints

### 1. Get Patient's Prescriptions List

Returns all prescriptions for a specific patient.

**Endpoint:**
```
GET /{project}/api/patient/patient-prescriptions/{patientId}
```

**Parameters:**

| Parameter | Type | Location | Required | Description |
|-----------|------|----------|----------|-------------|
| `project` | string | URL | Yes | Tenant/project identifier |
| `patientId` | integer | URL | Yes | The patient's ID |

**Example Request:**
```http
GET /clinic1/api/patient/patient-prescriptions/5
Host: yourdomain.com
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
Content-Type: application/json
```

**cURL Example:**
```bash
curl -X GET "https://yourdomain.com/clinic1/api/patient/patient-prescriptions/5" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -H "Content-Type: application/json"
```

**JavaScript/Fetch Example:**
```javascript
fetch('https://yourdomain.com/clinic1/api/patient/patient-prescriptions/5', {
    method: 'GET',
    headers: {
        'Authorization': 'Bearer YOUR_ACCESS_TOKEN',
        'Content-Type': 'application/json'
    }
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
```

---

### 2. Get Patient's Prescriptions List (Extended Format)

Returns all prescriptions for a specific patient with pagination and filters (same format as admin prescriptions list).

**Endpoint:**
```
GET /{project}/api/patient/prescriptions-list/{patientId}
```

**Parameters:**

| Parameter | Type | Location | Required | Description |
|-----------|------|----------|----------|-------------|
| `project` | string | URL | Yes | Tenant/project identifier |
| `patientId` | integer | URL | Yes | The patient's ID |
| `page` | integer | Query | No | Page number for pagination (default: 1) |
| `limit` | integer | Query | No | Items per page (default: 20, max: 100) |
| `start_date` | string | Query | No | Filter by start date (YYYY-MM-DD) |
| `end_date` | string | Query | No | Filter by end date (YYYY-MM-DD) |
| `doctor_id` | integer | Query | No | Filter by doctor ID |
| `search` | string | Query | No | Search by prescription number or doctor name |

**Example Request:**
```http
GET /clinic1/api/patient/prescriptions-list/5?page=1&limit=10&start_date=2026-01-01&end_date=2026-02-05
Host: yourdomain.com
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
Content-Type: application/json
```

**cURL Example:**
```bash
curl -X GET "https://yourdomain.com/clinic1/api/patient/prescriptions-list/5?page=1&limit=10" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -H "Content-Type: application/json"
```

**JavaScript/Fetch Example:**
```javascript
const patientId = 5;
const params = new URLSearchParams({
    page: 1,
    limit: 10,
    start_date: '2026-01-01',
    end_date: '2026-02-05'
});

fetch(`https://yourdomain.com/clinic1/api/patient/prescriptions-list/${patientId}?${params}`, {
    method: 'GET',
    headers: {
        'Authorization': 'Bearer YOUR_ACCESS_TOKEN',
        'Content-Type': 'application/json'
    }
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
```

**Example Response:**
```json
{
    "status": "success",
    "prescriptions": [
        {
            "id": 1,
            "prescription_number": "PRS-001",
            "prescription_date": "2026-02-05",
            "doctor_name": "Dr. John Smith",
            "patient_name": "Jane Doe",
            "patient_id": 5,
            "doctor_id": 2,
            "created_at": "2026-02-05 10:30:00"
        }
    ],
    "pagination": {
        "total_count": 25,
        "page": 1,
        "limit": 10,
        "total_pages": 3
    }
}
```

---

### 3. View Single Prescription

Returns detailed information about a specific prescription.

**Endpoint:**
```
GET /{project}/api/patient/prescription-view/{id}
```

**Parameters:**

| Parameter | Type | Location | Required | Description |
|-----------|------|----------|----------|-------------|
| `project` | string | URL | Yes | Tenant/project identifier |
| `id` | integer | URL | Yes | The prescription ID |

**Example Request:**
```http
GET /clinic1/api/patient/prescription-view/10
Host: yourdomain.com
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
Content-Type: application/json
```

**cURL Example:**
```bash
curl -X GET "https://yourdomain.com/clinic1/api/patient/prescription-view/10" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -H "Content-Type: application/json"
```

---

### 3. Admin - Get All Prescriptions List

Returns all prescriptions in the system (for admin/owner use).

**Endpoint:**
```
GET /{project}/api/admin/prescriptions-list
```

**Parameters:**

| Parameter | Type | Location | Required | Description |
|-----------|------|----------|----------|-------------|
| `project` | string | URL | Yes | Tenant/project identifier |

**Example Request:**
```http
GET /clinic1/api/admin/prescriptions-list
Host: yourdomain.com
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
Content-Type: application/json
```

**cURL Example:**
```bash
curl -X GET "https://yourdomain.com/clinic1/api/admin/prescriptions-list" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -H "Content-Type: application/json"
```

**JavaScript/Axios Example:**
```javascript
import axios from 'axios';

axios.get('https://yourdomain.com/clinic1/api/admin/prescriptions-list', {
    headers: {
        'Authorization': 'Bearer YOUR_ACCESS_TOKEN',
        'Content-Type': 'application/json'
    }
})
.then(response => {
    console.log(response.data);
})
.catch(error => {
    console.error('Error:', error);
});
```

---

### 4. Admin - View Single Prescription

Returns detailed information about a specific prescription (admin view).

**Endpoint:**
```
GET /{project}/api/admin/prescription-show/{id}
```

**Parameters:**

| Parameter | Type | Location | Required | Description |
|-----------|------|----------|----------|-------------|
| `project` | string | URL | Yes | Tenant/project identifier |
| `id` | integer | URL | Yes | The prescription ID |

**Example Request:**
```http
GET /clinic1/api/admin/prescription-show/10
Host: yourdomain.com
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
Content-Type: application/json
```

**cURL Example:**
```bash
curl -X GET "https://yourdomain.com/clinic1/api/admin/prescription-show/10" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -H "Content-Type: application/json"
```

---

### 5. Owner - Get All Prescriptions List

Same as Admin endpoint, for owner role.

**Endpoint:**
```
GET /{project}/api/owner/prescriptions-list
```

**Example Request:**
```http
GET /clinic1/api/owner/prescriptions-list
Host: yourdomain.com
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
Content-Type: application/json
```

---

### 6. Owner - View Single Prescription

Same as Admin endpoint, for owner role.

**Endpoint:**
```
GET /{project}/api/owner/prescription-show/{id}
```

**Example Request:**
```http
GET /clinic1/api/owner/prescription-show/10
Host: yourdomain.com
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
Content-Type: application/json
```

---

## Quick Reference Table

| Endpoint | Method | Description |
|----------|--------|-------------|
| `/{project}/api/patient/patient-prescriptions/{patientId}` | GET | Get all prescriptions for a patient |
| `/{project}/api/patient/prescription-view/{id}` | GET | View single prescription details |
| `/{project}/api/admin/prescriptions-list` | GET | Admin: Get all prescriptions |
| `/{project}/api/admin/prescription-show/{id}` | GET | Admin: View single prescription |
| `/{project}/api/owner/prescriptions-list` | GET | Owner: Get all prescriptions |
| `/{project}/api/owner/prescription-show/{id}` | GET | Owner: View single prescription |

---

## Response Format

All APIs return JSON responses. A typical successful response structure:

```json
{
    "success": true,
    "data": {
        // Response data here
    },
    "message": "Success message"
}
```

A typical error response:

```json
{
    "success": false,
    "message": "Error description",
    "errors": {
        // Validation errors if any
    }
}
```

---

## HTTP Status Codes

| Code | Description |
|------|-------------|
| 200 | Success |
| 401 | Unauthorized - Invalid or missing token |
| 403 | Forbidden - Access denied |
| 404 | Not Found - Resource doesn't exist |
| 422 | Validation Error |
| 500 | Server Error |

---

## Notes

1. Replace `{project}` with your actual tenant/project identifier
2. Replace `YOUR_ACCESS_TOKEN` with the actual JWT token obtained from login
3. All dates in responses are typically in `Y-m-d H:i:s` format
4. The controller handling these routes is `App\Http\Controllers\Mobile\MobileController`
