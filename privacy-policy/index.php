<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Privacy Policy for JDent App - Developed by Jantrah Tech" />
  <title>Privacy Policy | JDent</title>
  <style>
    body {
      font-family: "Poppins", Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f7f9fb;
      color: #333;
      line-height: 1.6;
    }

    header {
      background: #0088cc;
      color: white;
      padding: 20px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    header h1 {
      margin: 0;
      font-size: 26px;
      letter-spacing: 1px;
    }

    main {
      max-width: 900px;
      margin: 40px auto;
      background: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    h2 {
      color: #0088cc;
      margin-top: 30px;
      font-size: 20px;
    }

    p {
      margin: 10px 0;
    }

    a {
      color: #0088cc;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    footer {
      text-align: center;
      padding: 20px;
      background: #f1f1f1;
      color: #555;
      font-size: 14px;
      margin-top: 40px;
    }

    .last-updated {
      text-align: right;
      font-size: 13px;
      color: #777;
      margin-top: -10px;
    }

    @media (max-width: 600px) {
      main {
        margin: 20px;
        padding: 20px;
      }

      header h1 {
        font-size: 22px;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1>Privacy Policy - JDent</h1>
  </header>

  <main>
    <p class="last-updated">Last Updated: October 24, 2025</p>

    <p>Welcome to <strong>JDent</strong> — a mobile application developed and managed by <a href="https://jantrah.com/" target="_blank">Jantrah Tech</a>. This Privacy Policy explains how we collect, use, and protect your personal information when you use the JDent app in Pakistan.</p>

    <h2>1. Information We Collect</h2>
    <p>We may collect the following types of information from our users (Admin, Doctor, and Patients):</p>
    <ul>
      <li><strong>Personal Information:</strong> Name, contact number, email address, CNIC (if provided), and gender.</li>
      <li><strong>Medical Information:</strong> Patient history, appointments, treatment details, and related health data.</li>
      <li><strong>Usage Information:</strong> App activity, device type, and app interaction logs for performance improvement.</li>
    </ul>

    <h2>2. How We Use Your Information</h2>
    <p>We use collected information for the following purposes:</p>
    <ul>
      <li>To manage patient appointments and treatment records.</li>
      <li>To enable communication between doctors and patients.</li>
      <li>To improve user experience and app performance.</li>
      <li>To ensure data security and compliance with Pakistani health data laws.</li>
    </ul>

    <h2>3. Data Storage and Security</h2>
    <p>Your data is securely stored on our servers using modern encryption and access control mechanisms. We do not sell or share your data with unauthorized third parties.</p>
    <p>All medical and personal data is handled according to the <strong>Personal Data Protection Bill of Pakistan</strong> and international best practices.</p>

    <h2>4. Data Sharing</h2>
    <p>We may share limited data with trusted service providers only for the purpose of improving app functionality or analytics. No medical records are shared without explicit consent.</p>

    <h2>5. User Rights</h2>
    <p>Under applicable laws, you have the right to:</p>
    <ul>
      <li>Access your personal and medical data stored in JDent.</li>
      <li>Request correction or deletion of your data.</li>
      <li>Withdraw consent or deactivate your account anytime.</li>
    </ul>

    <h2>6. Cookies and Analytics</h2>
    <p>We may use cookies or similar technologies to analyze app performance and usage trends. You can disable cookies in your device settings if you prefer.</p>

    <h2>7. Changes to This Policy</h2>
    <p>Jantrah Tech may update this Privacy Policy periodically. Updates will be reflected with a new “Last Updated” date.</p>

    <h2>8. Contact Us</h2>
    <p>If you have any questions or privacy-related concerns, please contact us:</p>
    <p><strong>Jantrah Tech</strong><br>
    Website: <a href="https://jantrah.com/" target="_blank">https://jantrah.com/</a><br>
    Email: info@jantrah.com<br>
    Location: 2nd Floor, Sunrise Tower, Ghori Town Phase 5, Islamabad PK</p>

  </main>

  <footer>
    &copy; 2025 JDent | Developed by Jantrah Tech
  </footer>

  <script>
    // Simple script to show alert for consent
    window.addEventListener('load', () => {
      if (!localStorage.getItem('jdent_policy_ack')) {
        setTimeout(() => {
          if (confirm("By using JDent, you agree to our Privacy Policy.")) {
            localStorage.setItem('jdent_policy_ack', 'true');
          }
        }, 1000);
      }
    });
  </script>
</body>
</html>
