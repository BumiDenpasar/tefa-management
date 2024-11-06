<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Report</title>
    <!-- Tambahkan Tailwind CSS -->
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
    <style>
        /* Styling untuk print */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
    <link rel="icon" href="images/icon.png" type="image/png">
</head>
<body class="bg-gray-100 p-8 text-sm">

    <div class="w-full flex items-center justify-between">
        <a href="/admin" class="no-print font-semibold text-[10px] text-gray-600 ">Back to Home</a>
        <div>
            <a href="./weekly" class="no-print mt-6 bg-purple-500 text-white py-2 px-4 rounded hover:bg-blue-600">Weekly</a>
            <a href="./yearly" class="no-print mt-6 bg-purple-500 text-white py-2 px-4 rounded hover:bg-blue-600">Yearly</a>
            <a href="../school_report" class="no-print mt-6 bg-purple-500 text-white py-2 px-4 rounded hover:bg-blue-600">Overall</a>
            <button onclick="window.print()" class="no-print mt-6 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Print Report</button>
        </div>
    </div>


    <div class="">
        <div class="w-full flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold mt-5">School Report</h1>
                <p class="mb-6">{{$time}}</p>
            </div>
            <div>
                <img src="https://chlorinedigitalmedia.com/wp-content/uploads/2021/09/logo-2-e1631489345697.png" alt="logo" class="h-10 w-full" />
            </div>
        </div>
        
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead class="bg-purple-500 text-white" style="-webkit-print-color-adjust: exact;">
                <tr>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">#</th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">School Name</th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">TeFa</th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Contact Number</th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">NPSN</th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Total Income</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schools as $school)
                    <tr>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">{{ $school->id }}</td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">{{ $school->name }}</td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ $school->tefa_name }}</td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ $school->contact_number }}</td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ $school->npsn }}</td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">Rp {{ number_format($school->total_income, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tombol Print -->
        <button onclick="window.print()" class="no-print mt-6 bg-purple-500 text-white py-2 px-4 rounded hover:bg-blue-600">Print Report</button>

    </div>

</body>
</html>
