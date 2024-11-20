<x-mail::message>
# Welcome to {{ config('app.name') }}!

Hello, {{ $user->name }}!

We are excited to have you join our community! At **{{ config('app.name') }}**, we are committed to empowering youths like you in the slums of Kenya by providing essential training and connecting you to meaningful job opportunities.

## How to Get Started
Here are some steps to help you make the most of our platform:
- **Explore** our wide range of training programs designed to equip you with valuable skills.
- **Complete Your Profile** to increase your visibility to potential employers.
- **Connect with Mentors** and other community members for support and guidance.

<x-mail::button :url="config('app.url') . '/dashboard'">
Start Your Journey
</x-mail::button>

## What You Can Expect
We believe in your potential and are here to support you every step of the way. Whether you're looking to learn new skills, gain work experience, or secure a job, we are committed to helping you succeed.

<x-mail::panel>
"Your future begins here. Together, we can create opportunities and transform lives!"
</x-mail::panel>

If you ever have any questions or need assistance, our support team is just a message away. We are here to help you achieve your dreams.

Thank you for being part of our mission to uplift the youth in our communities. We can't wait to see all the amazing things you'll accomplish!

With warm regards,
The {{ config('app.name') }} Team

<x-mail::subcopy>
If you’re having trouble clicking the "Start Your Journey" button, copy and paste the following URL into your browser: [{{ config('app.url') . '/dashboard' }}]({{ config('app.url') . '/dashboard' }})
</x-mail::subcopy>
</x-mail::message>
