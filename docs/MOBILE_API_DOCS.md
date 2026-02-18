# Mobile API Documentation

This document outlines the API endpoints handled by `MobileController.php`.

## Authentication

### Login
- **Method**: `POST`
- **URL**: `/api/user/login`
- **Description**: Authenticates a user via MRN (Patient) or Email/Password (Admin/Doctor/Staff).
- **Request Payload**:
  ```json
  {
      "mrn_number": "MRN-12345",         // Optional: Required for Patient Login
      "email": "doctor@example.com",     // Optional: Required if not using MRN
      "password": "secretpassword",      // Optional: Required if using email
      "device_token": "fcm_token_xyz",   // Optional: For push notifications
      "device_type": "android",          // Optional: 'android' or 'ios'
      "app_version": "1.0.0"             // Optional
  }
  ```
- **Response**:
  ```json
  {
      "status": "success",
      "login": "successfully logged in",
      "data": {
          "user_id": 1,
          "name": "John Doe",
          "gender": "Male",
          "mrn": "MRN-123",
          "role": "Patient",
          "access_token": "random_string...",
          "refresh_token": "random_string...",
          "expires_in": "2024-01-01 12:00:00",
          "app_name": "Dental App",
          "device_token": "fcm_token_xyz"
      }
  }
  ```

### Logout
- **Method**: `POST`
- **URL**: `/api/user/logout`
- **Description**: Logs out the current user and invalidates tokens.
- **Request Payload**: (Empty)
- **Headers**:
  - `Authorization`: `Bearer <token>`
- **Response**:
  ```json
  {
      "status": "success",
      "message": "Logout Successfully"
  }
  ```

---

## Patient Endpoints

### Patient Dashboard
- **Method**: `GET`
- **URL**: `/api/patient/dashboard/{patientId}`
- **Description**: Returns statistics for the patient dashboard.
- **Response**:
  ```json
  {
      "status": "true",
      "data": {
          "stats": {
              "Appointments": 5,
              "Prescription": 2,
              "Invoice": 3,
              "TreatmentPlan": 1,
              "ExamInvestigation": 0
          }
      }
  }
  ```

### Patient Appointments
- **Method**: `GET`
- **URL**: `/api/patient/patient-appointments/{patientId}`
- **Description**: List of appointments for a specific patient.
- **Response**:
  ```json
  {
      "status": "success",
      "data": {
          "appointments": [
              {
                  "appointment_id": 10,
                  "appointment_number": "APT-001",
                  "appointment_time": "10:00",
                  "doctor_name": "Dr. Smith",
                  "date": "2024-01-01",
                  "status": "Pending"
              }
          ]
      }
  }
  ```

### Book Appointment
- **Method**: `POST`
- **URL**: `/api/patient/book-appointment`
- **Description**: Books a new appointment.
- **Request Payload**:
  ```json
  {
      "user_id": 1,
      "doctor_id": 5,
      "appointment_date": "2024-01-25", // Format: YYYY-MM-DD
      "start_time": "14:30",            // Format: HH:mm (24-hour)
      "problem": "Severe tooth pain"    // Min 5 characters
  }
  ```
- **Response**:
  ```json
  {
      "status": "success",
      "data": {
          "appointment": {
              "appointment_number": "APT-123",
              "start_time": "14:30",
              "end_time": "14:45",
              "appointment_date": "2024-01-25",
              ...
          }
      }
  }
  ```

### Patient Prescriptions
- **Method**: `GET`
- **URL**: `/api/patient/patient-prescriptions/{patientId}`
- **Description**: List of prescriptions for a specific patient.
- **Response**:
  ```json
  {
      "status": "success",
      "data": {
          "prescriptions": [
              {
                  "id": 1,
                  "prescription_number": "PRS-001",
                  "doctor_name": "Dr. Smith",
                  "doctor_id": 5,
                  "date": "2024-01-20",
                  "note": "Take medicines after meal"
              }
          ]
      }
  }
  ```

### Patient Prescription View
- **Method**: `GET`
- **URL**: `/api/patient/prescription-view/{id}`
- **Description**: Detailed view of a single prescription including medicines and diagnosis.
- **Response**:
  ```json
  {
      "status": "success",
      "data": {
          "prescription": {
              "id": 1,
              "prescription_number": "PRS-001",
              "date": "2024-01-20",
              "note": "Take after meals",
              "doctor": {
                  "id": 5,
                  "name": "Dr. Smith"
              },
              "patient": {
                  "id": 10,
                  "name": "John Doe"
              },
              "medicines": [
                  {
                      "medicine_name": "Panadol",
                      "type": "Tablet",
                      "instruction": "1-0-1",
                      "days": "5"
                  }
              ],
              "diagnoses": [
                  {
                      "diagnosis_name": "Fever",
                      "instruction": "Rest for 2 days"
                  }
              ]
          }
      }
  }
  ```

### Patient Invoices
- **Method**: `GET`
- **URL**: `/api/patient/invoices-view/{id}`
- **Description**: List of invoices for a patient.
- **Response**:
  ```json
  {
      "status": true,
      "invoices": [
          {
              "id": 1,
              "invoice_number": "INV-001",
              "date": "2024-01-10",
              "grand-total": 1000,
              "paid": 500,
              "due": 500,
              "doctor-Id": 5,
              "name": "Dr. Smith"
          }
      ]
  }
  ```

### Patient Notifications
- **Method**: `GET`
- **URL**: `/api/patient/notifications`
- **Query Params**: `status`, `page`, `limit`
- **Response**:
  ```json
  {
      "status": "success",
      "notifications": [
          {
              "id": 22,
              "title": "Appointment Confirmed",
              "description": "Your appointment with Dr. Ali is confirmed.",
              "status": "unread",
              "created_at": "2024-01-20 09:30:00"
          }
      ],
      "pagination": {
          "total_count": 50,
          "page": 1,
          "limit": 20,
          "total_pages": 3
      }
  }
  ```

---

## Doctor Endpoints

### Doctor List
- **Method**: `GET`
- **URL**: `/api/doctor/doctor-list`
- **Response**:
  ```json
  {
      "status": true,
      "data": {
          "doctors": [
              {
                  "doctor_id": 5,
                  "name": "Dr. Smith",
                  "specialist": "Dentist",
                  "details": {
                      "fee": 1500,
                      "working_days": "Monday to Friday",
                      "timing": "09:00-17:00"
                  }
              }
          ]
      }
  }
  ```

### Doctor View
- **Method**: `GET`
- **URL**: `/api/doctor/doctor-view/{id}`
- **Response**:
  ```json
  {
      "status": "success",
      "data": {
          "doctor": {
              "id": 5,
              "name": "Dr. Smith",
              "email": "dr.smith@example.com",
              "specialist": "Orthodontist",
              "availability": "Available"
          }
      }
  }
  ```

### Doctor Appointments
- **Method**: `GET`
- **URL**: `/api/doctor/doctor-appointments/{id}`
- **Response**:
  ```json
  {
      "status": true,
      "data": {
          "appointments": [
              {
                  "patient_name": "Jane Doe",
                  "appointment_id": 12,
                  "appointment_number": "APT-056",
                  "start_time": "10:00",
                  "appointment_date": "2024-01-22",
                  "problem": "Checkup"
              }
          ]
      }
  }
  ```

### Doctor's Patients
- **Method**: `GET`
- **URL**: `/api/doctor/doctor-patients/{id}`
- **Response**:
  ```json
  {
      "status": "success",
      "doctor": "Dr. Smith",
      "patients": [
          {
              "id": 1,
              "name": "Jane Doe",
              "mrn_number": "MRN-123",
              "cnic": "12345-6789012-3"
          }
      ]
  }
  ```

---

## Admin / Owner Dashboard API

**Note**: Admin endpoints start with `/api/admin/` and Owner endpoints start with `/api/owner/`. The endpoints below use `/api/admin/` as the example prefix.

### Dashboard Stats
- **Method**: `GET`
- **URL**: `/api/admin/dashboard`
- **Response**:
  ```json
  {
      "status": "success",
      "data": {
          "stats": {
              "total_doctors": 10,
              "total_patients": 150,
              "total_appointments": 300,
              "total_invoices": 280,
              "total_revenue": 500000,
              "paid_amount": 450000,
              "due_amount": 50000
          }
      }
  }
  ```

### Doctors List (Admin)
- **Method**: `GET`
- **URL**: `/api/admin/doctors-list`
- **Query Params**: `start_date`, `end_date`, `active`, `specialization`, `search`, `page`, `limit`
- **Response**:
  ```json
  {
      "status": "success",
      "doctors": [
          {
              "doctor_id": 3,
              "name": "Dr. Strange",
              "email": "strange@marvel.com",
              "specialization": "Neurology",
              "is_active": true,
              "total_appointments": 45
          }
      ],
      "pagination": { "total_count": 10, ... }
  }
  ```

### Doctors Show (Admin)
- **Method**: `GET`
- **URL**: `/api/admin/doctors-show/{id}`
- **Response**:
  ```json
  {
      "status": "success",
      "doctor": { ... }
  }
  ```

### Patients List (Admin)
- **Method**: `GET`
- **URL**: `/api/admin/patients-list`
- **Query Params**: `start_date`, `end_date`, `gender`, `min_age`, `max_age`, `search`, `page`, `limit`
- **Response**:
  ```json
  {
      "status": "success",
      "patients": [
          {
              "patient_id": 4,
              "name": "Peter Parker",
              "mrn_number": "MRN-999",
              "age": 25,
              "total_appointments": 5,
              "total_invoices": 5
          }
      ],
      "pagination": { ... }
  }
  ```

### Appointments List (Admin)
- **Method**: `GET`
- **URL**: `/api/admin/appointments-list`
- **Query Params**: `start_date`, `end_date`, `status`, `doctor_id`, `patient_id`, `search`, `page`, `limit`
- **Response**:
  ```json
  {
      "status": "success",
      "appointments": [ ... ],
      "pagination": { ... }
  }
  ```

### Invoices List (Admin)
- **Method**: `GET`
- **URL**: `/api/admin/invoices-list`
- **Query Params**: `start_date`, `end_date`, `payment_status`, `doctor_id`, `patient_id`, `min_amount`, `max_amount`, `search`, `page`, `limit`
- **Response**:
  ```json
  {
      "status": "success",
      "invoices": [ ... ],
      "pagination": { ... }
  }
  ```

### Prescriptions List (Admin)
- **Method**: `GET`
- **URL**: `/api/admin/prescriptions-list`
- **Description**: List all prescriptions with filtering.
- **Query Params**:
  - `start_date`, `end_date`.
  - `doctor_id`, `patient_id`.
  - `search`: Prescription number, patient name.
  - `page`, `limit`.
- **Response**:
  ```json
  {
      "status": "success",
      "prescriptions": [
          {
              "id": 1,
              "prescription_number": "PRS-001",
              "prescription_date": "2024-01-20",
              "doctor_name": "Dr. Smith",
              "patient_name": "John Doe",
              "created_at": "2024-01-20 10:00:00"
          }
      ],
      "pagination": {...}
  }
  ```

### Prescription Details (Admin)
- **Method**: `GET`
- **URL**: `/api/admin/prescription-show/{id}`
- **Description**: Detailed view of a prescription.
- **Params**:
  - `id`: Prescription ID.
- **Response**:
  ```json
  {
      "status": "success",
      "prescription": {
          "id": 1,
          "prescription_number": "PRS-001",
          "prescription_date": "2024-01-20",
          "note": "Take care",
          "doctor": { "id": 5, "name": "Dr. Smith" },
          "patient": { "id": 10, "name": "John Doe" },
          "medicines": [...],
          "diagnoses": [...]
      }
  }
  ```

### Contact Management (Update)
- **Method**: `POST`
- **URL**: `/api/admin/contact-management`
- **Request Payload**:
  ```json
  {
      "action": "update",
      "software_name": "Dental Pro",
      "contact_email": "support@dentalpro.com",
      "phone": "+1 555 0199",
      "address": "123 Main St, New York, NY",
      "website": "https://dentalpro.com",
      "business_hours": "Mon-Fri 9AM-5PM"
  }
  ```
- **Response**:
  ```json
  {
      "status": "success",
      "message": "Contact information updated successfully",
      "contact_info": {
          "software_name": "Dental Pro",
          "contact_email": "support@dentalpro.com",
          ...
      }
  }
  ```
