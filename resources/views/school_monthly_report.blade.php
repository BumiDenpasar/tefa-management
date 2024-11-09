<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none;
            }
            @page {
                margin: 1.5cm;
            }
            .print-exact-color {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
    <link rel="icon" href="images/icon.png" type="image/png">
</head>
<body class="bg-gray-50 p-6 md:p-8">
    <!-- Navigation Bar -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="flex items-center justify-between">
            <a href="/admin" class="no-print text-gray-600 hover:text-gray-800 flex items-center gap-2 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-medium">Back to Home</span>
            </a>
            
            <div class="flex gap-3">
                <a href="./weekly" class="no-print px-4 py-2 text-sm font-medium text-white bg-indigo-500 rounded-full hover:bg-indigo-600 transition-all shadow-sm hover:shadow">Weekly</a>
                <a href="./yearly" class="no-print px-4 py-2 text-sm font-medium text-white bg-indigo-500 rounded-full hover:bg-indigo-600 transition-all shadow-sm hover:shadow">Yearly</a>
                <a href="../school_report" class="no-print px-4 py-2 text-sm font-medium text-white bg-indigo-500 rounded-full hover:bg-indigo-600 transition-all shadow-sm hover:shadow">Overall</a>
                <button onclick="window.print()" class="no-print px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-full hover:bg-blue-600 transition-all shadow-sm hover:shadow flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{\Carbon\Carbon::parse($time)->format('F')}} School Report</h1>
                    <p class="text-gray-500 mt-1">{{\Carbon\Carbon::parse($time)->format('F d, Y')}}</p>
                </div>
                <img src="https://chlorinedigitalmedia.com/wp-content/uploads/2021/09/logo-2-e1631489345697.png" alt="logo" class="h-12" />
            </div>
            
            <div class="overflow-x-auto rounded-xl">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white print-exact-color">
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider rounded-tl-lg">#</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">School Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">TeFa</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Contact Number</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">NPSN</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider rounded-tr-lg">Total Income</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($schools as $school)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $school->id }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $school->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $school->tefa_name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $school->contact_number }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $school->npsn }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Rp {{ number_format($school->total_income, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>