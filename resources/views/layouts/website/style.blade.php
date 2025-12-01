
    <style>
        /* Custom styles for Inter font */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        /* Dark mode specific styles */
        html.dark {
            background-color: #0F172A; /* Darker background for dark mode (slate-900) */
            color: #e2e8f0; /* Light text */
        }
        html.dark .bg-white {
            background-color: #1E293B; /* Darker background for cards/elements (slate-800) */
        }
        html.dark .text-gray-800 {
            color: #e2e8f0;
        }
        html.dark .border-gray-200 {
            border-color: #4a5568;
        }
        html.dark .shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2), 0 2px 4px -1px rgba(0, 0, 0, 0.1);
        }
        html.dark .hover\:bg-gray-100:hover {
            background-color: #4a5568;
        }
        html.dark .text-gray-600 {
            color: #cbd5e0;
        }
        html.dark .text-gray-500 {
            color: #a0aec0;
        }
        html.dark .bg-gray-200 {
            background-color: #4a5568;
        }
        html.dark .text-gray-700 {
            color: #e2e8f0;
        }
        html.dark .hover\:bg-gray-300:hover {
            background-color: #6a7a8a;
        }

        /* Hide scrollbar for product slider but allow scrolling */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }

        /* Active tab indicator for About Us section */
        .tab-title.active {
            border-bottom: 2px solid #4f46e5; /* Indigo-600 */
            color: #4f46e5;
        }

        /* Language Dropdown specific styles */
        .language-dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 10; /* Ensure it's above other elements */
            border-radius: 0.375rem; /* rounded-md */
            top: 100%; /* Position below the button */
            margin-top: 0.5rem; /* mt-2 */
        }

        .language-dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: right; /* Default for RTL */
            transition: background-color 0.2s ease;
        }
        html[dir="ltr"] .language-dropdown-content {
            left: 0; /* For LTR */
            right: auto;
        }
        html[dir="rtl"] .language-dropdown-content {
            right: 0; /* For RTL */
            left: auto;
        }

        html[dir="ltr"] .language-dropdown-content a {
            text-align: left; /* For LTR */
        }

        .language-dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .language-dropdown.show .language-dropdown-content {
            display: block;
        }

        /* Dark mode for language dropdown */
        html.dark .language-dropdown-content {
            background-color: #1E293B; /* Darker background for dark mode (slate-800) */
        }
        html.dark .language-dropdown-content a {
            color: #e2e8f0;
        }
        html.dark .language-dropdown-content a:hover {
            background-color: #4a5568;
        }

        /* Cart dropdown positioning for RTL/LTR */
        /* Ensure cart dropdown stays within bounds on small screens */
        #cart-dropdown {
            /* Always align to the right of its parent for cart dropdown */
            right: 0;
            left: auto;
            max-width: calc(100vw - 2rem); /* Ensure it doesn't overflow viewport width - 1rem padding on each side */
        }
        /* No need for LTR specific override here, as right:0 is fine for cart dropdown */

        /* Ensure main container is always within viewport and prevents horizontal scroll */
        .container {
            width: 100%; /* Ensure container takes full width */
            padding-left: 1rem; /* Add horizontal padding */
            padding-right: 1rem; /* Add horizontal padding */
            margin-left: auto;
            margin-right: auto;
        }
        @media (min-width: 640px) { /* sm breakpoint */
            .container { max-width: 640px; }
        }
        @media (min-width: 768px) { /* md breakpoint */
            .container { max-width: 768px; }
        }
        @media (min-width: 1024px) { /* lg breakpoint */
            .container { max-width: 1024px; }
        }
        @media (min-width: 1280px) { /* xl breakpoint */
            .container { max-width: 1280px; }
        }
    </style>

