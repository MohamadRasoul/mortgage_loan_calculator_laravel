@props(['title', 'columns', 'rows'])

{{-- Table --}}
<x-card>
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

                        @foreach($columns as $col)
                            <th scope="col"
                                class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                {{Str::upper($col)}}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($rows as $idx => $row)
                        <tr>


                            @foreach($columns as $col)
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$row[$col]}}
                                    </p>
                                </td>
                            @endforeach
                            {{--<td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <span
                                class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                <span aria-hidden="true"
                                      class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                </span>
                                <span class="relative">
                                    $5094.08
                                </span>
                            </span>
                            </td>--}}

                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</x-card>

{{-- End Table  --}}
