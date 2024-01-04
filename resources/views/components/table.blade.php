
@props(['title'])

{{-- Table --}}
<div class="w-full mb-4 ">
    <div class="w-full p-4 bg-white shadow-lg rounded-2xl">
        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
        <div class="py-8">
            <div class="flex flex-row justify-between w-full mb-1 sm:mb-0">
                <h2 class="text-2xl leading-tight">
                    {{$title}}
                </h2>

            </div>
            <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
                <div class="inline-block min-w-full overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                    #
                                </th>
                                <th scope="col"
                                    class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                    Interest
                                </th>
                                <th scope="col"
                                    class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                    Principal
                                </th>
                                <th scope="col"
                                    class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                    Balance
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div >
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                1
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        $24.26
                                    </p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        $5,821.64
                                    </p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                        <span aria-hidden="true"
                                            class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                        </span>
                                        <span class="relative">
                                            $5094.08
                                        </span>
                                    </span>
                                </td>

                            </tr>
                            <tr>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div >
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                2
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        $24.26
                                    </p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        $5,821.64
                                    </p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                        <span aria-hidden="true"
                                            class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                        </span>
                                        <span class="relative">
                                            $5094.08
                                        </span>
                                    </span>
                                </td>

                            </tr>
                            <tr>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div >
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                3
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        $24.26
                                    </p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        $5,821.64
                                    </p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                        <span aria-hidden="true"
                                            class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                        </span>
                                        <span class="relative">
                                            $5094.08
                                        </span>
                                    </span>
                                </td>

                            </tr>
                            <tr>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div >
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                4
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        $24.26
                                    </p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        $5,821.64
                                    </p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                        <span aria-hidden="true"
                                            class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                        </span>
                                        <span class="relative">
                                            $5094.08
                                        </span>
                                    </span>
                                </td>

                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Table  --}}
